@extends('layout.app')

@section('main')

<div class="p-6 bg-white rounded-lg shadow-lg dark:bg-gray-800 max-w-md w-full md:w-[450px] h-auto max-h-auto mx-auto flex flex-col print-container">
    <!-- Area Print (Flexible) -->
    <div id="print-area" class="flex-1 w-auto p-4">
        <img class="justify-center flex w-16 mx-auto mb-2" src="{{ asset('assets/img/logogrand.png') }}" alt="Logo">
        <div class="text-center mb-2">
            <h2 class="text-lg font-bold text-gray-900 dark:text-white">APOTEK METRO JAYA</h2>
            <p class="text-xs text-gray-500 dark:text-gray-400">
                JI. MT. Haryano No, 05 RT, 11 Balikpapan Kalimantan Timur <br>
                No izin: 30082301553750006
            </p>
            <hr class="my-1 border-gray-300 dark:border-gray-700">
        </div>

        <div class="grid grid-cols-4 gap-1 text-xl font-bold">
            <div class="col-span-1">Kasir</div><div class="col-span-1 text-center">:</div><div class="col-span-2 text-end">Shilva Azzaria Putri</div>
            <div class="col-span-1">Pelanggan</div><div class="col-span-1 text-center">:</div><div class="col-span-2 text-end">-</div>
            <div class="col-span-1">Tanggal</div><div class="col-span-1 text-center">:</div><div class="col-span-2 text-end">08-03-2023 05:23</div>
            <div class="col-span-1">No</div><div class="col-span-1 text-center">:</div><div class="col-span-2 text-end">SIN-250208-004</div>
        </div>

        @foreach ($item as $items)
            <div class="grid grid-cols-4 gap-0 pt-1 text-xl">
                <div class="col-span-4">{{$items->nama_obat}}</div>
                <div class="col-span-2 pl-2">{{$items->qty}} PCS x {{$items->harga_Umum}}</div>
                <div class="col-span-2 text-end font-bold">{{$items->harga_total}}</div>
            </div>
        @endforeach

        <div class="grid grid-cols-4 gap-1 pt-3 text-xl font-bold">
            <div class="col-span-2">Subtotal</div><div class="col-span-1">:</div><div class="col-span-1 text-end">{{$total_harga}}</div>
            <div class="col-span-2">Total</div><div class="col-span-1">:</div><div class="col-span-1 text-end">{{$total_harga}}</div>
            <div class="col-span-2">Tunai</div><div class="col-span-1">:</div><div class="col-span-1 text-end">{{$total_harga}}</div>
            <div class="col-span-2">Kembalian</div><div class="col-span-1">:</div><div class="col-span-1 text-end"></div>
        </div>

        <div class="text-center mt-2 text-black dark:text-gray-400 pt-3 text-sm font-bold">
            <p>Terima kasih telah berbelanja!</p>
            <p>Semoga harimu menyenangkan.</p>
        </div>
    </div>

    <!-- Tombol Cetak -->
    <div class="mt-auto pt-2">
        <button onclick="printReceipt()" class="w-full px-3 py-2 bg-green-600 text-white text-sm rounded-lg hover:bg-green-800 focus:ring-4 focus:ring-green-300 dark:focus:ring-green-800 print-hidden">
            Cetak Struk
        </button>
    </div>
</div>

<!-- CSS Print -->


<style>
    @media print {
    @page {
        size: auto; /* Gunakan ukuran kertas otomatis */
        margin: 0;
    }

    body {
        width: 80mm; /* Sesuaikan dengan kertas printer (58mm atau 80mm) */
        margin: 0;
        padding: 0;
    }

    .print-container {
        width: 80mm !important;
        max-width: 80mm !important;
        padding: 0;
        margin: 0;
        background: white;
        box-shadow: none;
    }

    #print-area {
        font-size: 100px !important; /* Gunakan ukuran font besar */
        line-height: 1.5;
    }

    .print-hidden {
        display: none !important;
    }
}

</style>

<script>
    function printReceipt() {
        window.print();
    }
</script>

@endsection
