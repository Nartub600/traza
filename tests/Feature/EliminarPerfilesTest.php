<?php

namespace Tests\Feature;

use App\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EliminarPerfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeEliminarPerfiles()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $role = Role::inRandomOrder()->first();

        $response = $this
            ->actingAs($administrador)
            ->delete('/perfiles/' . $role->id);

        $response->assertRedirect('/perfiles');

        $role = Role::onlyTrashed()->find($role->id);

        $this->assertNotNull($role);
    }
}
