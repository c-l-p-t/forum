<nav x-data="{ open: false }" @keydown.window.escape="open = false" class="bg-gray-800">
  <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="border-b border-gray-700">
      <div class="flex items-center justify-between h-16 px-4 sm:px-0">
        <div class="flex items-center">
          <div class="flex-shrink-0 text-white">
            {{ config('app.name', 'Laravel') }}
          </div>
          <div class="hidden md:block">
            <div class="ml-10 flex items-baseline">
              <div @click.away="open = false"
                   class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150 relative"
                   x-data="{ open: false }">
                <div @click="open = !open">
                  <button>
                    Browser
                  </button>
                </div>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="origin-top-right absolute left-0 mt-2 -mr-1 w-48 rounded-md shadow-lg">
                  <div class="py-1 rounded-md bg-white shadow-xs">
                    <a href="{{ route('threads.index') }}"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150">
                      {{ __('All Threads') }}
                    </a>
                    @auth()
                      <a href="/threads/?by={{ auth()->user()->name }}"
                         class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150">
                        {{ auth()->user()->name }}
                      </a>
                    @endauth
                  </div>
                </div>
              </div>
              <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150"
                 href="{{ route('threads.create') }}">
                {{ __('Create Thread') }}
              </a>
              <div @click.away="open = false"
                   class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150 relative"
                   x-data="{ open: false }">
                <div @click="open = !open">
                  <button>
                    Channel
                  </button>
                </div>
                <div x-show="open" x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="origin-top-right absolute left-0 mt-2 -mr-1 w-48 rounded-md shadow-lg">
                  <div class="py-1 rounded-md bg-white shadow-xs">
                    @foreach($channels as $channel)
                      <a href="/threads/{{ $channel->slug }}"
                         class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150">
                        {{ $channel->name }}
                      </a>
                    @endforeach
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="hidden md:block">
          <div class="ml-4 flex items-center md:ml-6">
            @guest
              <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150"
                 href="{{ route('login') }}">
                {{ __('Login') }}
              </a>
              @if (Route::has('register'))
                <a class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-300 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150"
                   href="{{ route('register') }}">
                  {{ __('Register') }}
                </a>
              @endif
            @else
              <div @click.away="open = false" class="ml-3 relative" x-data="{ open: false }">
                <div>
                  <button @click="open = !open"
                          class="max-w-xs flex items-center text-sm rounded-full focus:outline-none focus:shadow-solid-white transition ease-in-out duration-150">
                    <img class="h-8 w-8 rounded-full"
                         src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?&s=32"
                         alt=""/>
                  </button>
                </div>
                <div x-show="open" style="display: none;" x-transition:enter="transition ease-out duration-100"
                     x-transition:enter-start="transform opacity-0 scale-95"
                     x-transition:enter-end="transform opacity-100 scale-100"
                     x-transition:leave="transition ease-in duration-75"
                     x-transition:leave-start="transform opacity-100 scale-100"
                     x-transition:leave-end="transform opacity-0 scale-95"
                     class="origin-top-right absolute right-0 mt-2 -mr-1 w-48 rounded-md shadow-lg">
                  <div class="py-1 rounded-md bg-white shadow-xs">
                    <a href="#"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150">
                      Your Profile
                    </a>
                    <a href="#"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150">
                      Settings
                    </a>
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                       class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 transition ease-in-out duration-150">
                      {{ __('Logout') }}
                    </a>
                  </div>
                </div>
              </div>
            @endguest

          </div>
        </div>
        <div class="-mr-2 flex md:hidden">
          <button @click="open = !open"
                  class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:bg-gray-700 focus:text-white">
            <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
              <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
              <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                    stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
      </div>
    </div>
  </div>

  <div :class="{'block': open, 'hidden': !open}" class="hidden border-b border-gray-700 md:hidden">
    @guest
    @else
      <div class="pt-4 pb-3">
        <div class="flex items-center px-5 sm:px-6">
          <div class="flex-shrink-0">
            <img class="h-10 w-10 rounded-full"
                 src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}?&s=32"
                 alt=""/>
          </div>
          <div class="ml-3">
            <div class="text-base font-medium leading-none text-white">{{ Auth::user()->name }}</div>
            <div class="mt-1 text-sm font-medium leading-none text-gray-400">{{ Auth::user()->email }}</div>
          </div>
        </div>
        <div class="mt-3 px-2 sm:px-3">
          <a href="#"
             class="block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
            Your Profile
          </a>
          <a href="#"
             class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
            Settings
          </a>
          <a href="#"
             onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
             class="mt-1 block px-3 py-2 rounded-md text-base font-medium text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:text-white focus:bg-gray-700 transition ease-in-out duration-150">
            {{ __('Logout') }}
          </a>

          <form id="logout-form" class="hidden" action="{{ route('logout') }}" method="POST">
            @csrf
          </form>
        </div>
      </div>
    @endguest
  </div>
</nav>