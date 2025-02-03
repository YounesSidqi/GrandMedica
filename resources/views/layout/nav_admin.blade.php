

<!-- drawer component -->
<div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-64 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
   <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu</h5>
   <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
     <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
     </svg>
     <span class="sr-only">Close menu</span>
  </button>
 <div class="py-4 overflow-y-auto">
     <ul class="space-y-2 font-medium">
        <li>
           <a href="/admin_dashboard/screen_opname" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
              <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                 <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                 <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
              </svg>
              <span class="ms-3">Screen Opname</span>
           </a>
        </li>
        <li>
          <a href="/admin_dashboard/daftar_harga" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
             <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
             </svg>
             <span class="ms-3">Daftar Harga</span>
          </a>
       </li>
       <li>
        <a href="{{ url('/admin_dashboard/kasir') }}" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
           <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
              <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
              <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
           </svg>
           <span class="ms-3">Kasir</span>
        </a>
     </li>
       <li>
        <a href="/" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
           <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
              <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
              <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
           </svg>
           <span class="ms-3">Back to Home</span>
        </a>
     </li>
     </ul>
  </div>
</div>


  <!-- Main Content -->
  <div id="main-content" class="ml-0 transition-all duration-300">
    <!-- Header -->
    <header class="flex justify-between items-center px-6 py-4 bg-white shadow">
      <!-- Hamburger Menu Button -->
      <div class="relative">
        <button id="menu-btn" class="focus:outline-none" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation">
          <i class="fas fa-bars text-2xl text-gray-800"></i>
        </button>
      </div>

      <!-- Logo and Title -->
      <div class="absolute left-1/2 transform -translate-x-1/2">
        <img src="{{ asset('assets/img/logogrand.png') }}" alt="Grand Medica Logo" class="h-10">
      </div>

      <h1 class="text-white">.</h1>
    </header>




    {{-- <!-- Sidebar (Initially hidden) -->
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


    {{-- <!-- Sidebar toggle script -->
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
  </script> --}}
