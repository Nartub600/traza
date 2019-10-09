<?php

use App\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $product = new Product(['name' => 'Neumáticos']);
        $product->save();

        $product = new Product(['name' => 'Balizas triangulares retroreflectoras']);
        $product->save();

        $product = new Product(['name' => 'Cascos de protección para uso vehicular']);
        $product->save();

        $product = new Product(['name' => 'Cinturones de seguridad']);
        $product->save();

        $product = new Product(['name' => 'Pastillas y cintas de frenos']);
        $product->save();

        $product = new Product(['name' => 'Lí­quido de frenos']);
        $product->save();

        $product = new Product(['name' => 'Vidrios de seguridad para automotores']);
        $product->save();

        $product = new Product(['name' => 'Matafuegos']);
        $product->save();

        $product = new Product(['name' => 'Apoyacabezas']);
        $product->save();

        $product = new Product(['name' => 'Asientos y sus anclajes']);
        $product->save();

        $product = new Product(['name' => 'Sistema de enganche de remolques y semiremolques']);
        $product->save();

        $product = new Product(['name' => 'Trabas giratorias para transporte carretero de contenedores']);
        $product->save();

        $product = new Product(['name' => 'Bombas de vacío']);
        $product->save();

        $product = new Product(['name' => 'Baterías']);
        $product->save();

        $product = new Product(['name' => 'Espejos retrovisores']);
        $product->save();

        $product = new Product(['name' => 'Extremos y rótulas de dirección']);
        $product->save();

        $product = new Product(['name' => 'Amortiguadores convencionales']);
        $product->save();

        $product = new Product(['name' => 'Cajas de direccion tipo piñón y cremallera']);
        $product->save();

        $product = new Product(['name' => 'Bocinas']);
        $product->save();

        $product = new Product(['name' => 'Limpiaparabrisas']);
        $product->save();

        $product = new Product(['name' => 'Sistema de lámparas e iluminación vehicular. Faros de señalización e iluminación para vehículos de tránsito vial']);
        $product->save();

        $product = new Product(['name' => 'Ruedas de Acero']);
        $product->save();

        $product = new Product(['name' => 'Balastos para lámparas de descarga']);
        $product->save();

        $product = new Product(['name' => 'Chalecos de seguridad de alta visibilidad']);
        $product->save();

        $product = new Product(['name' => 'Cerrojos y sistemas de retención de puertas para vehí­culos M1 y N1']);
        $product->save();

        $product = new Product(['name' => 'Protección contra uso no autorizado (trabas de volante alarmas) para vehí­culos M1 y N1']);
        $product->save();

        $product = new Product(['name' => 'Sistemas de Retención infantil']);
        $product->save();

        $product = new Product(['name' => 'Sistema de reemplazo de airbag']);
        $product->save();

        $product = new Product(['name' => 'Cilindro maestro para frenos']);
        $product->save();

        $product = new Product(['name' => 'Diafragma para cámara de frenos de aire']);
        $product->save();

        $product = new Product(['name' => 'Cilindro de Rueda para frenos']);
        $product->save();

        $product = new Product(['name' => 'Flexible para frenos']);
        $product->save();

        $product = new Product(['name' => 'Cubetas para frenos']);
        $product->save();

        $product = new Product(['name' => 'Ejes de semirremolques y acoplados']);
        $product->save();

        $product = new Product(['name' => 'Paragolpes de Seguridad']);
        $product->save();

    }
}
