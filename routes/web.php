<?php

use Illuminate\Support\Facades\Route;
use App\Livewire\Admin;
use App\Livewire;

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
    Route::get('/about', Livewire\Home::class)->name('about');
    Route::get('/garden-sections', Livewire\Home::class)->name('garden-sections');
    Route::get('/restaurant', Livewire\Home::class)->name('restaurant');
    Route::get('/blog', Livewire\Home::class)->name('blog');
    Route::get('/contact-us', Livewire\Home::class)->name('contact-us');
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

    // Gallery
    Route::prefix('gallery')->group(function () {
        Route::get('/', Admin\Gallery\Index::class)->name('admin.gallery.index')->middleware('permission:Read Gallery');
        Route::get('create', Admin\Gallery\Create::class)->name('admin.gallery.create')->middleware('permission:Create Gallery');
        Route::get('{id}/edit', Admin\Gallery\Edit::class)->name('admin.gallery.edit')->middleware('permission:Edit Gallery');
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
});
