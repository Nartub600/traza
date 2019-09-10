<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class EditarPasswordTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function usuarioPuedeEditarSuPassword()
    {
        $this->withoutExceptionHandling();

        $user = factory(User::class)->create();

        $response = $this
            ->actingAs($user)
            ->get('/contrasenia/cambiar');

        $response->assertSuccessful();
        $response->assertViewHas('user');

        $password = Hash::make('password');

        $data = [
            'old_password'          => 'password',
            'password'              => $password,
            'password_confirmation' => $password
        ];

        $response = $this
            ->actingAs($user)
            ->put('/contrasenia/cambiar/' . $user->id, $data);

        $response->assertRedirect('/');

        $user = User::find($user->id);
        $this->assertTrue(Hash::check($password, $user->password));
    }
}
