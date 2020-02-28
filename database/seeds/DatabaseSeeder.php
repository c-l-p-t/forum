<?php

use App\Channel;
use App\Reply;
use App\Thread;
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
        factory(Channel::class, 5)->create()->each(function ($channel) {
            factory(Thread::class, 10)->create([
                'channel_id' => $channel->id
            ])->each(function ($thread) {
                factory(Reply::class, 5)->create([
                    'thread_id' => $thread->id
                ]);
            });
        });

    }
}
