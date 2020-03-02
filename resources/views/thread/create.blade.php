@extends('layouts.app')

@section('content')
  <div class="bg-white shadow overflow-hidden rounded-md">
    <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">
        Create new thread
      </h3>
    </div>
    <div class="bg-white p-4">
      <div class="mt-4">
        <form method="POST" action="{{ route('threads.store') }}">
          @csrf

          <div class="flex mb-4">
            <label class="w-1/3" for="channel_id">Channel</label>
            <div class="w-2/3">
              <select id="channel_id" name="channel_id" class="w-full p-2 border rounded">
                <option>Select one</option>
                @foreach($channels as $channel)
                <option value="{{ $channel->id }}">{{ $channel->name }}</option>
                @endforeach
              </select>

              @error('channel_id')
              <div class="text-red-500 text-sm font-bold">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="flex mb-4">
            <label class="w-1/3" for="title">Title</label>
            <div class="w-2/3">
              <input id="title" class="w-full p-2 border rounded" name="title" value="{{ old('title') }}">

              @error('title')
              <div class="text-red-500 text-sm font-bold">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="flex mb-4">
            <label class="w-1/3" for="body">Body</label>
            <div class="w-2/3">
              <textarea id="body"
                        class="w-full p-4 border rounded"
                        name="body"
                        rows="5">{{ old('body') }}</textarea>

              @error('body')
              <div class="text-red-500 text-sm font-bold">{{ $message }}</div>
              @enderror
            </div>
          </div>

          <div class="flex mb-4">
            <div class="w-1/3"></div>
            <button class="button bg-indigo-500 text-white">Publish</button>
          </div>
        </form>
      </div>
    </div>
  </div>

@endsection