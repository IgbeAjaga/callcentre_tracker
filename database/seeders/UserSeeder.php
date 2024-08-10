<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $userObj = new User();
        $userObj->name = 'User Hmedix';
        $userObj->email = 'userHmedix@gmail.com';
        $userObj->password = Hash::make('123456789');
        $userObj->role = 'customercare';
        $userObj->save();

        $adminObj = new User();
        $adminObj->name = 'Admin Hmedix';
        $adminObj->email = 'adminHmedix@gmail.com';
        $adminObj->password = Hash::make('123456789');
        $adminObj->role = 'admin';
        $adminObj->save();

        $superAdminObj = new User();
        $superAdminObj->name = 'Super Admin Hmedix';
        $superAdminObj->email = 'superAdminHmedix@gmail.com';
        $superAdminObj->password = Hash::make('123456789');
        $superAdminObj->role = 'superadmin';
        $superAdminObj->save();

    }
}
