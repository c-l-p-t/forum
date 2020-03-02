<?php

namespace Tests\Feature;

use App\Channel;
use App\Reply;
use App\Thread;
use App\User;
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

    /** @test */
    public function a_thread_requires_a_title()
    {
        $this->publishThread([
            'title' => null
        ])->assertSessionHasErrors('title');

    }

    /** @test */
    public function a_thread_requires_a_body()
    {
        $this->publishThread([
            'body' => null
        ])->assertSessionHasErrors('body');

    }

    /** @test */
    public function a_thread_requires_a_valid_channel()
    {
        $this->publishThread([
            'channel_id' => null
        ])->assertSessionHasErrors('channel_id');

        $channel = factory(Channel::class)->create();

        $this->publishThread([
            'channel_id' => $channel->id
        ])->assertSessionHasNoErrors();

        $this->publishThread([
            'channel_id' => $channel->id + 1
        ])->assertSessionHasErrors('channel_id');
    }

    protected function publishThread($overrides = [])
    {
        $this->withExceptionHandling()->signIn();

        $thread = factory(Thread::class)->make($overrides);

        return $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function a_user_can_filter_threads_by_a_channel()
    {
        $channel = factory(Channel::class)->create();

        $threadInChannel = factory(Thread::class)->create([
            'channel_id' => $channel->id,
        ]);

        $threadNotInChannel = factory(Thread::class)->create();

        $this->get('threads/' . $channel->slug)->assertSee($threadInChannel->title)->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(factory(User::class)->create([
            'name' => 'JohnDoe',
        ]));

        $threadByJohn = factory(Thread::class)->create([
            'user_id' => auth()->user()->id,
        ]);

        $threadNotByJohn = factory(Thread::class)->create();

        $this->get('/threads/?by=' . auth()->user()->name)
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }
}
