<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Post;

class PostTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInserData()
    {
        $post = Post::factory()->make()->toArray();
        Post::create($post);
        $this->assertDatabaseHas('posts', $post);

    }

    public function testPostRelationShipWithUser()
    {
        $post = Post::factory()
            ->for(User::factory())
            ->create();
        $this->assertTrue(isset($post->User->id));
        $this->assertTrue($post->User instanceof User);
    }

    public function testPostRelationshipWithTag()
    {
        $count = rand(1,10);
        $post = Post::factory()
            ->hasTags($count)
            ->create();

        $this->assertTrue($post->tags()->count() == $count);
        $this->assertTrue($post->tags->first() instanceof Tag);
    }

    public function testPostRelationshipWithComment(){
        $count = rand(1,10);
        $post = Post::factory()
            ->hasComments($count)
            ->create();
        $this->assertTrue($post->comments->count() == $count);
        $this->assertTrue($post->comments->first() instanceof Comment);
    }
}
