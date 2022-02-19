<?php

use App\Collector;
use Illuminate\Database\Seeder;

class CollectorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $collectors = [
            [
                'user_id'           => 5,
                'telephone_1'       => "88888888",
            ],
        ];

        Collector::insert($collectors);
    }
}
