<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostManagementTest extends TestCase
{
    // REFRESH DATABASE
    use RefreshDatabase;

    /** @test */ // Lista de datos
    public function list_of_posts(){

        // Fakes of data for posts: FICTICIOS
        $posts = Post::factory()->count(5)->create(); // datos de prueba

        $response= $this->get('/posts');

        $response->assertOk();

        $response->assertViewIs("posts.index");
        $response->assertViewHas('posts', $posts); // funciona como un compact
    }

    /** @test */ // Abrir una vista de un registro:
    public function a_posts_can_be_atrieved() {
        $posts = Post::factory()->count(5)->create();
        $post = $posts->first();
        $response = $this->get('/posts/'.$post->id);

        $response->assertOk();

        $response->assertViewIs("posts.show");
        $response->assertViewHas('post', $post);
    }

    /** @test */ // Reconoce como una prueba
    public function a_post_can_be_created()
    {
        // Desactiva el capturador de excepciones;
        // $this->withoutExceptionHandling();
        $response = $this->post('/posts', [
            '_token' => csrf_token(),
            'title' => 'Test title',
            'content'   => 'Test content',
        ]);

        // $response->assertOk();

        $post = Post::first();
        $response->assertRedirect('/posts/'.$post->id);

        $this->assertCount(1, Post::all()); // confirma si por lo menos hay un post en mi base de datos


        $this->assertEquals($post->title, 'Test title');
        $this->assertEquals($post->content, 'Test content');
    }

    /** @test */ // Reconoce como una prueba
    public function a_post_can_be_updated()
    {
        // Desactiva el capturador de excepciones;
        // $this->withoutExceptionHandling();
        $post = Post::factory()->create();

        $response = $this->put('/posts/'.$post->id, [
            'title' => 'Test title',
            'content' => 'Test content',
        ]);

        // $response->assertOk();
        $this->assertCount(1, Post::all()); // confirma si por lo menos hay un post en mi base de datos
        $post = $post->fresh();

        $this->assertEquals($post->title, 'Test title');
        $this->assertEquals($post->content, 'Test content');

        $response->assertRedirect('/posts/' . $post->id);
    }

    /** @test */ // Reconoce como una prueba
    public function a_post_can_be_deleted()
    {
        // Desactiva el capturador de excepciones;
        // $this->withoutExceptionHandling();
        $post = Post::factory()->create();

        $response = $this->delete('/posts/' . $post->id);

        // $response->assertOk();
        $this->assertCount(0, Post::all()); // confirma si por lo menos hay un post en mi base de datos

        $response->assertRedirect('/posts');
    }
}

