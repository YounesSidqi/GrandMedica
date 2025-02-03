@extends('layout.app')
@include('layout.nav_admin')

@section('main')
  <!-- Main Content -->
  <div id="main-content" class="ml-0 transition-all duration-300">
    <!-- Title and Action Buttons -->
    <div class="container mx-auto px-4 py-6">
      <div class="flex justify-between items-center">
        <div class="">
        <h2 class="text-2xl font-semibold">Screen Opname</h2>
        <div class="mt-4">
            <a href="{{url(('/admin_dashboard/screen_opname/add'))}}" class="bg-green-600 text-white px-6 py-3 rounded-lg hover:bg-green-700">+ Add Product</a>
      </div>
      </div>
        <div class="">
          <form action="{{ route('screenopname.home') }}" class="w-auto max-w-sm" method="GET">
            <div class="flex items-center border-b border-green-500 py-2">
              <input class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Masukkan kata kunci" aria-label="Full name" name="search"  value="{{request('search')}}">
              <button class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-sm border-4 text-white py-1 px-4 rounded" type="submit">
                Cari 
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Table -->
    <div class="container mx-auto px-4">
      @if (session('success'))
          <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400 font-medium" role="alert">
              {{ session('success') }}
          </div>
      @endif
  
      @if (session('error'))
          <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 font-medium" role="alert">
              {{ session('error') }}
          </div>
      @endif
  
      <div class="bg-white shadow-md rounded-lg overflow-x-auto">
          <table class="min-w-full table-auto">
              <thead>
                  <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                      <th class="py-3 px-6 text-left">No Seri</th>
                      <th class="py-3 px-6 text-left">Nama Obat</th>
                      <th class="py-3 px-6 text-left">Unit</th>
                      <th class="py-3 px-6 text-left">Expired</th>
                      <th class="py-3 px-6 text-center">Qty</th>
                      <th class="py-3 px-6 text-center">Pemasukan</th>
                      <th class="py-3 px-6 text-center">Pengeluaran</th>
                      <th class="py-3 px-6 text-left">Actions</th>
                  </tr>
              </thead>
              <tbody class="text-gray-700 text-sm font-light">
                  @foreach ($data as $item)
                      <tr class="border-b border-gray-200 hover:bg-gray-100">
                          <td class="py-3 px-6 text-left whitespace-nowrap">{{ $item->no_seri }}</td>
                          <td class="py-3 px-6 text-left">{{ $item->nama_obat }}</td>
                          <td class="py-3 px-6 text-left">{{ $item->unit }}</td>
                          <td class="py-3 px-6 text-left">{{ $item->exp }}</td>
                          <td class="py-3 px-6 text-center">{{ $item->qty }}</td>
                          <td class="py-3 px-6 text-center">{{ $item->pemasukan }}</td>
                          <td class="py-3 px-6 text-center">{{ $item->pengeluaran }}</td>
                          <td class="py-3 px-6 text-left">
                              <div class="flex space-x-2">
                                  <form action="{{ url('/admin_dashboard/screen_opname/edit/' . $item->id) }}" method="GET">
                                      <button type="submit" class="bg-orange-500 text-white px-5 py-2 rounded-lg hover:bg-orange-600">Edit Product</button>
                                  </form>
                                  <form action="{{ route('screenopname.delete', $item->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')">
                                      @csrf
                                      @method('DELETE')
                                      <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Delete Product</button>
                                  </form>
                              </div>
                              <div class="mt-3 flex space-x-5">
                                  <form action="{{ url('/admin_dashboard/screen_opname/tambah_stok/' . $item->id) }}" method="GET">
                                      <button type="submit" class="bg-green-500 text-white px-5 py-2 rounded-lg hover:bg-green-600">Add Stock</button>
                                  </form>
                                  <form action="{{ url('/admin_dashboard/screen_opname/pengeluaran_stok/' . $item->id) }}" method="GET">
                                      <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Out Stock</button>
                                  </form>
                                  <form action="{{ url('/admin_dashboard/screen_opname/chart-data/' . $item->id) }}" method="GET">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Chart</button>
                                </form>
                                
                              </div>
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