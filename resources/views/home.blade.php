@extends('layouts.app')

@section('content')
  <div class="bg-white shadow overflow-hidden rounded-md">
    <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6">
      <h3 class="text-lg leading-6 font-medium text-gray-900">Dashboard</h3>
    </div>

    <div class="bg-white p-4">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif

      You are logged in!
    </div>
  </div>
@endsection
