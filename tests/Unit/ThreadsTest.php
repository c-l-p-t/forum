<?php

namespace Tests\Unit;

use App\Channel;
use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThreadsTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $thread;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->thread = factory(Thread::class)->create();
    }

    /** @test */
    public function it_has_a_path()
    {
        $this->assertEquals(route('threads.show', [$this->thread->channel->slug, $this->thread->id]), $this->thread->path());
    }

    /** @test */
    public function it_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /** @test */
    public function it_has_a_creator()
    {
        $this->assertInstanceOf(User::class, $this->thread->creator);
    }

    /** @test */
    public function it_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'New reply',
            'user_id' => 1
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    /** @test */
    public function it_belongs_to_a_channel()
    {
        $this->assertInstanceOf(Channel::class, $this->thread->channel);
    }
}
