<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'admin',
                'display_name' => 'Administrator',
                'description' => 'System administrator with full access',
                'permissions' => ['*']
            ],
            [
                'name' => 'barangay_treasurer',
                'display_name' => 'Barangay Treasurer',
                'description' => 'Barangay treasurer who manages contributions',
                'permissions' => ['manage_contributions', 'view_members', 'view_reports']
            ],
            [
                'name' => 'member',
                'display_name' => 'Member',
                'description' => 'Regular member of the Bayanihan system',
                'permissions' => ['view_own_profile', 'view_benefits', 'apply_benefits']
            ]
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role['name']], $role);
        }

        $this->command->info('Roles created successfully!');
    }
}
