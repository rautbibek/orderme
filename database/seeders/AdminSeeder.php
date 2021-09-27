<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $admin = new Admin();
       $admin->name = 'Admin';
       $admin->email = 'admin@admin.com';
       $admin->password = bcrypt('password');
       $admin->save();
    }
}
