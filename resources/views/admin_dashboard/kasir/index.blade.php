@extends('layout.app')
@include('layout.nav_admin')

@section('main')

<div class="container p-4">
    <div class="w-screen bg-white shadow-md p-4">
        <div class="flex gap-4 p-4 h-full">
            <!-- Bagian Kiri -->
            <div class="flex-1 bg-white shadow-md rounded-lg p-4">
            <!-- Pencarian -->
            <div class="">
                <form action="{{ route('kasir.index') }}" class="w-auto max-w-sm" method="GET">
                  <div class="flex items-center border-b border-green-500 py-2">
                    <input class="appearance-none bg-transparent border-none w-full text-gray-700 py-1 px-2 leading-tight focus:outline-none" type="text" placeholder="Masukkan kata kunci" aria-label="Full name" name="search"  value="{{request('search')}}">
                    <button class="flex-shrink-0 bg-green-500 hover:bg-green-700 border-green-500 hover:border-green-700 text-sm border-4 text-white py-1 px-4 rounded" type="submit">
                      Cari 
                    </button>
                  </div>
                </form>
              </div>


                <!-- Daftar Obat -->
                <div class="grid grid-cols-4 gap-4">
                    @foreach ($data as $item)
                    <div data-modal-target="crud-modal" data-modal-toggle="crud-modal" class="block bg-gray-100 hover:bg-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-sm">
                        <p class="text-xs font-normal text-black">{{ $item->no_seri }}</p>
                        <h3 class="font-semibold text-lg py-2 text-black">{{ $item->nama_obat }}</h3>
                        <p class="text-xs font-thin text-black">{{ $item->exp }}</p>
                    </div>
                    @endforeach
                </div>


                <!-- Main modal -->
                <div id="crud-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-md max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                                    Ordered
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crud-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>


                            <!-- Modal body -->
                            <div class="container">
                            <form class="p-4 md:p-5">
                                <div class="grid gap-4 mb-4 grid-cols-2">
                                    <div class="col-span-2">
                                        <p class="text-xs font-light text-black text-center">{{$item->exp}}</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-2xl font-light text-black text-center">{{$item->nama_obat}}</p>
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-sm font-light text-black text-start px-10">{{$item->no_seri}}</p>
                                    </div>
                                    <div class="col-span-2 px-10">
                                    <form class="max-w-sm mx-auto">
                                        <label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Pilih Harga obat</label>
                                        <select id="countries" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                        <option id="harga_Umum"  value="harga_Umum">Harga Umum{{$item->harga_Umum}}</option>
                                        <option id="harga_BPJS"  value="harga_BPJS">Harga BPJS 
                                        {{$item->harga_BPJS}}</option>
                                        <option id="harga_Tender1"  value="harga_Tender1">Harga Tender 1 {{$item->harga_Tender1}}</option>
                                        <option id="harga_Tender2"  value="harga_Tender2">Harga Tender 2 {{$item->harga_Tender2}}</option>
                                        <option id="harga_Tender3"  value="harga_Tender3">Harga Tender 3 {{$item->harga_Tender3}}</option>
                                        </select>
                                    </form>
  
                                    </div>
                                    <div class="col-span-2">
                                        <p class="text-sm font-light text-black text-start px-10">Stok : {{$item->qty}}</p>
                                    </div>
                                </div>
                                <div class="flex flex-col justify-center items-center py-3">
                                <form class="max-w-xs mx-auto">
                                    <label for="counter-input" class="block mb-1 text-sm font-medium text-gray-900 dark:text-white">Choose quantity:</label>
                                    <div class="relative flex justify-center items-center pb-3">
                                        <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                            </svg>
                                        </button>
                                        <input type="text" id="counter-input" data-input-counter class="flex-shrink-0 text-gray-900 dark:text-white border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[2.5rem] text-center" placeholder="" value="1" required />
                                        <button type="button" id="increment-button" data-input-counter-increment="counter-input" class="flex-shrink-0 bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                            <svg class="w-2.5 h-2.5 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                            </svg>
                                        </button>
                                    </div>
                                </form>
                                <button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                                    <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                                    Add new product
                                </button>
                            </div>
                            </form>
                        </div>
                        </div>
                    </div>
                </div> 
        </div>

                        <!-- Bagian Kanan -->
            <div class="w-1/3 bg-white shadow-md rounded-lg p-4 flex flex-col h-full">
                <!-- Tabel Items -->
                <div class="flex-grow overflow-y-auto">
                <table class="w-full border border-gray-300">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2 text-left">Items</th>
                        <th class="border border-gray-300 p-2 text-left">Jumlah</th>
                        <th class="border border-gray-300 p-2 text-left">Harga</th>
                        <th class="border border-gray-300 p-2 text-left">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td class="border border-gray-300 p-2">nama_obat</td>
                        <td class="border border-gray-300 p-2">qty</td>
                        <td class="border border-gray-300 p-2">harga_Umum</td>
                        <td class="border border-gray-300 p-2 text-center text-red-500">
                        <button>&#128465;</button>
                        </td>
                    </tr>
                    </tbody>
                </table>
                </div>
            
                <!-- Bagian Total dan Tombol -->
                <div class="mt-4">
                <div class="space-y-2">
                    <div class="flex justify-between">
                    <span>Subtotal:</span>
                    <span>total_harga</span>
                    </div>
                    <div class="flex justify-between">
                    <span>Jumlah Item:</span>
                    <span>total_qty</span>
                    </div>
                    <div class="flex justify-between items-center">
                    <span>Diskon:</span>
                    <span>0% <button class="text-blue-500">&#9998;</button></span>
                    </div>
                </div>
            
                <!-- Tombol -->
                <div class="mt-4 flex justify-between">
                    <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</button>
                    <button class="bg-blue-500 text-white px-4 py-2 rounded-lg">Pesan</button>
                </div>
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection