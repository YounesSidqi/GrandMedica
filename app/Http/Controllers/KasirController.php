<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kasir;
use App\Models\PriceList;
use App\Models\ScreenOpname;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;
use PhpParser\Node\Expr\Cast\String_;

class KasirController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        if (request('search')) {
            $data = ScreenOpname::where('nama_obat', 'like', '%' . request('search') . '%')
                ->orWhere('no_seri', 'like', '%' . request('search') . '%')
                ->get();
        } else {
            $data = ScreenOpname::orderBy('nama_obat', 'asc')->get();
        }

        $total_harga = Cart::sum('harga_total');
        $total_qty = Cart::sum('qty');

        $cart = Cart::all();
        

        return view('admin_dashboard.kasir.index', compact('data', 'cart', 'total_harga', 'total_qty'));
    }

    

    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    


    }

    /**
     * Display the specified resource.
     */
    public function show($id) {
        $data = ScreenOpname::findOrFail($id);
        return view('admin_dashboard.modal.detail', compact('data'));
    }

    public function showCart($id) {
        $data1 = ScreenOpname::findOrFail($id);
        $data2 = PriceList::findOrFail($id);
        $data3 = Kasir::findOrFail($id);

        // dd($data1, $data2);
        return view('admin_dashboard.kasir.detail', compact('data1', 'data2', 'data3'));
    }

    public function storeCart(Request $request)
{
    // Cari data stok obat berdasarkan no_seri
    $stockItem = ScreenOpname::where('no_seri', $request->no_seri)->first();

    // Validasi jika qty_in melebihi stok
    if ($request->qty_in > $stockItem->qty) {
        return redirect()->route('kasir.index')->with('error', 'Jumlah obat kurang dari yang diinginkan!');
    }

    // Lanjutkan proses menambahkan ke keranjang
    $cartItem = Cart::where('no_seri', $request->no_seri)->first();

    if ($cartItem) {
        // Jika item sudah ada di cart, tambahkan qty dan kurangi stok
        $cartItem->qty += $request->qty_in;

        // Update harga_total di cart
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

    // Kurangi stok
    $stockItem->qty -= $request->qty_in;
    $stockItem->save();

    // Hitung total_harga dengan menjumlahkan semua harga_total di tabel Cart
    $total_harga = Cart::sum('harga_total'); // Total semua harga_total

    // Redirect ke halaman kasir dengan total_harga
    return redirect()->route('kasir.index')->with('success', 'Item berhasil ditambahkan ke keranjang, total harga: Rp' . $total_harga);
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
    // Cari item di Cart berdasarkan ID
    $item = Cart::findOrFail($id);

    // Cari data stok obat berdasarkan no_seri di tabel Obat
    $stockItem = ScreenOpname ::where('no_seri', $item->no_seri)->first();

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

    public function paymentdone()
    {
        return view('admin_dashboard.kasir.paymentsuccess');
    }

    public function printstruk()
    {
        $item = Cart::all(); 
        $total_harga = Cart::sum('harga_total');
        return view('admin_dashboard.kasir.printerstruk', compact('item', 'total_harga'));
    }
}
