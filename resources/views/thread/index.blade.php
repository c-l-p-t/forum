@extends('layouts.app')

@section('content')
  <div class="bg-white shadow overflow-hidden rounded-md">
    <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Forum</h3>
    </div>
    <div class="bg-white p-4">
      @foreach($threads as $thread)
        <article>
          <h4>
            <a href="{{ $thread->path() }}" class="text-blue-500">
              {{ $thread->title }}
            </a>
          </h4>

          <div>{{ $thread->body }}</div>
        </article>

        <hr class="my-4">
      @endforeach
    </div>
  </div>
@endsection