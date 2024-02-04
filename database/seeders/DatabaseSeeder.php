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

        Project::factory(20)->create();

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

        Expensetype::create([
            'cost_id' => 'B101',
            'name' => 'B Perizinan',
        ]);
        Expensetype::create([
            'cost_id' => 'B102',
            'name' => 'B Material Proyek',
        ]);
        Expensetype::create([
            'cost_id' => 'B103',
            'name' => 'B Transportasi Material',
        ]);
        Expensetype::create([
            'cost_id' => 'B104',
            'name' => 'B SPSI',
        ]);
        Expensetype::create([
            'cost_id' => 'B105',
            'name' => 'B Pergudangan',
        ]);
        Expensetype::create([
            'cost_id' => 'B106',
            'name' => 'B Penyambungan',
        ]);
        Expensetype::create([
            'cost_id' => 'B107',
            'name' => 'B Alat Berat',
        ]);
        Expensetype::create([
            'cost_id' => 'B108',
            'name' => 'B Makan Minum Karyawan',
        ]);
        Expensetype::create([
            'cost_id' => 'B109',
            'name' => 'B Keamanan',
        ]);
        Expensetype::create([
            'cost_id' => 'B110',
            'name' => 'B Retribusi',
        ]);
        Expensetype::create([
            'cost_id' => 'B111',
            'name' => 'B Comcase',
        ]);
        Expensetype::create([
            'cost_id' => 'B112',
            'name' => 'B Operasional Lainnya',
        ]);
        Expensetype::create([
            'cost_id' => 'B201',
            'name' => 'B Upah KU',
        ]);
        Expensetype::create([
            'cost_id' => 'B202',
            'name' => 'B Upah & Honorer',
        ]);
        Expensetype::create([
            'cost_id' => 'B203',
            'name' => 'B Upah Galian',
        ]);
        Expensetype::create([
            'cost_id' => 'B204',
            'name' => 'B Upah Tukang',
        ]);
        Expensetype::create([
            'cost_id' => 'B205',
            'name' => 'B Bonus & Kompensasi',
        ]);
        Expensetype::create([
            'cost_id' => 'B206',
            'name' => 'B Support Lapangan',
        ]);
        Expensetype::create([
            'cost_id' => 'B301',
            'name' => 'B Survey & Perjalanan Dinas',
        ]);
        Expensetype::create([
            'cost_id' => 'B302',
            'name' => 'B QC & Uji Terima',
        ]);
        Expensetype::create([
            'cost_id' => 'B303',
            'name' => 'B Pengurusan Rekon',
        ]);
        Expensetype::create([
            'cost_id' => 'B401',
            'name' => 'B Sewa Kantor',
        ]);
        Expensetype::create([
            'cost_id' => 'B402',
            'name' => 'B Sewa Kendaraan',
        ]);
        Expensetype::create([
            'cost_id' => 'B403',
            'name' => 'B Perlengkapan',
        ]);
        Expensetype::create([
            'cost_id' => 'B404',
            'name' => 'B Peralatan Kerja',
        ]);
        Expensetype::create([
            'cost_id' => 'B405',
            'name' => 'B Bahan Bakar & Parkir',
        ]);
        Expensetype::create([
            'cost_id' => 'B501',
            'name' => 'B Surety/Insurance Bond',
        ]);
        Expensetype::create([
            'cost_id' => 'B502',
            'name' => 'B Pajak',
        ]);
        Expensetype::create([
            'cost_id' => 'B503',
            'name' => 'B Entertainment',
        ]);
        Expensetype::create([
            'cost_id' => 'B504',
            'name' => 'B Sumbangan Masyarakat',
        ]);
    }
}
