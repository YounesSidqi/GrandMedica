<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kasir;
use App\Models\PriceList;
use App\Models\ScreenOpname;
use App\Models\TransactionDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Tambahkan di atas controller

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = request('search') 
            ? ScreenOpname::where('nama_obat', 'like', '%' . request('search') . '%')
                ->orWhere('no_seri', 'like', '%' . request('search') . '%')
                ->get()
            : ScreenOpname::orderBy('nama_obat', 'asc')->get();

        $total_harga = Cart::sum('harga_total');
        $total_qty = Cart::sum('qty');
        $cart = Cart::all();

        return view('admin_dashboard.kasir.index', compact('data', 'cart', 'total_harga', 'total_qty'));
    }

    public function createtransactiondetails()
    {
        // Implementasi untuk membuat detail transaksi
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Implementasi untuk menyimpan resource
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $data = ScreenOpname::findOrFail($id);
        return view('admin_dashboard.modal.detail', compact('data'));
    }

    public function showCart($id)
    {
        $data1 = ScreenOpname::findOrFail($id);
        $data2 = PriceList::findOrFail($id);
        $data3 = Kasir::findOrFail($id);

        return view('admin_dashboard.kasir.detail', compact('data1', 'data2', 'data3'));
    }

    public function storeCart(Request $request)
{
    // Cari data stok obat berdasarkan no_seri
    $stockItem = ScreenOpname::where('no_seri', $request->no_seri)->first();

    if (!$stockItem) {
        return redirect()->route('kasir.index')->with('error', 'Obat tidak ditemukan di stok!');
    }

    // Validasi jika qty_in melebihi stok
    if ($request->qty_in > $stockItem->qty) {
        return redirect()->route('kasir.index')->with('error', 'Jumlah obat kurang dari yang diinginkan!');
    }

    // Lanjutkan proses menambahkan ke keranjang
    $cartItem = Cart::where('no_seri', $request->no_seri)->first();

    if ($cartItem) {
        // Jika item sudah ada di cart, tambahkan qty dan kurangi stok
        $cartItem->qty += $request->qty_in;
        $cartItem->harga_total = $cartItem->harga_Umum * $cartItem->qty;
        $cartItem->save();
    } else {
        // Jika item belum ada di cart, buat data baru
        $data = [
            'no_seri' => $request->no_seri,
            'nama_obat' => $request->nama_obat,
            'exp' => $request->exp,
            'qty' => $request->qty_in,
            'harga_Umum' => $request->harga_Umum,
            'harga_total' => $request->harga_Umum * $request->qty_in // Hitung harga_total
        ];

        Cart::create($data);
    }

    // Update stok
    $stockItem->qty -= $request->qty_in;
    $stockItem->save();

    // Hitung total_harga dengan menjumlahkan semua harga_total di tabel Cart
    $total_harga = Cart::sum('harga_total');

    // Redirect ke halaman kasir dengan total_harga
    return redirect()->route('kasir.index')->with('success', 'Iteam berhasil ditambahkan ke keranjang, total harga: Rp' . $total_harga);
}


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Implementasi untuk mengedit resource
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Implementasi untuk memperbarui resource
    }

    public function paymentCash(Request $request)
    {
        // Implementasi untuk pembayaran tunai
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Cari item di Cart berdasarkan ID
    $item = Cart::findOrFail($id);

    // Cari data stok obat berdasarkan no_seri di tabel Obat
    $stockItem = ScreenOpname::where('no_seri', $item->no_seri)->first();

    // Validasi jika stok tidak ditemukan
    if (!$stockItem) {
        return redirect()->route('kasir.index')->with('error', 'Data stok obat tidak ditemukan!');
    }

    // Tambahkan kembali qty yang ada di cart ke stok obat
    $stockItem->qty += $item->qty;
    $stockItem->save();

    // Hapus item dari tabel Cart
    $item->delete();

    return redirect()->route('kasir.index')->with('success', 'Item berhasil dihapus dari keranjang dan stok diperbarui!');
}


    public function qrcode()
    {
        return view('admin_dashboard.kasir.qrcode');
    }

    public function paymentdone(Request $request)
{
    $request->validate([
        'tunai_amount' => 'required|numeric|min:' . Cart::sum('harga_total')
    ]);

    $tunai_amount = $request->input('tunai_amount');
    $total_harga = Cart::sum('harga_total');

    // Ambil urutan terakhir dari transaksi
    $lastId = DB::table('transaction_details')->max('id') ?? 0;
    $nextNumber = str_pad($lastId + 1, 4, '0', STR_PAD_LEFT);
    $tanggal = now()->format('dm');
    $tahun = now()->format('Y');
    $transaction_id = "TRX{$nextNumber}-{$tanggal}-{$tahun}";

    // Simpan transaksi dari Cart ke TransactionDetail
    $cartItems = Cart::all();

    foreach ($cartItems as $item) {
        TransactionDetails::create([
            'transaction_id' => $transaction_id,
            'no_seri' => $item->no_seri,
            'nama_obat' => $item->nama_obat,
            'harga_Umum' => $item->harga_Umum,
            'qty' => $item->qty,
            'total_qty' => $item->qty,
            'harga_total' => $item->harga_total,
            'exp' => $item->exp,
        ]);

        $stok = ScreenOpname::where('no_seri', $item->no_seri)->first();
        if ($stok) {
            if ($stok->qty < $item->qty) {
                return redirect()->route('kasir.index')->with('error', 'Stok tidak cukup untuk menyelesaikan transaksi.');
            }
            // Tambahkan pengeluaran
            $stok->pengeluaran += $item->qty;
            $stok->save();
        }

        // Hapus dari Cart
        $item->delete();
    }

    session([
        'tunai_amount' => $tunai_amount,
        'transaction_id' => $transaction_id,
    ]);

    return view('admin_dashboard.kasir.paymentsuccess', compact('total_harga', 'tunai_amount'));
}


public function printstruk(Request $request)
{
    $transaction_id = session('transaction_id');

    $item = TransactionDetails::where('transaction_id', $transaction_id)->get();
    $total_harga = $item->sum('harga_total');
    $tunai_amount = session('tunai_amount');
    $kembalian = $tunai_amount - $total_harga;

    return view('admin_dashboard.kasir.printerstruk', compact('item', 'total_harga', 'tunai_amount', 'kembalian'));
}

    public function paymentdoneqris()
    {

        return view('admin_dashboard.kasir.paymentsuccessqris');
    }

    public function printstrukqris(Request $request)
{
    $item = Cart::all();
    $total_harga = Cart::sum('harga_total');

    return view('admin_dashboard.kasir.printerstrukqris', compact('item', 'total_harga'));
}

    public function aneh()
    {
        return view('admin_dashboard.kasir.paymentsuccessqris');
    }
}