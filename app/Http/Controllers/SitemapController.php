<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /** Public pages that belong in the sitemap, by route name. */
    private const PAGES = ['home', 'about', 'gallery', 'restaurant', 'blog', 'faq', 'contact-us'];

    public function __invoke(): Response
    {
        $base = config('seo.canonical_base');

        $entries = [];
        foreach (self::PAGES as $name) {
            $entries[] = ['loc' => $base . route($name, [], false), 'lastmod' => null];
        }

        foreach (Post::query()->whereNotNull('slug')->where('slug', '!=', '')->orderByDesc('updated_at')->get(['slug', 'updated_at']) as $post) {
            $entries[] = [
                'loc' => $base . route('blog-post', $post->slug, false),
                'lastmod' => $post->updated_at?->toAtomString(),
            ];
        }

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n"
            . '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";

        foreach ($entries as $entry) {
            $xml .= "  <url>\n    <loc>" . htmlspecialchars($entry['loc'], ENT_XML1 | ENT_QUOTES, 'UTF-8') . "</loc>\n";
            if ($entry['lastmod']) {
                $xml .= '    <lastmod>' . $entry['lastmod'] . "</lastmod>\n";
            }
            $xml .= "  </url>\n";
        }

        $xml .= '</urlset>' . "\n";

        return response($xml, 200, ['Content-Type' => 'application/xml; charset=UTF-8']);
    }
}
