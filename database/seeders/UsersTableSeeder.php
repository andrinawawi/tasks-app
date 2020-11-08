<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if (config('admin.admin_name')) {
            $user = new User();
            $user->name = config('admin.admin_name');
            $user->email = config('admin.admin_email');
            $user->password = Hash::make(config('admin.admin_password'));
            $user->save();
        }
    }
}
