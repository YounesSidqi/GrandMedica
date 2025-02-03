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
      <form id="screenopname-form" action="{{ route('screenopname.addstok', ['id' => $item->id] ) }}" method="post" class="bg-white px-8 pt-6 pb-8 mb-4">
        
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
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="total_qty">
            Total stok obat
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="total_qty" type="text" name="total_qty"  readonly value="{{$item->qty}}">
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="Jumlah_qty">
            Stok yang masuk :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="pemasukan" type="number" name="pemasukan" placeholder="Input jumlah stok yang ingin dimasukkan" >
        </div>
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="Jumlah_qty">
            Stok yang sudah keluar :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="Jumlah_qty" type="text" name="Jumlah_qty" readonly value="{{$item->pengeluaran}}" >
        </div>
        <div class="flex items-center justify-center">
          <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Tambah stok
          </button>
        </div>
      </form>
    </div>
  </div>
  {{-- <script>
    function tambahStok() {
      const tambahStokValue = parseInt(document.getElementById('tambah_stok').value) || 0;
      const itemId = "{{ $item->id }}"; // ID item obat
  
      // AJAX request untuk tambah stok
      fetch(`/api/screenopname/tambah-stok/${itemId}`, {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        body: JSON.stringify({ tambah_stok: tambahStokValue })
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Update nilai Qty dan Stok Masuk di UI
          const qtyInput = document.getElementById('qty');
          const stokMasukElement = document.getElementById('pemasukan');
  
          qtyInput.value = parseInt(qtyInput.value) + tambahStokValue;
          stokMasukElement.innerText = parseInt(stokMasukElement.innerText) + tambahStokValue;
  
          alert('Stok berhasil ditambah!');
        } else {
          alert('Gagal menambah stok!');
        }
      })
      .catch(error => console.error('Error:', error));
    }
  </script> --}}
  <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
