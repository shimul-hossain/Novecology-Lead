<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Super Admin',
            'email' => 'sadmin@admin.com',
            'username' => 'superadmin',
            'password' => bcrypt('@@Bladepro@123@@'),
            'profile_photo' => 'dafault.jpg',
            'role' => 's_admin',
            'role_id' => 1,
            'deleted_status' => 'no',
        ]);
    }
}
