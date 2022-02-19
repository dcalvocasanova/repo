<?php

use App\Client;
use Illuminate\Database\Seeder;

class ClientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clients = [
            [
                'user_id'           => 4,
                'alias'             => "el contacto",
                'goverment_ID'      => "123456789",
                'company'           => "Pollos la esquina",
                'telephone_1'       => "22223333",
                'telephone_2'       => "44445555",
                'collector_id'      => 1,
                'route_id'          => 23,
                'status'            => true,
                'detailed_address'  => "Del palo de mango 300 sur, negocio a mano derecha",
                'GPS'               => "9.920961550250365, -84.17653869137433",
                'home'              => "local #3",
                'url'               => "/home",
            ],
        ];

        Client::insert($clients);
    }
}