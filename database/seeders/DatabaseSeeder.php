<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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

        Transaction::factory(10)->create();

        Transaction::create([
            'expense_id' => '14232',
            'project_id' => '1',
            'recipient_id' => '1',
            "requested_at" => '2020-01-01',
            'amount' => '100000',
            'category' => 'a',
            'type' => 'a',
            'description' => 'a',
        ]);

        Project::factory(2)->create();

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
