<?php

namespace Tests\Feature;

use App\Models\Recets;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RecetsControllerTest extends TestCase
{

    use RefreshDatabase;

    /** @test */
    public function list_of_recets()
    {
        $user = User::factory()->create();
        $receta = Recets::factory(['user_id' => $user->id])->create();

        $response = $this->getJson('/api/recetas');

        $response->assertOk();
        $response->assertJson([$receta->toArray()]);
    }

    /** @test */
    public function a_user_can_create_a_recets() {
        $user = User::factory()->create();
        $this->actingAs($user);

        $response = $this->postJson('/api/recetas', [
            'title' => 'This is tha title of my recets',
            'descripcion' => 'Esta es la descripcion of my recets'
        ]);

        $response->assertCreated();
        $response->assertJson([
            'receta' => [
                'title' => 'This is tha title of my recets',
                'descripcion' => 'Esta es la descripcion of my recets'
            ]
        ]);

        $this->assertDatabaseHas('recets', [
            'title' => 'This is tha title of my recets',
            'descripcion' => 'Esta es la descripcion of my recets',
        ]);
    }

    /** @test */
    public function actualizar_una_receta() {
        $user = User::factory()->create();
        $receta = Recets::factory(['user_id'=>$user->id])->create();
        $this->actingAs($user);


        $response = $this->putJson('/api/recetas/'. $receta->id, [
            'title' => 'This is the updated title',
            'descripcion' => 'Esta es la descripcion de mi receta actualizada'
        ]);

        $response->assertOk();
        $response->assertJson([
           'receta' => [
                'title' => 'This is the updated title',
                'descripcion' => 'Esta es la descripcion de mi receta actualizada'
            ]
        ]);

        $this->assertDatabaseHas('recets', [
            'id' => $receta->id,
            'title' => 'This is the updated title',
            'descripcion' => 'Esta es la descripcion de mi receta actualizada'
        ]);

        $this->assertDatabaseMissing('recets', [
            'title' => $receta->title,
            'descripcion' => $receta->descripcion
        ]);
    }

    /** @test */
    public function borrar_una_receta ()
    {
        $user = User::factory()->create();
        $receta = Recets::factory(['user_id' => $user->id])->create();
        $this->actingAs($user);

        $response = $this->deleteJson("/api/recetas/{$receta->id}");

        $response->assertNoContent();
        $this->assertDatabaseMissing('recets', [
            'title' => $receta->title,
            'descripcion' => $receta->descripcion
        ]);
    }

}
