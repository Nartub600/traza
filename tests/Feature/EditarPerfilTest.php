<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EditarPerfilTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function usuarioPuedeEditarSuPerfil()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/perfil');

        $response->assertSuccessful();
        $response->assertViewHas('user');

        $password = Hash::make('password');

        $data = [
            'name' => $this->faker->name,
            'username' => $this->faker->userName,
            'email' => $this->faker->safeEmail,
            'password' => $password,
            'password_confirmation' => $password
        ];

        $response = $this
            ->actingAs($user)
            ->put('/perfil/' . $user->id, $data);

        $response->assertRedirect('/');

        $user = User::find($user->id);
        $this->assertEquals($user->name, $data['name']);
        $this->assertEquals($user->username, $data['username']);
        $this->assertEquals($user->email, $data['email']);
        $this->assertTrue(Hash::check($password, $user->password));
    }
}
