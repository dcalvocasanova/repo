<?php

use App\Loan;
use Illuminate\Database\Seeder;

class LoansTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $loans = [
            [
                'start_at'           => '2022-02-18 20:09:01',
                'amountRequested'    => 1000,
                'amountRemaining'    => 750,
                'client_id'          => 1,
                'interest_id'        => 14,
                'period_id'          => 5,
                'creditTerm_id'      => 11,
            ],
        ];

        Loan::insert($loans);
    }
}