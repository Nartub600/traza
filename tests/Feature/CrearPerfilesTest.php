<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CrearPerfilesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeCrearPerfiles()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $permissions = Permission::all()->map->id->random(3)->toArray();

        $data = [
            'name' => $this->faker->name,
            'permissions' => $permissions
        ];

        $response = $this
            ->actingAs($administrador)
            ->post('/perfiles', $data);

        $response->assertRedirect('/perfiles');

        $role = Role::findByName($data['name']);

        $this->assertNotNull($role);

        $this->assertNotNull($role->permissions()->find($data['permissions'][0]));
        $this->assertNotNull($role->permissions()->find($data['permissions'][1]));
        $this->assertNotNull($role->permissions()->find($data['permissions'][2]));
        $this->assertCount(3, $role->permissions);
    }
}
