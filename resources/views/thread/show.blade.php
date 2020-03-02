@extends('layouts.app')

@section('content')
  <div class="flex -mx-4">

    <div class="w-2/3 px-2">
      <div class="bg-white shadow overflow-hidden rounded-md">
        <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
          <h3 class="text-lg leading-6 font-medium text-gray-900">
            <a href="#" class="text-blue-500">{{ $thread->creator->name }}</a>
            posted:
            {{ $thread->title }}
          </h3>
        </div>
        <div class="bg-white p-4">
          {{ $thread->body }}
        </div>
      </div>

      @auth()
        <div class="mt-4">
          <form method="POST" action="{{ route('threads.reply.store', [$thread->channel->slug, $thread->id]) }}">
            @csrf
            <div class="mb-4">
              <label for="body">
              <textarea id="body"
                        class="w-full p-4 border rounded"
                        name="body"
                        rows="5"></textarea>
              </label>
            </div>

            <button class="button bg-indigo-500 text-white">Post</button>
          </form>
        </div>
      @else
        <div class="mt-4 bg-white shadow overflow-hidden rounded-md">
          <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
            <p class="text-center">Please
              <a href="{{ route('login') }}" class="text-blue-500">sign in</a>
              to reply in forum threads
            </p>
          </div>
        </div>
      @endauth

      @foreach($replies as $reply)
        @include('thread.reply')
      @endforeach

      <div class="mt-4">
        {{ $replies->links() }}
      </div>
    </div>

    <div class="w-1/3 px-2">
      <div class="bg-white shadow overflow-hidden rounded-md">
        <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
          This post was published {{ $thread->created_at->diffForHumans() }} by
          <a href="#" class="text-blue-500">{{ $thread->creator->name }}</a>
          , and currently has {{ $thread->replies_count }} {{ Str::plural('comment', $thread->replies_count) }}.
        </div>
      </div>
    </div>

  </div>

@endsection