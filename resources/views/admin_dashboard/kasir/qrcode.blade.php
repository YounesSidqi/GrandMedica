@extends('layout.app')

@section('main')

<div class="w-full flex justify-center items-center min-h-screen">
    <div class="text-center">
        <img class="max-w-sm mx-auto" src="{{ asset('assets/img/qrcode.svg') }}" alt="">
        <p class="text-3xl text-black font-bold pt-2">Scan here</p>
        <a href="{{url('/admin_dashboard/kasir/paymentdone')}}" class="block p-2 mt-4 rounded-md bg-green-600 text-white text-center">Click disini jika pembayaran sudah berhasil</a>
    </div>
</div>

@endsection
