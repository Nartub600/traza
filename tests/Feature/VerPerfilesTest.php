<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class VerPerfilesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeVerPerfiles()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $role = Role::inRandomOrder()->first();

        $response = $this
            ->actingAs($administrador)
            ->get('/perfiles/' . $role->id);

        $response
            ->assertSuccessful()
            ->assertViewHas('role', $role);
    }
}
