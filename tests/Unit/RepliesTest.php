<?php

namespace Tests\Unit;

use App\Models\Reply;
use App\Models\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RepliesTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @var Collection|Model
     */
    private $reply;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutExceptionHandling();

        $this->reply = Reply::factory(Reply::class)->create();
    }

    /** @test */
    public function it_has_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->reply->owner);
    }
}
