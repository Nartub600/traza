<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class SubirArchivoTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function administradorPuedeSubirArchivos()
    {
        $this->withoutExceptionHandling();

        $administrador = factory(User::class)->state('administrador')->create();

        Storage::fake('public');

        $file = UploadedFile::fake()->image('avatar.jpg');

        $response = $this
            ->actingAs($administrador)
            ->json('POST', '/uploads', [
                'picture' => $file,
            ]);

        $response->assertSuccessful();

        Storage::disk('public')->assertExists('/autopartes/' . $file->hashName());
    }
}
