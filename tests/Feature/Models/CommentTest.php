<?php

namespace Tests\Feature\Models;

use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Comment;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInserData()
    {
        $comment = Comment::factory()->make()->toArray();
        Comment::create($comment);
        $this->assertDatabaseHas('comments',$comment);
    }

    public function testCommentRelationshipWithPost()
    {
        $comment = Comment::factory()
            ->hasCommentable(Post::factory())
            ->create();
        $this->assertTrue($comment->commentable instanceof Post);
        $this->assertTrue(isset($comment->commentable->id));
    }

    public function testCommentRelationshipWithUser()
    {
        $comment = Comment::factory()
            ->hasUser(User::factory())
            ->create();

        $this->assertTrue(isset($comment->user->id));
        $this->assertTrue($comment->user instanceof User);
    }

}
