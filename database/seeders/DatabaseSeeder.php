<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Expensetype;
use App\Models\User;
use App\Models\Project;
use App\Models\Recipient;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Ariyan',
            'email' => 'ariyansikoko@gmail.com',
            'password' => bcrypt('asdasd'),
            'isAdmin' => '1',
        ]);
    }
}
