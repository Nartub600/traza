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
        Product::create(['name' => 'Neumáticos']);
        Product::create(['name' => 'Balizas triangulares retroreflectoras']);
        Product::create(['name' => 'Cascos de protección para uso vehicular']);
        Product::create(['name' => 'Cinturones de seguridad']);
        Product::create(['name' => 'Pastillas y cintas de frenos']);
        Product::create(['name' => 'Lí­quido de frenos']);
        Product::create(['name' => 'Vidrios de seguridad para automotores']);
        Product::create(['name' => 'Matafuegos']);
        Product::create(['name' => 'Apoyacabezas']);
        Product::create(['name' => 'Asientos y sus anclajes']);
        Product::create(['name' => 'Sistema de enganche de remolques y semiremolques']);
        Product::create(['name' => 'Trabas giratorias para transporte carretero de contenedores']);
        Product::create(['name' => 'Bombas de vacío']);
        Product::create(['name' => 'Baterías']);
        Product::create(['name' => 'Espejos retrovisores']);
        Product::create(['name' => 'Extremos y rótulas de dirección']);
        Product::create(['name' => 'Amortiguadores convencionales']);
        Product::create(['name' => 'Cajas de direccion tipo piñón y cremallera']);
        Product::create(['name' => 'Bocinas']);
        Product::create(['name' => 'Limpiaparabrisas']);
        Product::create(['name' => 'Sistema de lámparas e iluminación vehicular. Faros de señalización e iluminación para vehículos de tránsito vial']);
        Product::create(['name' => 'Ruedas de Acero']);
        Product::create(['name' => 'Balastos para lámparas de descarga']);
        Product::create(['name' => 'Chalecos de seguridad de alta visibilidad']);
        Product::create(['name' => 'Cerrojos y sistemas de retención de puertas para vehí­culos M1 y N1']);
        Product::create(['name' => 'Protección contra uso no autorizado (trabas de volante alarmas) para vehí­culos M1 y N1']);
        Product::create(['name' => 'Sistemas de Retención infantil']);
        Product::create(['name' => 'Sistema de reemplazo de airbag']);
        Product::create(['name' => 'Cilindro maestro para frenos']);
        Product::create(['name' => 'Diafragma para cámara de frenos de aire']);
        Product::create(['name' => 'Cilindro de Rueda para frenos']);
        Product::create(['name' => 'Flexible para frenos']);
        Product::create(['name' => 'Cubetas para frenos']);
        Product::create(['name' => 'Ejes de semirremolques y acoplados']);
        Product::create(['name' => 'Paragolpes de Seguridad']);
    }
}
