<?php

namespace Tests\Feature;

use App\Post;
use App\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * @coversNothing
 */
class PostTest extends TestCase
{
    use DatabaseTransactions;

    public function test_an_authenticated_user_can_create_a_post()
    {
        $email = config('app.admin_email');
        $user  = User::factory()->create(['email' => $email]);

        $this->actingAs($user);

        $data = [
            'title' => 'some title',
            'body'  => 'some body',
        ];

        $endpoint = route('posts.store');

        $response = $this->post($endpoint, $data);

        /** @var Post $post */
        $post = Post::query()->first();

        $response->assertRedirect($post->path());
    }

    public function test_an_authenticated_user_can_delete_a_post()
    {
        $email = config('app.admin_email');

        /** @var User $user */
        $user = User::factory()->create(['email' => $email]);

        $this->actingAs($user);

        $data = $data = Post::factory()->make();

        /** @var Post $post */
        $post = $user->posts()->save($data);

        $endpoint = route('posts.destroy', $post->slug);

        $response = $this->delete($endpoint);

        $response->assertStatus(302);
        $response->assertRedirect(route('home.posts'));
    }

    public function test_an_authenticated_user_can_update_a_post()
    {
        $email = config('app.admin_email');

        /** @var User $user */
        $user = User::factory()->create(['email' => $email]);

        /** @var Post $post */
        $post       = Post::factory()->create(['user_id' => $user->id]);
        $endpoint   = route('posts.update', $post->slug);
        $updateData = [
            'title' => 'changed title',
            'body'  => 'changed body',
        ];

        $this->actingAs($user);

        $response = $this->patch($endpoint, $updateData);
        $response->assertStatus(302);
        $response->assertRedirect(route('home.posts'));
    }

    public function test_an_unauthenticated_user_cannot_create_a_post()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $data = [
            'title' => 'some title',
            'body'  => 'some body',
        ];

        $endpoint = route('posts.store');

        $response = $this->post($endpoint, $data);

        $response->assertRedirect(route('welcome'));
    }

    public function test_the_body_and_title_attributes_are_required()
    {
        $email = config('app.admin_email');
        $user  = User::factory()->create(['email' => $email]);

        $this->actingAs($user);

        $data = [
            'title' => null,
            'body'  => null,
        ];

        $endpoint = route('posts.store');

        $response = $this->post($endpoint, $data);

        $response->assertStatus(302);
    }
}
