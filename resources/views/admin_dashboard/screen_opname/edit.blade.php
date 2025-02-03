@extends('layout.app')
@include('layout.nav_admin')

@section('main')

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
  
  <!-- Judul Edit Screen Opname -->
  <div class="text-center my-6">
    <h1 class="text-2xl font-bold">Edit Screen Opname</h1>
  </div>

  <!-- Form Input -->
  <div class="flex justify-center items-center">
    <div class="w-full max-w-md">
      <form class="bg-white px-8 pt-6 pb-8 mb-4" action="{{ route('screenopname.update', ['id' => $item->id] ) }}" method="POST">
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
        <!-- No Seri -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="no_seri">
            No Seri :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline {{ $errors->has('qty') ? 'border-red-500' : '' }}" id="no_seri" name="no_seri" type="text" value="{{$item->no_seri}}">
        </div>

        <!-- Nama Obat -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="nama_obat">
            Nama Obat :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="nama_obat" name="nama_obat" type="text" value="{{ $item ? $item->nama_obat : ''}}">
        </div>

        <!-- Unit -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="unit">
            Unit :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="unit" name="unit" type="text" value="{{ $item ? $item->unit : ''}}">
        </div>

        <!-- Expired -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="exp">
            Expired :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="exp" name="exp" type="text" value="{{ $item ? $item->exp : ''}}">
        </div>

        <!-- Qty -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2" for="qty">
            Qty :
          </label>
          <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="qty" name="qty" value="{{$item ? $item->qty : ''}}">
            
        </div>

        

        <!-- Tombol Simpan Stok -->
        <div class="flex items-center justify-center">
          <button class="bg-orange-500 hover:bg-orange-600 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
            Simpan stok
          </button>
        </div>
      </form>
    </div>
  </div>

  @endsection
