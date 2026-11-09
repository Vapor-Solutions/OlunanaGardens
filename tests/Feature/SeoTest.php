<?php

namespace Tests\Feature;

use App\Models\Post;
use App\Models\PostCategory;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Guards the on-page SEO basics for every public page.
 *
 * Uses DatabaseTransactions (not RefreshDatabase) so it never wipes a local
 * development database: anything created here is rolled back.
 */
class SeoTest extends TestCase
{
    use DatabaseTransactions;

    private const PAGES = ['home', 'about', 'gallery', 'restaurant', 'blog', 'faq', 'contact-us'];

    protected function setUp(): void
    {
        parent::setUp();

        $this->withoutVite();
        config(['seo.canonical_base' => 'https://olunanagardens.com']);
    }

    private function head(string $html, string $pattern): ?string
    {
        return preg_match($pattern, $html, $m) ? html_entity_decode(trim($m[1])) : null;
    }

    public function test_every_public_page_has_a_unique_title_description_canonical_and_one_h1(): void
    {
        $titles = $descriptions = [];

        foreach (self::PAGES as $name) {
            $response = $this->get(route($name, [], false));
            $response->assertOk();
            $html = $response->getContent();

            $title = $this->head($html, '#<title>(.*?)</title>#s');
            $description = $this->head($html, '#<meta name="description" content="(.*?)">#s');
            $canonical = $this->head($html, '#<link rel="canonical" href="(.*?)">#s');

            $this->assertNotEmpty($title, "$name has no <title>");
            $this->assertLessThanOrEqual(65, mb_strlen($title), "$name title is too long: $title");
            $this->assertGreaterThanOrEqual(70, mb_strlen((string) $description), "$name meta description is missing or too short");
            $this->assertLessThanOrEqual(165, mb_strlen($description), "$name meta description is too long");
            $this->assertSame('https://olunanagardens.com' . route($name, [], false), $canonical, "$name canonical is wrong");
            $this->assertSame(1, substr_count(strtolower($html), '<h1'), "$name should have exactly one <h1>");
            $this->assertStringNotContainsString('maximum-scale', $html, "$name blocks pinch-zoom");

            $this->assertNotContains($title, $titles, "$name repeats another page's title");
            $this->assertNotContains($description, $descriptions, "$name repeats another page's description");
            $titles[] = $title;
            $descriptions[] = $description;
        }
    }

    public function test_old_urls_redirect_permanently_to_the_new_ones(): void
    {
        $this->get('/gallery-section')->assertStatus(301)->assertRedirect('/photo-gallery');
        $this->get('/blog-posts')->assertOk();
    }

    public function test_page_urls_do_not_clash_with_folders_in_public(): void
    {
        // The web server serves a real folder before Laravel runs, which made /gallery return 403
        // because public/gallery holds uploaded images.
        foreach (self::PAGES as $name) {
            $path = trim(route($name, [], false), '/');
            if ($path === '') {
                continue;
            }
            $this->assertFalse(is_dir(public_path($path)), "/$path clashes with a folder in public/ and would never reach Laravel");
        }
    }

    public function test_blog_post_urls_resolve_by_slug_and_the_numeric_duplicate_redirects(): void
    {
        $user = User::factory()->create();
        $category = new PostCategory();
        $category->title = 'News';
        $category->save();

        $post = Post::create([
            'user_id' => $user->id,
            'post_category_id' => $category->id,
            'title' => 'A venue update',
            'slug' => 'a-venue-update',
            'content' => '<p>Fresh news from the gardens.</p>',
            'blog_photo_path' => '',
            'header_photo_path' => '',
        ]);

        $page = $this->get('/blog/a-venue-update')->assertOk();
        $html = $page->getContent();
        $this->assertStringContainsString('<title>A venue update | Olunana Gardens</title>', $html);
        $this->assertStringContainsString('<link rel="canonical" href="https://olunanagardens.com/blog/a-venue-update">', $html);

        $this->get('/blog-post/' . $post->id)->assertStatus(301)->assertRedirect('/blog/a-venue-update');
        $this->get('/blog-post/a-venue-update')->assertStatus(301)->assertRedirect('/blog/a-venue-update');

        $sitemap = $this->get('/sitemap.xml')->assertOk();
        $this->assertStringContainsString('https://olunanagardens.com/blog/a-venue-update', $sitemap->getContent());
    }

    public function test_unknown_blog_posts_are_a_real_404_not_a_server_error(): void
    {
        $this->get('/blog/this-post-does-not-exist')->assertNotFound();
        $this->get('/blog-post/999999')->assertNotFound();
    }

    public function test_sitemap_lists_the_public_pages_as_xml(): void
    {
        $response = $this->get('/sitemap.xml')->assertOk();
        $this->assertStringContainsString('application/xml', $response->headers->get('Content-Type'));

        foreach (self::PAGES as $name) {
            $this->assertStringContainsString('<loc>https://olunanagardens.com' . route($name, [], false) . '</loc>', $response->getContent());
        }
    }

    public function test_robots_txt_points_to_the_sitemap_and_keeps_the_admin_out(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));

        $this->assertStringContainsString('Sitemap: https://olunanagardens.com/sitemap.xml', $robots);
        $this->assertStringContainsString('Disallow: /admin', $robots);
    }

    public function test_www_redirects_to_the_canonical_host_without_touching_other_hosts(): void
    {
        $this->get('http://www.olunanagardens.com/about?x=1')
            ->assertStatus(301)
            ->assertRedirect('https://olunanagardens.com/about?x=1');

        $this->get('http://staging.example.test/about')->assertOk();
    }
}
