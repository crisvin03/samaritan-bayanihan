<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user
        $adminRole = Role::getByName('admin');
        
        User::create([
            'name' => 'System Administrator',
            'email' => 'admin@bayanihan.com',
            'password' => Hash::make('password123'),
            'role_id' => $adminRole->id,
            'phone_number' => '+63 912 345 6789',
            'address' => '123 Admin Street, Admin City',
            'birth_date' => '1990-01-01',
            'gender' => 'other',
            'occupation' => 'System Administrator',
            'barangay' => 'Admin Barangay',
            'status' => 'active',
        ]);

        // Create a barangay treasurer for testing
        $treasurerRole = Role::getByName('barangay_treasurer');
        
        User::create([
            'name' => 'Barangay Treasurer',
            'email' => 'treasurer@bayanihan.com',
            'password' => Hash::make('password123'),
            'role_id' => $treasurerRole->id,
            'phone_number' => '+63 912 345 6788',
            'address' => '456 Treasurer Street, Treasurer City',
            'birth_date' => '1985-05-15',
            'gender' => 'female',
            'occupation' => 'Barangay Treasurer',
            'barangay' => 'Zone I (Poblacion)',
            'status' => 'active',
        ]);

        $this->command->info('Admin and Treasurer users created successfully!');
        $this->command->info('Admin Email: admin@bayanihan.com');
        $this->command->info('Treasurer Email: treasurer@bayanihan.com');
        $this->command->info('Password for both: password123');
    }
}