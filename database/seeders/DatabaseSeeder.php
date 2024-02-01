<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Location;
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
        User::factory(0)->create();
        Transaction::factory(50)->create();
        Project::factory(10)->create();

        Recipient::create([
            'name' => 'Azlan',
            'slug' => 'azlan'
        ]);
        Recipient::create([
            'name' => 'Sunandi',
            'slug' => 'sunandi'
        ]);
        Recipient::create([
            'name' => 'Gilang',
            'slug' => 'gilang'
        ]);
    }
}
