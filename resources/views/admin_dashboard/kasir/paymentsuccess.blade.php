@extends('layout.app')

@section('main')
<div class="min-h-screen flex flex-col justify-center items-center bg-gray-100 px-4">
    <div class="bg-white p-8 rounded-2xl shadow-lg max-w-md text-center">
        <div class="flex justify-center">
            <svg class="w-20 h-20 text-green-500" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                <path fill-rule="evenodd" d="M12 2a10 10 0 1010 10A10 10 0 0012 2zm-1 14.59l-3.3-3.29a1 1 0 011.41-1.42l2.3 2.3 5.3-5.29a1 1 0 011.41 1.42l-6 6a1 1 0 01-1.42 0z" clip-rule="evenodd"/>
            </svg>
        </div>
        <h2 class="text-2xl font-bold text-gray-800 mt-4">Pembayaran Berhasil!</h2>
        <p class="text-gray-600 mt-2">Terima kasih telah melakukan pembayaran. Transaksi Anda telah berhasil diproses.</p>
        <a href="/admin_dashboard/kasir/printstruk" class="mt-6 inline-block px-6 py-3 bg-gray-400 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">Print Struk</a>
        <a href="/admin_dashboard/kasir" class="mt-6 inline-block px-6 py-3 bg-green-500 text-white font-semibold rounded-lg shadow-md hover:bg-green-600 transition">Kembali ke Beranda</a>
    </div>
</div>
@endsection