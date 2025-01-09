{{-- <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add Harga Obat</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Link Font Awesome untuk ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100">

  <!-- Icon Back dan Logo -->
  <div class="w-full flex justify-between items-center pt-6 px-4">
    <!-- Icon Back -->
    <a href="{{ url('/admin_dashboard/daftar_harga') }}" class="text-orange-500 text-2xl">
      <i class="fas fa-arrow-left"></i>
    </a>
    <!-- Logo -->
    <img src="{{ asset('assets/img/logogrand.png') }}" alt="Grand Medica Logo" class="h-12" />
  </div>

  <!-- Container -->
  <div class="max-w-lg mx-auto mt-10">

    <!-- Title -->
    <h1 class="text-2xl font-bold text-center mb-8">Add Harga Obat</h1>

    <!-- Form -->
    <form class="bg-white p-6 rounded-lg shadow-lg" action="{{ route('daftarharga.post') }}" method="post">
      
      @if ($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 font-medium" role="alert">
          <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      @csrf
      
      <!-- Nama Obat -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="namaObat">
          Nama Obat :
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
               id="namaObat" 
               type="text" 
               name="nama_obat" 
               placeholder="Input nama obat disini" 
               value="{{ old('nama_obat') }}">
      </div>

      <!-- Harga Umum -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="hargaUmum">
          Harga Umum :
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
               id="hargaUmum" 
               type="text" 
               name="harga_Umum" 
               placeholder="Input harga Umum disini" 
               value="{{ old('harga_Umum') }}">
      </div>

      <!-- Harga BPJS -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="hargaBpjs">
          Harga BPJS :
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
               id="hargaBpjs" 
               type="text" 
               name="harga_BPJS" 
               placeholder="Input harga BPJS disini" 
               value="{{ old('harga_BPJS') }}">
      </div>

      <!-- Harga Tender -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="hargaTender">
          Harga Tender :
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
               id="hargaTender" 
               type="text" 
               name="harga_Tender" 
               placeholder="Input harga Tender disini" 
               value="{{ old('harga_Tender') }}">
      </div>

      <!-- Button -->
      <div class="flex items-center justify-center">
        <button class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
          Simpan harga
        </button>
      </div>
      
    </form>
  </div>

</body>
</html> --}}
