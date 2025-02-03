<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Screen Opname</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Link Font Awesome untuk ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-white">

  <!-- Icon Back dan Logo -->
  <div class="w-full flex justify-between items-center pt-6 px-4">
    <!-- Icon Back -->
    <a href="{{ url('/admin_dashboard/daftar_harga') }}" class="text-orange-500 text-2xl">
      <i class="fas fa-arrow-left"></i>
    </a>
    <!-- Logo -->
    <img src="{{ asset('assets/img/logogrand.png') }}" alt="Grand Medica Logo" class="h-12" />
  </div>
  
  <!-- Judul Edit Screen Opname -->
  <div class="text-center my-6">
    <h1 class="text-2xl font-bold">Edit Screen Opname</h1>
  </div>

  <!-- Form Input -->
  <div class="flex justify-center items-center">
    <div class="w-full max-w-md">
      <form class="bg-white px-8 pt-6 pb-8 mb-4" action="{{ route('daftarharga.update', ['id' => $item->id]) }}" method="POST">
        @if ($errors->any())
            <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 font-medium" role="alert">
              <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
              </ul>
            </div>
        @endif
        @csrf
        @method('PUT')
        
        <!-- Nama Obat -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_obat">
                Nama Obat :
            </label>
            <h1 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">{{ $item->nama_obat }}</h1>
        </div>
    
        <!-- Harga Umum -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="harga_Umum">
                Harga Umum :
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="harga_Umum" name="harga_Umum" type="text" placeholder="Input Harga Umum disini" value="{{$item->harga_Umum}}">
        </div>
    
        <!-- Harga BPJS -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="harga_BPJS">
                Harga BPJS :
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="harga_BPJS" name="harga_BPJS" type="text" placeholder="Input Harga BPJS disini" value="{{$item->harga_BPJS}}">
        </div>
    
        <!-- Harga Tender -->
        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="harga_Tender1">
                Harga Tender :
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="harga_Tender1" name="harga_Tender1" type="text" placeholder="Input Harga Tender disini" value="{{$item->harga_Tender1}}">
        </div>
        
        <!-- Harga Tender -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="harga_Tender2">
              Harga Tender :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="harga_Tender2" name="harga_Tender2" type="text" placeholder="Input Harga Tender disini" value="{{$item->harga_Tender2}}">
      </div>

      <!-- Harga Tender -->
      <div class="mb-4">
        <label class="block text-gray-700 text-sm font-bold mb-2" for="harga_Tender3">
            Harga Tender :
        </label>
        <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="harga_Tender3" name="harga_Tender3" type="text" placeholder="Input Harga Tender disini" value="{{$item->harga_Tender3}}">
    </div>
    
        <!-- Tombol Simpan Harga -->
        <div class="flex items-center justify-center">
          <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Simpan harga baru
        </button>
        </div>
    </form>
    </div>
  </div>

</body>
</html>
