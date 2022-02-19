<?php

use App\Spend;
use Illuminate\Database\Seeder;

class SpendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $spends = [
            [
                'spendAmount'   => 250,
                'collector_id'  => 1,
                'url'           => "/home",
            ],
        ];

        Spend::insert($spends);
    }
}
