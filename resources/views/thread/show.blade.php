@extends('layouts.app')

@section('content')
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

  @foreach($thread->replies as $reply)
    @include('thread.reply')
  @endforeach
@endsection