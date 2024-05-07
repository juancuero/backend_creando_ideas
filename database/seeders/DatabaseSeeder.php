<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Cms\Menu;
use App\Models\User;
use App\Utils\ListModules;
use App\Utils\ListPermissions;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {



        $adminRole = Role::firstOrCreate(['name' => 'Admin']);


        $userAdmin = User::firstOrCreate([
            'first_name' => 'Admin',
            'last_name' => 'User',
            'username' => 'admin',
            'email' => 'admin@admin.com',
            'role_id' => $adminRole->id,
            'password' => 'password',
            'email_verified_at' => now(),
            'remember_token' => \Str::random(10),
        ]);



    }
}
