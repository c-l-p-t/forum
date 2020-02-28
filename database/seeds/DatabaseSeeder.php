<?php

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
        factory(Thread::class, 50)->create()->each(function ($thread) {
            factory(Reply::class, 10)->create([
                'thread_id' => $thread->id
            ]);
        });
    }
}
