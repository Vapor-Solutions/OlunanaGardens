<?php

use App\Models\Permission;
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
        Schema::create('permission_role', function (Blueprint $table) {
            $table->foreignId('role_id')->constrained();
            $table->foreignId('permission_id')->constrained();
            $table->primary(['role_id', 'permission_id']);
            $table->timestamps();
        });

        foreach (Permission::all() as $key => $permission) {
            DB::table('permission_role')->insert([

                'permission_id' => $permission->id,
                'role_id' => 1,
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
        Schema::dropIfExists('permission_role');
    }
};
