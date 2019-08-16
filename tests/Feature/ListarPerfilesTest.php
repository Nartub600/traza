<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ListarPerfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeListarPerfiles()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $response = $this
            ->actingAs($administrador)
            ->get('/perfiles');

        $roles = Role::withCount('users')->get();

        $response
            ->assertSuccessful()
            ->assertViewHas('roles', $roles);
    }
}
