<?php

namespace Tests\Feature;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use App\Models\User;
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

        $thread = Thread::factory()->make();

        $this->post('/threads', $thread->toArray())->assertRedirect('/login');
    }

    /** @test */
    public function authenticated_user_can_create_a_thread()
    {
        $this->signIn();

        $this->get('threads/create')->assertOk();

        $thread = Thread::factory()->make();

        $this->followingRedirects();
        $this->post('/threads', $thread->toArray())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_view_all_threads()
    {
        $thread = Thread::factory()->create();
        $this->get('/threads')->assertSee($thread->title);
    }

    /** @test */
    public function a_user_can_view_single_thread()
    {
        $thread = Thread::factory()->create();
        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    /** @test */
    public function a_user_can_view_replies_of_a_thread()
    {
        $thread = Thread::factory()->create();
        $reply = Reply::factory()->create([
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

        $channel = Channel::factory()->create();

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

        $thread = Thread::factory()->make($overrides);

        return $this->post('/threads', $thread->toArray());
    }

    /** @test */
    public function a_user_can_filter_threads_by_a_channel()
    {
        $channel = Channel::factory()->create();

        $threadInChannel = Thread::factory()->create([
            'channel_id' => $channel->id,
        ]);

        $threadNotInChannel = Thread::factory()->create();

        $this->get('threads/' . $channel->slug)->assertSee($threadInChannel->title)->assertDontSee($threadNotInChannel->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_any_username()
    {
        $this->signIn(User::factory()->create([
            'name' => 'JohnDoe',
        ]));

        $threadByJohn = Thread::factory()->create([
            'user_id' => auth()->user()->id,
        ]);

        $threadNotByJohn = Thread::factory()->create();

        $this->get('/threads/?by=' . auth()->user()->name)
            ->assertSee($threadByJohn->title)
            ->assertDontSee($threadNotByJohn->title);
    }

    /** @test */
    public function a_user_can_filter_threads_by_popular()
    {
        $threadHasNoReply = Thread::factory()->create();

        $threadHasOneReply = Thread::factory(Thread::class)->create();
        Reply::factory()->create(['thread_id' => $threadHasOneReply->id]);

        $threadHasTwoReply = Thread::factory(Thread::class)->create();
        Reply::factory(2)->create(['thread_id' => $threadHasTwoReply->id]);

        $threadHasThreeReply = Thread::factory(Thread::class)->create();
        Reply::factory(3)->create(['thread_id' => $threadHasThreeReply->id]);

        $response = $this->getJson('/threads/?popular=1')->json();

        $this->assertEquals([3, 2, 1, 0], array_column($response, 'replies_count'));
    }
}
