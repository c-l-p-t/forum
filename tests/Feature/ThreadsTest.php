<?php

namespace Tests\Feature;

use App\Reply;
use App\Thread;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();
    }

    /** @test */
    public function guest_can_not_create_a_thread()
    {
        $this->withExceptionHandling();

        $this->get('threads/create')->assertRedirect('/login');

        $thread = factory(Thread::class)->make();

        $this->post('/threads', $thread->toArray())->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_create_a_thread()
    {
        $this->signIn();

        $this->get('threads/create')->assertOk();

        $thread = factory(Thread::class)->make();

        $this->followingRedirects();
        $this->post('/threads', $thread->toArray())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = factory(Thread::class)->create();
        $this->get('/threads')->assertSee($thread->title);
    }

    /** @test */
    public function a_user_can_view_single_thread()
    {
        $thread = factory(Thread::class)->create();
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_view_replies_of_a_thread()
    {
        $thread = factory(Thread::class)->create();
        $reply = factory(Reply::class)->create([
            'thread_id' => $thread->id,
        ]);

        $this->get($thread->path())->assertSee($reply->body);
    }
}
