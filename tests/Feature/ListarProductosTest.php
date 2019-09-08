<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListarProductosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarProductos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/productos');

        // $products = Product::all();

        $response
            ->assertSuccessful()
            ->assertViewHas('products');
    }

    /** @test */
    public function noAdministradorNoPuedeListarProductos()
    {
        $certificador = factory(User::class)->state('certificador')->create();

        $response = $this
            ->actingAs($certificador)
            ->get('/productos');

        $response->assertStatus(403);

        $fabricante = factory(User::class)->state('fabricante')->create();

        $response = $this
            ->actingAs($fabricante)
            ->get('/productos');

        $response->assertStatus(403);
    }
}
