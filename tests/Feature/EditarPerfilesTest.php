<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Permission;
use App\Role;
use Tests\TestCase;

class EditarPerfilesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function administradorPuedeEditarPerfiles()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        $role = Role::inRandomOrder()->first();
        $permissions = Permission::all()->map->id->random(3)->toArray();

        $data = [
            'name' => $this->faker->name,
            'permissions' => $permissions,
            'active' => $this->faker->boolean,
        ];

        $response = $this
            ->actingAs($administrador)
            ->put('/perfiles/' . $role->id, $data);

        $response->assertRedirect('/perfiles');

        $role = Role::findByName($data['name']);

        $this->assertNotNull($role);

        $this->assertEquals($role->active, $data['active']);

        $this->assertNotNull($role->permissions()->find($data['permissions'][0]));
        $this->assertNotNull($role->permissions()->find($data['permissions'][1]));
        $this->assertNotNull($role->permissions()->find($data['permissions'][2]));
        $this->assertCount(3, $role->permissions);
    }
}
