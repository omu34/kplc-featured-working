<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Navbar;

class NavbarSeeder extends Seeder
{
    public function run()
    {
        Navbar::truncate();

        Navbar::create(['type' => 'top', 'name' => 'Home', 'link' => '/', 'order' => 1]);
        Navbar::create(['type' => 'top', 'name' => 'About', 'link' => '/about', 'order' => 2]);
        Navbar::create(['type' => 'top', 'name' => 'Contact', 'link' => '/contact', 'order' => 3]);

        Navbar::create(['type' => 'main', 'name' => 'Dashboard', 'link' => '/dashboard', 'order' => 1]);
        Navbar::create(['type' => 'main', 'name' => 'Profile', 'link' => '/profile', 'order' => 2]);
        Navbar::create(['type' => 'main', 'name' => 'Settings', 'link' => '/settings', 'order' => 3]);
    }
}
