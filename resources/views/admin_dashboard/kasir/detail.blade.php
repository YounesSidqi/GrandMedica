@extends('layout.app')
@section('main')

<div class="flex overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md h-auto">
        <form action="{{ route('modal.addtocart', ['id' => $data3->id] ) }}" method="post">
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
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow ">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <!-- Icon Back dan Logo -->
                    <div class="w-auto flex px-4">
                        <!-- Icon Back -->
                        <a href="{{ url('/admin_dashboard/kasir') }}" class="text-orange-500 text-2xl">
                        <i class="fas fa-arrow-left"></i>
                        </a>
                    </div>
                    <h3 class="text-lg font-semibold text-black ">
                        Ordered
                    </h3>
                    <div class="w-auto flex px-4">
                        <!-- Icon Back -->
                        <div class="text-white text-2xl">
                            <i class="fas fa-arrow-left"></i>
                        </div>
                    </div>
                </div>


                <!-- Modal body -->
                <div class="container">
                    <div class="p-4 md:p-5">
                        <div class="grid gap-4 mb-4 grid-cols-2 pt-3">
                            {{-- @if ($data) --}}
                            <div class="col-span-2">
                                <p class="text-xs font-light text-black text-center" name="no_seri">{{$data1->no_seri}}
                                </p>
                                <input type="hidden" name="no_seri" value="{{ $data1->no_seri }}">
                            </div>
                            <div class="col-span-2">
                                <p class="text-2xl font-light text-black text-center" name="nama_obat">{{$data1->nama_obat}}</p>
                                <input type="hidden" name="nama_obat" value="{{ $data1->nama_obat }}">
                            </div>
                            <div class="col-span-2 flex justify-evenly">
                                <div class="">
                                    <p class="text-sm font-bold text-black text-center px-10">Expired</p>
                                    <p class="text-sm font-light text-black text-center px-10" name="exp">{{$data1->exp}}</p>
                                    <input type="hidden" name="exp" value="{{ $data1->exp }}">
                                </div>
                                <div class="">
                                    <p class="text-sm font-bold text-black text-center px-10">Harga Obat</p>
                                    <p class="text-sm font-light text-black text-center px-10" name="harga_Umum">{{$data2->harga_Umum}}</p>
                                    <input type="hidden" name="harga_Umum" value="{{ $data2->harga_Umum }}">
                                </div>
                            </div>
                            <div class="col-span-2">
                                <p class="text-sm font-light text-black text-center px-10" name="qty">Stok : {{$data1->qty}}</p>
                                <input type="hidden" name="qty" value="{{ $data1->qty }}">
                            </div>
                        </div>
                    </div>

                    <div class="flex flex-col justify-center items-center py-3">
                        <div class="max-w-xs mx-auto">
                            <label for="counter-input" class="block mb-1 text-sm font-medium text-gray-900">Choose quantity:</label>
                            <div class="relative flex justify-center items-center pb-3">
                                <button type="button" id="decrement-button" data-input-counter-decrement="counter-input" class="flex-shrink-0 bg-gray-100  hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100  focus:ring-2 focus:outline-none">
                                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                    </svg>
                                </button>
                                <input type="text" name="qty_in" min="0" id="counter-input" data-input-counter class="flex-shrink-0 text-gray-900 border-0 bg-transparent text-sm font-normal focus:outline-none focus:ring-0 max-w-[4rem] text-center" placeholder="" value="1" min="1" max="{{ $data1->qty }}" required />
                                <button type="button" id="increment-button" data-input-counter-increment="counter-input" class="flex-shrink-0 bg-gray-100  hover:bg-gray-200 inline-flex items-center justify-center border border-gray-300 rounded-md h-5 w-5 focus:ring-gray-100  focus:ring-2 focus:outline-none">
                                    <svg class="w-2.5 h-2.5 text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="text-white inline-flex items-center bg-green-700 hover:bg-green-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                            <svg class="me-1 -ms-1 w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                            Add new product
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection