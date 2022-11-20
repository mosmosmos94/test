<?php

namespace Tests\Feature\Models;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Tag;
use App\Models\Post;

class TagTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInserData()
    {
        $tag = Tag::factory()->make()->toArray();
        Tag::create($tag);
        $this->assertDatabaseHas('tags',$tag);
    }

    public function testTagRelationshipWithPost()
    {
        $count = rand(1,10);
        $tag = Tag::factory()
            ->hasPost($count)
            ->create();

        $this->assertTrue($tag->post->count() == $count);
        $this->assertTrue($tag->post->first() instanceof Post);
    }

}
