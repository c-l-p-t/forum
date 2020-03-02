@extends('layouts.app')

@section('content')
  <div class="bg-white shadow overflow-hidden rounded-md">
    <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Forum Threads</h3>
    </div>
    <div class="bg-white p-4">
      @foreach($threads as $thread)
        <article>
          <h4 class="font-semibold">
            <a href="{{ $thread->path() }}" class="text-blue-500">
              {{ $thread->title }}
            </a>
          </h4>

          <div class="mt-2 mb-4 flex flex-col sm:mt-0 sm:flex-row sm:flex-wrap text-gray-500 text-xs">
            <div class="mt-2 flex items-center leading-5 sm:mr-6">
              <svg class="flex-shrink-0 mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10 9C11.6569 9 13 7.65685 13 6C13 4.34315 11.6569 3 10 3C8.34315 3 7 4.34315 7 6C7 7.65685 8.34315 9 10 9ZM3 18C3 14.134 6.13401 11 10 11C13.866 11 17 14.134 17 18H3Z" fill="#4A5568"/>
              </svg>
              {{ $thread->creator->name }}
            </div>
            <div class="mt-2 flex items-center leading-5 sm:mr-6">
              <svg class="flex-shrink-0 mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M3.17157 5.17157C4.73367 3.60948 7.26633 3.60948 8.82843 5.17157L10 6.34315L11.1716 5.17157C12.7337 3.60948 15.2663 3.60948 16.8284 5.17157C18.3905 6.73367 18.3905 9.26633 16.8284 10.8284L10 17.6569L3.17157 10.8284C1.60948 9.26633 1.60948 6.73367 3.17157 5.17157Z" fill="#4A5568"/>
              </svg>
              {{ $thread->replies_count }}
            </div>
            <div class="mt-2 flex items-center leading-5">
              <svg class="flex-shrink-0 mr-1 h-4 w-4" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path>
              </svg>
              Published on {{ $thread->created_at->diffForHumans() }}
            </div>
          </div>

          <div>{{ $thread->body }}</div>
        </article>

        <hr class="my-6">
      @endforeach
    </div>
  </div>
@endsection