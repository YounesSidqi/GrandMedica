@extends('layout.app')
@include('layout.nav_admin')

@section('main')

<style>
    @media print {
    @page {
        size: 80mm auto; /* Lebar tetap 80mm, tinggi otomatis */
        margin: 5mm;
    }

    body {
        transform: scale(1); /* Hindari pengecilan yang tidak perlu */
        transform-origin: top left;
        width: 80mm;
    margin: 0;
    }

    #print-area {
        display: block;
        width: 100%; /* Gunakan lebar penuh */
        font-size: 12px;
        padding: 5mm;
        margin: 0 auto;
    }
}
</style>



<div class="container p-4">
    <div class="w-screen bg-white shadow-md p-4">
        @if (session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400 font-medium" role="alert">
            {{ session('error') }}
        </div>
    @endif
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
                <div class="grid grid-cols-3 gap-4">
                    @foreach ($data as $item)
                    <form action="{{ url('/admin_dashboard/kasir/' . $item->id) }}" method="GET">
                        <button class="w-full bg-gray-100 hover:bg-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-sm" type="submit">
                        <p class="text-xs font-normal text-black">{{ $item->no_seri }}</p>
                        <h3 class="font-semibold text-lg py-2 text-black">{{ $item->nama_obat }}</h3>
                        <p class="text-xs font-thin text-black">{{ $item->exp }}</p>
                    </button>
                </form>
                    @endforeach
                </div>
        </div>

                        <!-- Bagian Kanan -->
            <div class="w-2/4 bg-white shadow-md rounded-lg p-4 flex flex-col h-full">
                <!-- Tabel Items -->
                <div class="flex-grow overflow-y-auto">
                <table class="w-full border border-gray-300">
                    <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2 text-left">No seri</th>
                        <th class="border border-gray-300 p-2 text-left">Items</th>
                        <th class="border border-gray-300 p-2 text-left">Qty</th>
                        <th class="border border-gray-300 p-2 text-left">Exp</th>
                        <th class="border border-gray-300 p-2 text-left">Harga Satuan</th>
                        <th class="border border-gray-300 p-2 text-left">Harga Total</th>
                        <th class="border text-center border-gray-300 p-2">Action</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach ($cart as $items)
                        <tr>
                            <td class="border border-gray-300 p-2">{{$items->no_seri}}</td>
                            <td class="border border-gray-300 p-2">{{$items->nama_obat}}</td>
                            <td class="border border-gray-300 p-2">{{$items->qty}}</td>
                            <td class="border border-gray-300 p-2">{{$items->exp}}</td>
                            <td class="border border-gray-300 p-2">Rp.{{$items->harga_Umum}}</td>
                            <td class="border border-gray-300 p-2">Rp.{{$items->harga_total}}</td>
                            <td class="border border-gray-300 p-2 text-center text-red-500">
                                <form action="{{ route('cart.delete', $items->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus data ini?')" class="m-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                            
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                </div>
                
                <!-- Bagian Total dan Tombol -->
                <div class="mt-4">
                    <div class="space-y-2">
                        <div class="flex justify-between">
                            <span>Subtotal:</span>
                            <span>Rp.{{ $total_harga }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span>Jumlah Item:</span>
                            <span>{{ $total_qty }}</span>
                        </div>
                
                    <!-- Tombol -->
                    <div class="mt-4 flex justify-between">
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg">Batal</button>
                        <button data-modal-target="popup-modal" data-modal-toggle="popup-modal" 
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg" type="button">
                            Bayar
                        </button>
                    
                        <!-- Modal -->
                        <div id="popup-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
                            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-2xl w-full max-w-md p-8 transform transition-all duration-300 scale-100">
                                <!-- Header -->
                                <div class="text-center mb-6">
                                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Pilih Metode Pembayaran</h2>
                                </div>

                            <!-- Metode Pembayaran: Ikon Cash dan QRIS -->
                        <div class="flex justify-between mb-6">
                            <button id="cashBtn" onclick="togglePaymentMethod('cash')" class="w-1/2 py-4 flex flex-col items-center justify-center space-y-2 bg-gray-200 dark:bg-gray-800 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 transition duration-200 mx-2">
                                <i class="fa-solid fa-money-bill text-2xl"></i>
                                <span class="text-gray-800 dark:text-white font-medium">Tunai</span>
                            </button>
                            <button id="qrisBtn" onclick="togglePaymentMethod('qris')" class="w-1/2 py-4 flex flex-col items-center justify-center space-y-2 bg-gray-200 dark:bg-gray-800 rounded-lg hover:bg-gray-300 dark:hover:bg-gray-700 transition duration-200 mx-2">
                                <i class="fa-solid fa-qrcode text-2xl"></i>
                                <span class="text-gray-800 dark:text-white font-medium">QRIS</span>
                            </button>
                        </div>


                        <!-- Cash Payment Section -->
                        <div id="tunaiDiv" class="hidden">
                            <div class="mb-6">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-800 dark:text-white font-medium">Total Harga</span>
                                    <span class="text-gray-800 dark:text-white font-bold" id="totalHarga">Rp. 100,000</span>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-gray-800 dark:text-white font-medium">Tunai yang Diberikan</span>
                                    <div class="flex items-center space-x-2">
                                        <span>Rp.</span>
                                        <input type="text" id="tunaiInput" placeholder="0" class="w-32 px-3 py-2 border rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring focus:ring-blue-300" oninput="calculateKembalian()" />
                                    </div>
                                </div>
                                <div class="flex justify-between items-center mt-4">
                                    <span class="text-gray-800 dark:text-white font-medium">Kembalian</span>
                                    <span class="text-gray-800 dark:text-white font-bold" id="kembalian">Rp. 0</span>
                                </div>
                                <a href="{{url('admin_dashboard/kasir/paymentdone')}}" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-2 rounded-md transition duration-200 mt-6">Bayar Sekarang</a>
                            </div>
                        </div>

                        <!-- QRIS Payment Section -->
                        <div id="qrisDiv" class="hidden">
                            <div class="flex flex-col items-center space-y-4">
                                <span class="text-gray-800 dark:text-white font-medium">Scan Barcode QRIS</span>
                                <a href="{{url('admin_dashboard/kasir/qrcode')}}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md text-sm transition duration-200">Scan QR</a>
                            </div>
                        </div>
                    </div>
                </div>

<script>
    function togglePaymentMethod(method) {
        const tunaiDiv = document.getElementById("tunaiDiv");
        const qrisDiv = document.getElementById("qrisDiv");
        
        // Hide both divs initially
        tunaiDiv.classList.add("hidden");
        qrisDiv.classList.add("hidden");

        if (method === "cash") {
            tunaiDiv.classList.remove("hidden");
        } else if (method === "qris") {
            qrisDiv.classList.remove("hidden");
        }
    }

    function calculateKembalian() {
        const totalHarga = parseInt(document.getElementById("totalHarga").innerText.replace('Rp. ', '').replace('.', ''));
        const tunaiDiberikan = parseInt(document.getElementById("tunaiInput").value.replace('.', '') || 0);

        const kembalian = tunaiDiberikan - totalHarga;
        document.getElementById("kembalian").innerText = `Rp. ${kembalian.toLocaleString()}`;
    }
</script>

                                



                                {{-- <!-- Area Print (Flexible) -->
                                <div id="print-area" class="flex-1 overflow-auto max-h-[60vh] w-auto p-10">
                                    <img class="justify-center flex" src="{{ asset('assets/img/logogrand.png') }}" alt="Logo" class="h-10">
                                    <div class="text-center mb-4 pt-4">
                                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">APOTEK METRO JAYA</h2>
                                        <p class="text-xs text-gray-500 dark:text-gray-400 px-6">JI. MT. Haryano No, 05 RT, 11 Balikpapan Kalimantan Timur
                                        No izin : 30082301553750006
                                        </p>
                                        <hr class="my-2 border-gray-300 dark:border-gray-700">
                                    </div>

                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-1">Kasir</div>
                                        <div class="col-span-1">:</div>
                                        <div class="col-span-2">Shilva Azzaria Putri</div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-1">Pelanggan</div>
                                        <div class="col-span-1">:</div>
                                        <div class="col-span-2">-</div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-1">Tanggal</div>
                                        <div class="col-span-1">:</div>
                                        <div class="col-span-2">08-03-2023 05:23</div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-1">No</div>
                                        <div class="col-span-1">:</div>
                                        <div class="col-span-2">SIN-250208-004</div>
                                    </div>

                                    @foreach ($cart as $items)
                                        <div class="grid grid-cols-4 gap-1 pt-3">
                                            <div class="col-span-4">{{$items->nama_obat}}</div>
                                            <div class="col-span-2 pl-2">
                                                <p>{{$items->qty}} PCS x {{$items->harga_Umum}}</p>
                                            </div>
                                            <div class="col-span-2 text-end">{{$items->harga_total}}</div>
                                        </div>
                                    @endforeach

                                    <div class="grid grid-cols-4 gap-4 pt-5">
                                        <div class="col-span-2">Subtotal</div>
                                        <div class="col-span-1">:</div>
                                        <div class="col-span-1 text-end">{{$total_harga}}</div>
                                    </div>
                                    <div class="grid grid-cols-4 gap-4">
                                        <div class="col-span-2 text-xl text-start">Total</div>
                                        <div class="col-span-1 text-xl">:</div>
                                        <div class="col-span-1 text-xl text-end">{{$total_harga}}</div>
                                    </div>
                            
                                    <div class="text-center mt-4 text-gray-500 dark:text-gray-400 text-xs">
                                        <p>Terima kasih telah berbelanja!</p>
                                        <p>Semoga harimu menyenangkan.</p>
                                    </div>
                                </div>
                        
                                <!-- Tombol Cetak di Bawah -->
                                <div class="mt-auto pt-4">
                                    <button onclick="printReceipt()" class="w-full px-4 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800">
                                        Cetak Struk
                                    </button>
                                </div> --}}
                            </div>
                        </div>
                        
                        
                        
                        
                    </div>
                    
                    <script>
                        function printReceipt() {
    let printArea = document.getElementById("print-area").innerHTML;
    let originalContent = document.body.innerHTML;

    let printWindow = window.open("", "_blank");
    printWindow.document.open();
    printWindow.document.write(`
        <html>
        <head>
            <title>Cetak Struk</title>
            <style>
                @media print {
                    @page {
                        size: 80mm auto;
                        margin: 5mm;
                    }
                    body {
                        font-size: 12px;
                    }
                    #print-area {
                        width: 100%;
                        padding: 5mm;
                    }
                }
            </style>
        </head>
        <body>
            <div id="print-area">
                ${printArea}
            </div>
        </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
    printWindow.close();
}


                    </script>                    
                </div>
            </div>  
        </div>
    </div>
</div>

@endsection