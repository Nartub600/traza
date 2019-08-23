<?php

namespace Tests\Feature;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VerProductosTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPudeVerProductos()
    {
        $administrador = factory(User::class)->state('administrador')->create();

        $product = factory(Product::class)->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/productos/' . $product->id);

        $response
            ->assertSuccessful()
            ->assertViewHas('product', $product);
    }
}
