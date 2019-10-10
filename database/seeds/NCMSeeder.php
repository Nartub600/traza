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
            'category' => '6506.10.00',
            'description' => 'Cascos de seguridad',
            'active' => true
        ]);

        NCM::create([
            'category' => '4203.30.00',
            'description' => 'Cintos, cinturones y bandoleras',
            'active' => true
        ]);

        NCM::create([
            'category' => '6813.81.10',
            'description' => 'Pastillas',
            'active' => true
        ]);

        NCM::create([
            'category' => '8607.2',
            'description' => 'Frenos y sus partes:',
            'active' => true
        ]);

        NCM::create([
            'category' => '3819.00.00',
            'description' => 'Líquidos para frenos hidráulicos y demás líquidos preparados para transmisiones hidráulicas, sin aceites de petróleo ni de mineral bituminoso o con un contenido inferior al 70 % en peso de dichos aceites.',
            'active' => true
        ]);

        NCM::create([
            'category' => '8414.10.00',
            'description' => 'Bombas de vacío',
            'active' => true
        ]);
    }
}
