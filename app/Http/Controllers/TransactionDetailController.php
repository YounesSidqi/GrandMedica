<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\TransactionDetails;
use Illuminate\Http\Request;

class TransactionDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $max_data = 15; // 10 per halaman

        // Menangani pencarian
        if ($request->search) {
            $transactions = TransactionDetails::where('nama_obat', 'like', '%' . $request->search . '%')
                ->orWhere('transaction_id', 'like', '%' . $request->search . '%')
                ->orderBy('created_at', 'desc')
                ->paginate($max_data);
        } else {
            // Pagination tanpa filter pencarian
            $transactions = TransactionDetails::orderBy('created_at', 'desc')
                ->paginate($max_data);
        }

        // Mengelompokkan transaksi berdasarkan trx_id setelah paginasi
        $transactionsGrouped = $transactions->getCollection()->groupBy('transaction_id');

        // Menghitung total harga dan qty dari cart
        $total_harga = Cart::sum('harga_total');
        $total_qty = Cart::sum('qty');
        $cart = Cart::all();

        // Mengirimkan variabel ke view
        return view('admin_dashboard.transaction_detail.index', compact('total_harga', 'total_qty', 'cart', 'transactions', 'transactionsGrouped'));
    }
    /**
     * Show the form for creating a new resource.
     */

     public function printStruk($transaction_id)
     {
         $item = TransactionDetails::where('transaction_id', $transaction_id)->get();
     
         $total_harga = $item->sum('harga_total');
     
         // Jika kamu simpan tunai dari pembayaran di session, bisa pakai ini
         $tunai_amount = session('tunai_amount', $total_harga); // fallback kalau kosong
         $kembalian = $tunai_amount - $total_harga;
     
         return view('admin_dashboard.transaction_detail.printstruk', compact('item', 'total_harga', 'tunai_amount', 'kembalian'));
     }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
