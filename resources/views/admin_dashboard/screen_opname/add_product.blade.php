<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>GrandMedica</title>
  <script src="https://cdn.tailwindcss.com"></script>
  
  <!-- Link Font Awesome untuk ikon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-white">

  <!-- Icon Back dan Logo -->
  <div class="w-full flex justify-between items-center pt-6 px-4">
    <!-- Icon Back -->
    <a href="{{ url('/admin_dashboard/screen_opname') }}" class="text-orange-500 text-2xl">
      <i class="fas fa-arrow-left"></i>
    </a>
    <!-- Logo -->
    <img src="{{ asset('assets/img/logogrand.png') }}" alt="Grand Medica Logo" class="h-12" />
  </div>

  <!-- Logo dan judul -->
  <div class="w-full flex justify-center items-center pt-6">
    <img src="{{ asset('assets/img/logogrand.png') }}" alt="Grand Medica Logo" class="h-12" />
  </div>
  
  <!-- Judul Add Screen Opname -->
  <div class="text-center my-6">
    <h1 class="text-2xl font-bold">Add Screen Opname</h1>
  </div>

  <!-- Form Input -->
  <div class="flex justify-center items-center">
    <div class="w-full max-w-md">
      <form id="screenopname-form" action="{{ route('screenopname.post') }}" method="post" class="bg-white px-8 pt-6 pb-8 mb-4">
        
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
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="no_seri">
            No Seri :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="no_seri" type="text" name="no_seri" id="input" placeholder="Input no seri disini" value="{{old('no_seri')}}">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_obat">
            Nama Obat :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_obat" type="text" name="nama_obat" id="input" placeholder="Input nama obat disini" value="{{old('nama_obat')}}">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="qty">
            Qty :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qty" type="text" name="qty" id="input" placeholder="Input qty disini" value="{{old('qty')}}">
        </div>
        <div class="flex items-center justify-center">
          <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Simpan stok
          </button>
        </div>
      </form>
    </div>
  </div>
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
