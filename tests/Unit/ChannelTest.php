<?php

namespace Tests\Unit;

use App\Models\Channel;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChannelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_consists_of_threads()
    {
        $channel = Channel::factory()->create();

        $this->assertInstanceOf(Collection::class, $channel->threads);
    }
}
