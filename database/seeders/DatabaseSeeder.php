<?php

namespace Database\Seeders;

use App\Models\Channel;
use App\Models\Reply;
use App\Models\Thread;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Channel::factory()->create()->each(function ($channel) {
            Thread::factory()->create([
                'channel_id' => $channel->id
            ])->each(function ($thread) {
                Reply::factory()->create([
                    'thread_id' => $thread->id
                ]);
            });
        });

    }
}
