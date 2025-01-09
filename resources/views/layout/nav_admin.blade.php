<!-- Sidebar (Initially hidden) -->
<div id="sidebar" class="fixed top-0 left-0 w-64 h-full bg-green-800 text-white transform -translate-x-full transition-transform duration-300">
    <div class="p-6">
      <h2 class="text-2xl font-semibold mb-4">Menu</h2>
      <nav>
        <a href="/admin_dashboard/screen_opname" class="block px-4 py-2 mb-2 hover:text-green-400 ">Screen Opname</a>
        
        <a href="/admin_dashboard/daftar_harga" class="block px-4 py-2 mb-2 hover:text-green-400">Daftar Harga</a>

        <a href="/admin_dashboard/chart-data" class="block px-4 py-2 mb-2 hover:text-green-400">Chart</a>

        <a href="/" class="block px-4 py-2 mb-2 hover:text-green-400">Back Home</a>
      </nav>
    </div>
  </div>

  <!-- Main Content -->
  <div id="main-content" class="ml-0 transition-all duration-300">
    <!-- Header -->
    <header class="flex justify-between items-center px-6 py-4 bg-white shadow">
      <!-- Hamburger Menu Button -->
      <div class="relative">
        <button id="menu-btn" class="focus:outline-none">
          <i class="fas fa-bars text-2xl text-gray-800"></i>
        </button>
      </div>

      <!-- Logo and Title -->
      <div class="absolute left-1/2 transform -translate-x-1/2">
        <img src="{{ asset('assets/img/logogrand.png') }}" alt="Grand Medica Logo" class="h-10">
      </div>

      <h1 class="text-white">.</h1>
    </header>

    <!-- Sidebar toggle script -->
  <script>
    const menuBtn = document.getElementById('menu-btn');
    const sidebar = document.getElementById('sidebar');
    const mainContent = document.getElementById('main-content');

    menuBtn.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
      if (sidebar.classList.contains('-translate-x-full')) {
        mainContent.style.marginLeft = '0';
      } else {
        mainContent.style.marginLeft = '16rem'; // Adjust this to the width of your sidebar (e.g., 16rem)
      }
    });
  </script>
