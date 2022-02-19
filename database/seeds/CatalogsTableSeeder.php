<?php

use App\Catalog;
use Illuminate\Database\Seeder;

class CatalogsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $catalogs = [
            //
            //  PERIODOS
            //
            [
                'typeName'  => "Periodo",
                'value'     => "1",         //TODOS LOS DIAS EXCEPTO DOMINGO
            ],
            [
                'typeName'  => "Periodo",
                'value'     => "2",         //DOMINGO NO SE CUENTA!!! PAGOS MARTES, JUEVES, SABADO
            ],
            [
                'typeName'  => "Periodo",
                'value'     => "3",         //DOMINGO NO SE CUENTA!!! PAGOS MARTES, VIERNES
            ],
            [
                'typeName'  => "Periodo",
                'value'     => "7",         //
            ],
            [
                'typeName'  => "Periodo",
                'value'     => "15",        //
            ],
            [
                'typeName'  => "Periodo",
                'value'     => "30",        //
            ],
            //
            //  PLAZOS
            //
            [
                'typeName'  => "Plazo",
                'value'     => "15",        //cantidad de dias prestamo
            ],
            [
                'typeName'  => "Plazo",
                'value'     => "30",        //
            ],
            [
                'typeName'  => "Plazo",
                'value'     => "40",        //
            ],
            [
                'typeName'  => "Plazo",
                'value'     => "45",        //
            ],
            [
                'typeName'  => "Plazo",
                'value'     => "60",        //
            ],
            [
                'typeName'  => "Plazo",
                'value'     => "90",        //
            ],
            //
            //  INTERESES
            //
            [
                'typeName'  => "Interes",
                'value'     => "5",        //
            ],
            [
                'typeName'  => "Interes",
                'value'     => "10",        //
            ],
            [
                'typeName'  => "Interes",
                'value'     => "15",        //
            ],
            [
                'typeName'  => "Interes",
                'value'     => "20",        //
            ],
            [
                'typeName'  => "Interes",
                'value'     => "23",        //
            ],
            [
                'typeName'  => "Interes",
                'value'     => "0",        //
            ],
            //
            //  METODO DE PAGO
            //
            [
                'typeName'  => "Metodo de pago",
                'value'     => "Efectivo",        //
            ],
            [
                'typeName'  => "Metodo de pago",
                'value'     => "Transferencia",        //
            ],
            [
                'typeName'  => "Metodo de pago",
                'value'     => "SINPE Movil",        //
            ],
            [
                'typeName'  => "Metodo de pago",
                'value'     => "Otro",        //
            ],
            //
            //  RUTA
            //
            [
                'typeName'  => "Ruta",
                'value'     => "1",        //
            ],
            [
                'typeName'  => "Ruta",
                'value'     => "2",        //
            ],
            [
                'typeName'  => "Ruta",
                'value'     => "3",        //
            ],
            [
                'typeName'  => "Ruta",
                'value'     => "4",        //
            ],
            [
                'typeName'  => "Ruta",
                'value'     => "5",        //
            ],
        ];

        Catalog::insert($catalogs);
    }
}
