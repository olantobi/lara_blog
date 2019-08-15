<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;

class PostTest extends TestCase
{
    /**
     * A basic unit test example.
     *
     * @return void
     */
    public function testExample()
    {
        $this->assertTrue(true);
    }

    public function test_can_create_post() {
        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph
        ];

        $this->post(route('posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    public function test_can_update_post() {
        $post = factory(Post::class)->create();

        $data = [
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph
        ]; 

        $this->put(route('posts.update', $post->id), $data)
            ->assertStatus(200)
            ->assertJson($data);
    }

    public function test_can_show_post() {
        $post = factory(Post::class)->create();

        $this->get(route('posts.show', $post->id))
            ->assertStatus(200);
    }

    public function test_can_list_posts() {
        $posts = factory(Post::class, 2)->create()->map(function ($post) {
            return $post->only(['id', 'title', 'content']);
        });

        $this->get(route('posts.index'))
            ->assertStatus(200)
            ->assertJson($posts->toArray())
            ->assertJsonStructure([
                '*' => ['id', 'title', 'content']
            ]);
    }

    public function test_can_delete_post() {
        $post = factory(Post::class)->create();

        $this->delete(route('posts.destroy', $post->id))
            ->assertStatus(204);
    }
}
