<?php

namespace Tests\Feature;

use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ParticipateInForumTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function guest_can_not_participate_in_forum_threads()
    {
        $this->expectException(AuthenticationException::class);
        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make();
        $this->post($thread->path() . '/replies', $reply->toArray());
    }

    /** @test */
    public function authenticated_user_may_participate_in_forum_threads()
    {
        $this->signIn();

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make();
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())->assertSee($reply->body);
    }

    /** @test */
    public function a_reply_requires_a_body()
    {
        $this->withExceptionHandling()->signIn();

        $thread = Thread::factory()->create();

        $reply = Reply::factory()->make([
            'body' => null
        ]);
        $this->post($thread->path() . '/replies', $reply->toArray())->assertSessionHasErrors('body');
    }
}
