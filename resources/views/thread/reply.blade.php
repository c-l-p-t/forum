<div class="mt-4 bg-white shadow overflow-hidden rounded-md">
  <div class="bg-gray-100 px-4 py-5 border-b border-gray-200 sm:px-6 text-gray-900">
    <a href="#" class="text-blue-500">{{ $reply->owner->name }}</a>
    said
    <span class="">{{ $reply->created_at->diffForHumans() }}</span>
  </div>
  <div class="bg-white p-4">
    {{ $reply->body }}
  </div>
</div>