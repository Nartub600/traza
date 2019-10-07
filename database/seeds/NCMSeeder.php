<?php

use App\NCM;
use Illuminate\Database\Seeder;

class NCMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        NCM::create([
            'category' => '8708.40.1',
            'description' => 'Cajas de cambio de los vehículos de las subpartidas 8701. 10, 8701. 30, 8701. 91 a 8701. 95 u 8704. 10',
            'active' => true
        ]);

        NCM::create([
            'category' => '8708.40.11.000M',
            'description' => 'Servoasistidas, aptas para pares de entrada superiores o iguales a 750 Nm',
            'active' => true
        ]);

        NCM::create([
            'category' => '8708.40.19.000Y',
            'description' => 'Las demás',
            'active' => true
        ]);
    }
}
