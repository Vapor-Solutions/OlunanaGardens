<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->timestamps();
        });

        $permissions = [
            'Read Admins',
            'Create Admins',
            'Edit Admins',
            'Delete Admins',

            'Read Users',
            'Create Users',
            'Edit Users',
            'Delete Users',

            'Read Roles',
            'Create Roles',
            'Edit Roles',
            'Delete Roles',

            'Read Clients',
            'Create Clients',
            'Edit Clients',
            'Delete Clients',

            'Read Event Types',
            'Create Event Types',
            'Edit Event Types',
            'Delete Event Types',

            'Read Bookings',
            'Create Bookings',
            'Edit Bookings',
            'Delete Bookings',

            'Read Payment Methods',
            'Create Payment Methods',
            'Edit Payment Methods',
            'Delete Payment Methods',

            'Read Payments',
            'Create Payments',
            'Edit Payments',
            'Delete Payments',

            'Read Testimonials',
            'Create Testimonials',
            'Edit Testimonials',
            'Delete Testimonials',

            'Read Gallery',
            'Create Gallery',
            'Edit Gallery',
            'Delete Gallery',

            'Read Post Categories',
            'Create Post Categories',
            'Edit Post Categories',
            'Delete Post Categories',

            'Read Blog Posts',
            'Create Blog Posts',
            'Edit Blog Posts',
            'Delete Blog Posts',

            'Read Comments',
            'Approve Comments',
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'title' => $permission,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
