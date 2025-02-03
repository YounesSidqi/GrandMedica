<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DummyChartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $chartData = [
            [
                'pemasukan' => '1000000',
                'pengeluaran' => '1000000'
            ],
            [
                'pemasukan' => '1000000',
                'pengeluaran' => '1000000'
            ],
            [
                'pemasukan' => '1000000',
                'pengeluaran' => '1000000'
            ],
            [
                'pemasukan' => '1000000',
                'pengeluaran' => '1000000'
            ],
        ];
    }
}
