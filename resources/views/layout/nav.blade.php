<header class="flex items-center justify-between p-4 bg-white shadow">
  <div class="flex items-center space-x-2">
      <img src="{{ asset('assets/img/logogrand.png') }}" alt="Logo" class="h-10">
  </div>
  <div class="flex-grow mx-8">
      <input type="text" placeholder="Cari obatmu disini" class="w-1/2 px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:ring-orange-300">
  </div>
  <div class="flex items-center space-x-4">
      <!-- Only visible for guest users -->
      @guest
      <a href="{{ url('/sign-in') }}" class="px-4 py-2 text-white bg-green-800 hover:bg-green-700 rounded-lg">
          Sign In
      </a>
      @endguest

      <!-- Only visible for authenticated users -->
      @auth
      <!-- Admin Dashboard Button -->
      <a href="{{ url('/admin_dashboard/screen_opname') }}" class="px-4 py-2 text-white bg-green-800 hover:bg-green-700 rounded-lg">
          Admin Dashboard
      </a>
      <form action="{{ route('logout') }}" method="POST" class="inline">
        @csrf
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-500">
            Logout
        </button>
    </form>
    
      <img src="https://via.placeholder.com/40" alt="User" class="w-10 h-10 rounded-full">
      @endauth
  </div>
</header>
