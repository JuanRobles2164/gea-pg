<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoDocumentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_documento')->insert([[
            'id' => 1,
            'nombre' => 'Cedula',
            'descripcion' => 'documento de identificación emitido en Colombia',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 2,
            'nombre' => 'RUT',
            'descripcion' => 'mecanismo único para identificar, ubicar y clasificar a los sujetos de obligaciones administradas por la DIAN',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 3,
            'nombre' => 'Factura',
            'descripcion' => 'Cuenta en la que se detallan las mercancías compradas o los servicios recibidos, junto con su cantidad y su importe, y que se entrega a quien debe pagarla',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now() 
        ],
        [
            'id' => 4,
            'nombre' => 'Comprobante',
            'descripcion' => 'Documento en el que queda constancia de la realización de algo, particularmente de haber efectuado un pago, cobro, entrega, compra, etc.',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now() 
        ],
        [
            'id' => 5,
            'nombre' => ' Pagaré',
            'descripcion' => 'Documento que extiende y entrega una persona a otra mediante el cual contrae la obligación de pagarle una cantidad de dinero en la fecha que figura en él.',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now() 
        ],
        [
            'id' => 6,
            'nombre' => 'Resumen de Cuenta',
            'descripcion' => 'documento que generamos mensualmente para que puedas visualizar por cada una de tus cuentas los movimientos y detalle de tus transacciones.',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now() 
        ],
        [
            'id' => 7,
            'nombre' => 'Contrato',
            'descripcion' => ' acuerdo legal, oral o escrito, manifestado en común entre dos o más personas con capacidad jurídica',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 8,
            'nombre' => 'Documentos fiscales',
            'descripcion' => ' comprobante con validez legal y tributaria en formato electrónico, que respalda las operaciones entre contribuyentes y los diferentes tipos de operaciones',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ],
        [
            'id' => 9,
            'nombre' => 'Licencias',
            'descripcion' => 'contrato mediante el cual una persona recibe de otra el derecho de uso, de copia, de distribución, de estudio y de modificación de varios de sus bienes.',
            'estado' => 1,
            'created_at' => now(),
            'updated_at' => now()
        ]]);
    }
}
