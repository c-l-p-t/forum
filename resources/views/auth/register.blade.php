@extends('layouts.app')

@section('content')
  <div class="w-1/2 mx-auto bg-white shadow overflow-hidden rounded-md">
    <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">{{ __('Register') }}</h3>
    </div>

    <div class="p-4">
      <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="flex mb-4">
          <label for="name" class="w-1/3 p-2 text-right">{{ __('Name') }}</label>

          <div class="w-2/3 px-2">
            <input id="name"
                   type="text"
                   class="border p-2 rounded @error('name') border-red-600 @enderror"
                   name="name"
                   value="{{ old('name') }}"
                   required
                   autocomplete="name"
                   autofocus>

            @error('name')
            <div class="text-xs text-red-600" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="flex mb-4">
          <label for="email" class="w-1/3 p-2 text-right">{{ __('E-Mail Address') }}</label>

          <div class="w-2/3 px-2">
            <input id="email"
                   type="email"
                   class="border p-2 rounded @error('email') border-red-600 @enderror"
                   name="email"
                   value="{{ old('email') }}"
                   required
                   autocomplete="email">

            @error('email')
            <div class="text-xs text-red-600" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="flex mb-4">
          <label for="password" class="w-1/3 p-2 text-right">{{ __('Password') }}</label>

          <div class="w-2/3 px-2">
            <input id="password"
                   type="password"
                   class="border p-2 rounded @error('password') border-red-600 @enderror"
                   name="password"
                   required
                   autocomplete="new-password">

            @error('password')
            <div class="text-xs text-red-600" role="alert">
              {{ $message }}
            </div>
            @enderror
          </div>
        </div>

        <div class="flex mb-4">
          <label for="password-confirm"
                 class="w-1/3 p-2 text-right">{{ __('Confirm Password') }}</label>

          <div class="w-2/3 px-2">
            <input id="password-confirm"
                   type="password"
                   class="border p-2 rounded"
                   name="password_confirmation"
                   required
                   autocomplete="new-password">
          </div>
        </div>

        <div class="flex mb-4 mb-0">
          <div class="w-1/3 p-2"></div>
          <div class="w-2/3 px-2">
            <button type="submit" class="button bg-indigo-500 hover:bg-indigo-600 text-white">
              {{ __('Register') }}
            </button>
          </div>
        </div>
      </form>
    </div>
  </div>
@endsection
