@extends('layout.app')
@include('layout.nav_admin')

@section('main')

<div class="p-6">
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-2xl font-bold">Transaction Details</h1>
    <form action="" method="GET" class="flex space-x-2">
      <input type="text" name="search" placeholder="Masukkan kata kunci" class="border border-gray-300 rounded px-3 py-1">
      <button type="submit" class="bg-green-600 text-white px-4 py-1 rounded hover:bg-green-700">Cari</button>
    </form>
  </div>

  <div class="bg-white shadow-md rounded-lg overflow-hidden">
    <!-- Table Header -->
    <div class="grid grid-cols-6 bg-gray-100 text-gray-700 font-semibold px-6 py-3 border-b">
      <div>No Transaction</div>
      <div>Date</div>
      <div class="text-center">Cashier</div>
      <div class="text-center">Qty</div>
      <div class="text-center">Amount</div>
    </div>

    @foreach ($transactionsGrouped as $trxId => $details)
    @php
      $first = $details->first();
      $totalQty = $details->sum('total_qty');
      $totalAmount = $details->sum('harga_total');
    @endphp

    <!-- Summary Row -->
    <div class="grid grid-cols-6 px-6 py-3 border-b border-t items-center hover:bg-gray-50 cursor-pointer" onclick="toggleDetail('{{ $trxId }}')">
        <div class="flex items-center">
            <svg id="icon-{{ $trxId }}" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2 transform transition-transform duration-300" viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 111.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        {{ $trxId }}
        </div>
        <div>{{ \Carbon\Carbon::parse($first->created_at)->timezone('Asia/Makassar')->translatedFormat('d F Y, H:i') }} WITA</div>
        <div class="text-center">Ones</div>
        <div class="text-center">{{ $totalQty }}</div>
        <div class="text-center">Rp{{ number_format($totalAmount, 0, ',', '.') }}
        </div>
        <div class="justify-end items-end flex">
            {{-- <form action="{{ route('printstruk') }}" method="GET"> --}}
                <a href="{{ route('printstruk', ['transaction_id' => $trxId]) }}" target="_blank" class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600">
                    Print Struk
                  </a>
                  
              </form>
              
        </div>
    </div>

    <!-- Detail Row -->
    <div id="detail-{{ $trxId }}" class="hidden px-6 pb-4">
      <div class="grid grid-cols-5 text-sm text-gray-600 mt-3 font-medium border-b pb-1">
        <div>Nama Obat</div>
        <div>Exp</div>
        <div>Harga per Obat</div>
        <div>Qty</div>
        <div>Total Harga</div>
      </div>
      @foreach ($details as $item)
      <div class="grid grid-cols-5 text-sm text-gray-800 mt-2">
        <div>{{ $item->nama_obat }}</div>
        <div>{{ \Carbon\Carbon::parse($item->exp)->translatedFormat('d F, Y') }}</div>
        <div>Rp{{ number_format($item->harga_Umum, 0, ',', '.') }}</div>
        <div>{{ $item->total_qty }}</div>
        <div>Rp{{ number_format($item->harga_total, 0, ',', '.') }}</div>
      </div>
      @endforeach
    </div>
    @endforeach
  </div>

  <!-- Pagination Links -->
  <div class="my-6">
    {{ $transactions->links('pagination::tailwind') }}
  </div>
</div>

<script>
  function toggleDetail(id) {
    const content = document.getElementById(`detail-${id}`);
    const icon = document.getElementById(`icon-${id}`);
    
    content.classList.toggle('hidden');
    icon.classList.toggle('rotate-90'); // ini akan putar panah dari kanan ke bawah
  }
</script>

@endsection
