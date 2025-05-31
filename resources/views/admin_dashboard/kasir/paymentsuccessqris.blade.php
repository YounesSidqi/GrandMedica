@extends('layout.app')

@section('main')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md w-full text-center">
        <!-- Success Icon -->
        <div class="flex justify-center">
            <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center">
                <svg class="w-16 h-16 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                    <path fill-rule="evenodd" d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm-1 14.59l-3.3-3.29a1 1 0 011.41-1.42l2.3 2.3 5.3-5.29a1 1 0 011.41 1.42l-6 6a1 1 0 01-1.42 0z" clip-rule="evenodd"/>
                </svg>
            </div>
        </div>

        <!-- Success Message -->
        <div class="mt-6">
            <h2 class="text-2xl font-bold text-gray-800">Pembayaran Berhasil!</h2>
            <p class="text-gray-600 mt-2">Transaksi telah berhasil diproses.</p>
        </div>

        <!-- Transaction Details -->
        <div class="mt-6 bg-gray-50 p-4 rounded-lg">
            <div class="flex justify-between items-center mb-2">
                <span class="text-gray-600">Total Pembayaran</span>
                <span class="font-semibold text-gray-800">Rp. {{ number_format($total_harga ?? 0, 0, ',', '.') }}</span>
            </div>
            <div class="flex justify-between items-center">
                <span class="text-gray-600">Tanggal</span>
                <span class="text-gray-800">{{ now()->format('d/m/Y H:i') }}</span>
            </div>
        </div>

        <!-- Action Buttons -->
        <div class="mt-8 space-y-4">
            <a href="{{ route('kasir.printstruk') }}" 
               class="block w-full px-6 py-3 bg-green-600 text-white font-semibold rounded-lg shadow-md hover:bg-green-700 transition duration-200">
                <div class="flex items-center justify-center space-x-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"/>
                    </svg>
                    <span>Cetak Struk</span>
                </div>
            </a>
            
            <a href="{{ route('kasir.index') }}" 
               class="block w-full px-6 py-3 bg-gray-100 text-gray-800 font-semibold rounded-lg shadow-sm hover:bg-gray-200 transition duration-200">
                Kembali ke Beranda
            </a>
        </div>
    </div>
</div>
@endsection