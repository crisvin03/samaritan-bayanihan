<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // admin, member, barangay_treasurer
            $table->string('display_name');
            $table->text('description')->nullable();
            $table->json('permissions')->nullable(); // Store permissions as JSON
            $table->timestamps();
        });

        // Insert default roles
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'Full system access and control',
                'permissions' => json_encode([
                    'manage_members', 'manage_contributions', 'manage_benefits',
                    'manage_admins', 'send_announcements', 'view_reports',
                    'manage_barangay_treasurers'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'description' => 'Regular member with basic access',
                'permissions' => json_encode([
                    'view_profile', 'update_profile', 'view_contributions',
                    'apply_benefits', 'track_benefits', 'receive_notifications'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'barangay_treasurer',
                'display_name' => 'Barangay Treasurer',
                'description' => 'Manages barangay-level records and funds',
                'permissions' => json_encode([
                    'manage_barangay_members', 'record_contributions',
                    'generate_barangay_reports', 'monitor_benefits',
                    'coordinate_with_admins'
                ]),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};