<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin;
use App\Livewire;
use App\Models\MenuCategory;
use App\Models\MenuItem;
use Barryvdh\DomPDF\Facade\Pdf;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

if (env('MAINTENANCE_MODE')) {
    Route::get('/', function () {
        return view('errors.503');
    });
    Route::redirect('/{path?}', '/');
} else {
    Route::get('/', Livewire\Home::class)->name('home');
    Route::get('/about', Livewire\About::class)->name('about');
    // Route::get('/garden-sections', Livewire\GardenSections::class)->name('garden-sections');
    Route::get('/gallery-section', Livewire\Gallery::class)->name('gallery');
    Route::get('/restaurant', Livewire\Restaurant::class)->name('restaurant');
    Route::get('/blog', Livewire\Blog::class)->name('blog');
    Route::get('/faq', Livewire\Faq::class)->name('faq');
    Route::get('/{id}/blog-post', Livewire\BlogPost::class)->name('blog-post');
    Route::get('/contact-us', Livewire\ContactUs::class)->name('contact-us');

    Route::get('/olunana-menu', function () {
        $pdf = Pdf::loadView('doc.menu', [
            "menu_categories" => MenuCategory::all(),
            "menu_items" => MenuItem::all()
        ])->setPaper('a4', 'portrait');

        return $pdf->stream();
    })->name('menu.download');
}

Route::redirect('admin', 'admin/dashboard');
Route::redirect('dashboard', 'admin/dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->prefix('admin')->group(function () {

    Route::get('/dashboard', Admin\Dashboard::class)->name('admin.dashboard');
    Route::prefix('settings')->group(function () {
        Route::get('mail', Admin\Settings\Mail::class)->name('admin.settings.mail');
        Route::get('general', Admin\Settings\General::class)->name('admin.settings.general');
    });


    // CMS
    Route::prefix('cms')->group(function () {
        Route::get('content', Admin\Cms\Content::class)->name('admin.cms.content');
        Route::get('photos', Admin\Cms\Photos::class)->name('admin.cms.photos');
        Route::get('faq', Admin\Cms\Faq::class)->name('admin.cms.faq');
        Route::get('faq/create', Admin\Cms\Faq\Create::class)->name('admin.cms.faq.create');
        Route::get('faq/{id}/edit', Admin\Cms\Faq\Edit::class)->name('admin.cms.faq.edit');
    });
    // Users
    Route::prefix('users')->group(function () {
        Route::get('/', Admin\Users\Index::class)->name('admin.users.index')->middleware('permission:Read Users');
        Route::get('create', Admin\Users\Create::class)->name('admin.users.create')->middleware('permission:Create Users');
        Route::get('{id}/edit', Admin\Users\Edit::class)->name('admin.users.edit')->middleware('permission:Edit Users');
    });

    // Roles
    Route::prefix('roles')->group(function () {
        Route::get('/', Admin\Roles\Index::class)->name('admin.roles.index')->middleware('permission:Read Roles');
        Route::get('create', Admin\Roles\Create::class)->name('admin.roles.create')->middleware('permission:Create Roles');
        Route::get('{id}/edit', Admin\Roles\Edit::class)->name('admin.roles.edit')->middleware('permission:Edit Roles');
    });

    // Clients
    Route::prefix('clients')->group(function () {
        Route::get('/', Admin\Clients\Index::class)->name('admin.clients.index')->middleware('permission:Read Clients');
        Route::get('create', Admin\Clients\Create::class)->name('admin.clients.create')->middleware('permission:Create Clients');
        Route::get('{id}/edit', Admin\Clients\Edit::class)->name('admin.clients.edit')->middleware('permission:Edit Clients');
    });

    // EventTypes
    Route::prefix('event-types')->group(function () {
        Route::get('/', Admin\EventTypes\Index::class)->name('admin.event-types.index')->middleware('permission:Read Event Types');
        Route::get('create', Admin\EventTypes\Create::class)->name('admin.event-types.create')->middleware('permission:Create Event Types');
        Route::get('{id}/edit', Admin\EventTypes\Edit::class)->name('admin.event-types.edit')->middleware('permission:Edit Event Types');
    });

    // Booking Requests
    Route::prefix('booking-requests')->group(function () {
        Route::get('/', Admin\BookingRequests\Index::class)->name('admin.booking-requests.index')->middleware('permission:Read Bookings');
    });

    // Menu Categories
    Route::prefix('menu-categories')->group(function () {
        Route::get('/', Admin\MenuCategories\Index::class)->name('admin.menu-categories.index');
        Route::get('create', Admin\MenuCategories\Create::class)->name('admin.menu-categories.create');
        Route::get('{id}/edit', Admin\MenuCategories\Edit::class)->name('admin.menu-categories.edit');
    });
    // Menus
    Route::prefix('menus')->group(function () {
        Route::get('/', Admin\Menus\Index::class)->name('admin.menus.index');
        Route::get('create', Admin\Menus\Create::class)->name('admin.menus.create');
        Route::get('{id}/edit', Admin\Menus\Edit::class)->name('admin.menus.edit');
    });
    // Bookings
    Route::prefix('bookings')->group(function () {
        Route::get('/', Admin\Bookings\Index::class)->name('admin.bookings.index')->middleware('permission:Read Bookings');
        Route::get('create', Admin\Bookings\Create::class)->name('admin.bookings.create')->middleware('permission:Create Bookings');
        Route::get('{id}/edit', Admin\Bookings\Edit::class)->name('admin.bookings.edit')->middleware('permission:Edit Bookings');
    });

    // PaymentMethods
    Route::prefix('payment-methods')->group(function () {
        Route::get('/', Admin\PaymentMethods\Index::class)->name('admin.payment-methods.index')->middleware('permission:Read Payment Methods');
        Route::get('create', Admin\PaymentMethods\Create::class)->name('admin.payment-methods.create')->middleware('permission:Create Payment Methods');
        Route::get('{id}/edit', Admin\PaymentMethods\Edit::class)->name('admin.payment-methods.edit')->middleware('permission:Edit Payment Methods');
    });

    // Payments
    Route::prefix('payments')->group(function () {
        Route::get('/', Admin\Payments\Index::class)->name('admin.payments.index')->middleware('permission:Read Payments');
        Route::get('create', Admin\Payments\Create::class)->name('admin.payments.create')->middleware('permission:Create Payments');
        Route::get('{id}/edit', Admin\Payments\Edit::class)->name('admin.payments.edit')->middleware('permission:Edit Payments');
    });

    // Testimonials
    Route::prefix('testimonials')->group(function () {
        Route::get('/', Admin\Testimonials\Index::class)->name('admin.testimonials.index')->middleware('permission:Read Testimonials');
        Route::get('create', Admin\Testimonials\Create::class)->name('admin.testimonials.create')->middleware('permission:Create Testimonials');
        Route::get('{id}/edit', Admin\Testimonials\Edit::class)->name('admin.testimonials.edit')->middleware('permission:Edit Testimonials');
    });

    // Packages
    Route::prefix('packages')->group(function () {
        Route::get('/', Admin\Packages\Index::class)->name('admin.packages.index')->middleware('permission:Read Packages');
        Route::get('create', Admin\Packages\Create::class)->name('admin.packages.create')->middleware('permission:Create Packages');
        Route::get('{id}/edit', Admin\Packages\Edit::class)->name('admin.packages.edit')->middleware('permission:Edit Packages');
    });
    // Gallery
    Route::prefix('gallery')->group(function () {
        Route::get('/', Admin\Gallery\Index::class)->name('admin.gallery.index')->middleware('permission:Read Gallery');
        Route::get('create', Admin\Gallery\Create::class)->name('admin.gallery.create')->middleware('permission:Create Gallery');
        // Route::get('{id}/edit', Admin\Gallery\Edit::class)->name('admin.gallery.edit')->middleware('permission:Edit Gallery');
    });

    // PostCategories
    Route::prefix('post-categories')->group(function () {
        Route::get('/', Admin\PostCategories\Index::class)->name('admin.post-categories.index')->middleware('permission:Read Post Categories');
        Route::get('create', Admin\PostCategories\Create::class)->name('admin.post-categories.create')->middleware('permission:Create Post Categories');
        Route::get('{id}/edit', Admin\PostCategories\Edit::class)->name('admin.post-categories.edit')->middleware('permission:Edit Post Categories');
    });

    // BlogPosts
    Route::prefix('blog-posts')->group(function () {
        Route::get('/', Admin\BlogPosts\Index::class)->name('admin.blog-posts.index')->middleware('permission:Read Blog Posts');
        Route::get('create', Admin\BlogPosts\Create::class)->name('admin.blog-posts.create')->middleware('permission:Create Blog Posts');
        Route::get('{id}/edit', Admin\BlogPosts\Edit::class)->name('admin.blog-posts.edit')->middleware('permission:Edit Blog Posts');
    });

    // Comments
    Route::prefix('comments')->group(function () {
        Route::get('/', Admin\Comments\Index::class)->name('admin.comments.index')->middleware('permission:Read Comments');
    });
    // Tags
    Route::prefix('tags')->group(function () {
        Route::get('/', Admin\Tags\Index::class)->name('admin.tags.index')->middleware('permission:Create Blog Posts');
        //Route::get('/create', Admin\Tags\Create::class)->name('admin.tags.create');
    });
});
