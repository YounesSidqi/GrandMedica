@extends('layout.app')
@include('layout.nav_admin')

@section('main')

  <!-- Main Content -->
  <div id="main-content" class="ml-0 transition-all duration-300">
    <!-- Header -->
    

    <!-- Title and Add Button -->
  <div class="container mx-auto px-4 py-6">
    <div class="flex justify-between items-center">
      <h2 class="text-2xl font-semibold text-center">Daftar Harga</h2>
    <form action="{{ route('daftarharga.home') }}" class="w-auto max-w-sm mr-4" method="GET">
            <div class="flex items-center border-b border-green-500 py-2">
              <input class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Masukkan kata kunci" aria-label="Full name" name="search"  value="{{request('search')}}">
              <button class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-sm border-4 text-white py-1 px-4 rounded" type="submit">
                Cari 
              </button>
            </div>
          </form>
        </div>
  </div>

    <!-- Table -->
  <div class="container mx-auto px-4">
    @if (session('success'))
      <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 font-medium" role="alert">
        {{session('success')}}
      </div>
  @endif
    <div class="bg-white shadow-md rounded-lg overflow-x-auto">
      <table class="min-w-full table-auto">
        <thead>
          <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
            <th class="py-3 px-6 text-left">Nama Obat</th>
            <th class="py-3 px-6 text-left">Expired</th>
            <th class="py-3 px-6 text-center">Harga Umum</th>
            <th class="py-3 px-6 text-center">Harga BPJS</th>
            <th class="py-3 px-6 text-center">Harga Tender 1</th>
            <th class="py-3 px-6 text-center">Harga Tender 2</th>
            <th class="py-3 px-6 text-center">Harga Tender 3</th>
            <th class="py-3 px-6 text-left"></th>
          </tr>
        </thead>
        <tbody class="text-gray-700 text-sm">
          <!-- Row 1 -->
          @foreach ($data as $item)
          <tr class="border-b border-gray-200 hover:bg-gray-100">
            <td class="py-3 px-6 text-left">{{ $item->nama_obat }}</td>
            <td class="py-3 px-6 text-left">{{ $item->exp }}</td>
            <td class="py-3 px-6 text-center">Rp{{ $item->harga_Umum }}</td>
            <td class="py-3 px-6 text-center">Rp{{ $item->harga_BPJS }}</td>
            <td class="py-3 px-6 text-center">Rp{{ $item->harga_Tender1 }}</td>
            <td class="py-3 px-6 text-center">Rp{{ $item->harga_Tender2 }}</td>
            <td class="py-3 px-6 text-center">Rp{{ $item->harga_Tender3 }}</td>
            <td class="py-3 px-6 text-left">
              <a href="{{ route('daftarharga.edit', ['id' => $item->id]) }}" class="bg-orange-500 text-white px-4 py-2 rounded-lg hover:bg-orange-600 mr-2">Edit Product</a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    <div class="my-6">
      {{$data->links('pagination::tailwind')}}
  </div>
  </div>
  </div>

  @endsection