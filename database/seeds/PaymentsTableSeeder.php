<?php

use App\Payment;
use Illuminate\Database\Seeder;

class PaymentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $payments = [
            [
                'paymentAmount'     => 250,
                'loan_id'           => 1,
                'paymentMethod_id'  => 19,
                'url'               => "/home",
            ],
        ];

        Payment::insert($payments);
    }
}