<?php

namespace Tests\Feature\Models;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;
    // ddd
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testInserData()
    {
        $user = User::factory()->make()->toArray();
        $user['password'] = 1234;
        User::create($user);
        $this->assertDatabaseHas('users', $user);

    }

    public function testUserRelationshipWithPost(){
        $count = rand(1,10);
        $user = User::factory()
            ->hasPosts($count)
            ->create();
        $this->assertTrue($user->posts->count() == $count);
        $this->assertTrue($user->posts->first() instanceof Post);
    }

    public function testUserRelationshipWithComments(){
        $count = rand(1,10);
        $user = User::factory()
            ->hasComments($count)
            ->create();
        $this->assertTrue($user->comments->count() == $count);
        $this->assertTrue($user->comments->first() instanceof Comment);
    }
}
