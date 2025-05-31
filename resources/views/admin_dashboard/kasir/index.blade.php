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
                            class="bg-blue-500 text-white px-4 py-2 rounded-lg disabled:opacity-50 disabled:cursor-not-allowed"
                            type="button"
                            @if($total_qty == 0) disabled @endif>
                            Bayar
                        </button>

                    
                        <!-- Modal -->
                        <div id="popup-modal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black bg-opacity-40 backdrop-blur-sm">
                            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-2xl w-full max-w-md p-8 transform transition-all duration-300 scale-100">
                                <!-- Header -->
                                <div class="text-center mb-6">
                                    <h2 class="text-3xl font-bold text-gray-800 dark:text-white">Pembayaran</h2>
                                    <p class="text-gray-600 dark:text-gray-400 mt-2">Total yang harus dibayar</p>
                                    <p class="text-2xl font-bold text-green-600 mt-2">Rp. {{ number_format($total_harga, 0, ',', '.') }}</p>
                                </div>

                                <!-- Metode Pembayaran -->
                                <div class="flex justify-between mb-6">
                                    <button id="cashBtn" onclick="togglePaymentMethod('cash')" 
                                        class="w-1/2 py-4 flex flex-col items-center justify-center space-y-2 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-200 mx-2">
                                        <i class="fa-solid fa-money-bill text-3xl text-green-600"></i>
                                        <span class="text-gray-800 dark:text-white font-medium">Tunai</span>
                                    </button>
                                    <button id="qrisBtn" onclick="togglePaymentMethod('qris')" 
                                        class="w-1/2 py-4 flex flex-col items-center justify-center space-y-2 bg-gray-100 dark:bg-gray-800 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-700 transition duration-200 mx-2">
                                        <i class="fa-solid fa-qrcode text-3xl text-green-600"></i>
                                        <span class="text-gray-800 dark:text-white font-medium">QRIS</span>
                                    </button>
                                </div>

                                <!-- Cash Payment Section -->
                                <div id="tunaiDiv" class="hidden">
                                    <div class="mb-6 space-y-4">
                                        <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                            <span class="text-gray-800 dark:text-white font-medium">Total Harga</span>
                                            <span class="text-gray-800 dark:text-white font-bold" id="totalHarga">Rp. {{ number_format($total_harga, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                            <span class="text-gray-800 dark:text-white font-medium">Tunai yang Diberikan</span>
                                            <div class="flex items-center space-x-2">
                                                <span class="text-gray-800 dark:text-white">Rp.</span>
                                                <input type="number" id="tunaiInput" name="tunai_amount" placeholder="0" 
                                                    class="w-32 px-3 py-2 border rounded-md border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-800 text-gray-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-green-500" 
                                                    oninput="calculateKembalian()" required />
                                            </div>
                                        </div>
                                        <div class="flex justify-between items-center bg-gray-50 dark:bg-gray-800 p-4 rounded-lg">
                                            <span class="text-gray-800 dark:text-white font-medium">Kembalian</span>
                                            <span class="text-gray-800 dark:text-white font-bold" id="kembalian">Rp. 0</span>
                                        </div>
                                        <form action="{{ route('kasir.paymentdone') }}" method="POST" onsubmit="return validatePayment()">
                                            @csrf
                                            <input type="hidden" name="tunai_amount" id="tunaiAmount">
                                            <button type="submit" class="block w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-200 mt-6">
                                                Bayar Sekarang
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <!-- QRIS Payment Section -->
                                <div id="qrisDiv" class="hidden">
                                    <div class="flex flex-col items-center space-y-6">
                                        <div class="bg-white p-4 rounded-lg shadow-sm">
                                            <img class="w-48 h-48" src="{{ asset('assets/img/qrcode.svg') }}" alt="QR Code">
                                        </div>
                                        <div class="text-center">
                                            <p class="text-gray-800 dark:text-white font-medium">Scan QR Code untuk pembayaran</p>
                                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Pastikan Anda telah menyelesaikan pembayaran sebelum melanjutkan</p>
                                        </div>
                                        <a href="{{ route('kasir.paymentdoneqris')}}" 
                                            class="w-full text-center bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg transition duration-200">
                                            Pembayaran Selesai
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>  
        </div>
    </div>
</div>

<script>
    function togglePaymentMethod(method) {
        const tunaiDiv = document.getElementById("tunaiDiv");
        const qrisDiv = document.getElementById("qrisDiv");
        
        // Sembunyikan keduanya dulu
        tunaiDiv.classList.add("hidden");
        qrisDiv.classList.add("hidden");

        if (method === "cash") {
            tunaiDiv.classList.remove("hidden");
        } else if (method === "qris") {
            qrisDiv.classList.remove("hidden");
        }
    }

    function calculateKembalian() {
        const totalHargaText = document.getElementById("totalHarga").innerText;
        const totalHarga = parseInt(totalHargaText.replace('Rp. ', '').replace(/\./g, '')) || 0;

        const tunaiDiberikan = parseInt(document.getElementById("tunaiInput").value) || 0;
        const kembalian = tunaiDiberikan - totalHarga;

        const formattedKembalian = kembalian.toLocaleString('id-ID');
        
        document.getElementById("kembalian").innerText = 'Rp. ' + formattedKembalian;
        document.getElementById("tunaiAmount").value = tunaiDiberikan;
    }

    function validatePayment() {
        const tunaiDiberikan = parseInt(document.getElementById("tunaiInput").value) || 0;
        const totalHarga = parseInt(document.getElementById("totalHarga").innerText.replace('Rp. ', '').replace(/\./g, '')) || 0;

        if (tunaiDiberikan < totalHarga) {
            alert('Jumlah tunai tidak mencukupi');
            return false;
        }
        return true;
    }
</script>


@endsection
