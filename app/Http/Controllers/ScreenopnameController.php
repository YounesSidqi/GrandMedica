<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Kasir;
use App\Models\PriceList;
use App\Models\ScreenOpname;
use Illuminate\Http\Request;

class ScreenopnameController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 10;

        if(request('search')){
            $data = ScreenOpname::where('nama_obat','like','%'.request('search').'%')->orWhere('no_seri', 'like', '%' . request('search') . '%')->paginate($max_data);
        } else {
            $data = ScreenOpname::orderBy('nama_obat', 'asc') -> paginate($max_data);
        }
        return view('admin_dashboard.screen_opname.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin_dashboard.screen_opname.add_product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'no_seri' => 'required',
        'nama_obat' => 'required',
        'unit' => 'required',
        'exp' => 'required',
        'qty' => 'required|integer'
    ], [ 
        'no_seri.required' => 'No seri wajib diisi',
        'nama_obat.required' => 'Nama obat wajib diisi',
        'unit.required' => 'Unit wajib diisi',
        'exp.required' => 'Expired wajib diisi',
        'qty.required' => 'Qty wajib diisi',
        'qty.integer' => 'Qty harus berupa angka'
    ]);

    // Simpan data ke tabel screen_opname
    $data = [
        'no_seri' => $request->input('no_seri'),
        'nama_obat' => $request->input('nama_obat'),
        'unit' => $request->input('unit'),
        'exp' => $request->input('exp'),
        'qty' => $request->input('qty')
    ];

    ScreenOpname::create($data);

    // Simpan data ke tabel daftar_harga dengan default harga
    PriceList::create([
        'no_seri' => $request->input('no_seri'),
        'nama_obat' => $request->input('nama_obat'),
        'harga_Umum' => 0, 
        'harga_BPJS' => 0,
        'harga_Tender1' => 0,
        'harga_Tender2' => 0,
        'harga_Tender3' => 0
    ]);

     // Simpan data ke tabel daftar_harga dengan default harga
    Kasir::create([
        'no_seri' => $request->input('no_seri'),
        'nama_obat' => $request->input('nama_obat'),
        'exp' => $request->input('exp'),
        'qty' => $request->input('qty'),
        'harga_Umum' => $request->input('harga_Umum', 0), 
    ]);

    return redirect()->route('screenopname.home')->with('success', 'Data berhasil disimpan');
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
    public function edit(Request $request, string $id)
    {
        $item = ScreenOpname::find($id); // Ambil data berdasarkan ID
    return view('admin_dashboard.screen_opname.edit', ['item' => $item]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
{
    // Validasi input
    $request->validate([
        'no_seri' => 'required',
        'nama_obat' => 'required',
        'unit' => 'required',
        'exp' => 'required',
        'qty' => 'required|integer'
    ], [ 
        'no_seri.required' => 'No seri wajib diisi',
        'nama_obat.required' => 'Nama obat wajib diisi',
        'unit.required' => 'Unit wajib diisi',
        'exp.required' => 'Expired wajib diisi',
        'qty.required' => 'Qty wajib diisi',
        'qty.integer' => 'Qty harus berupa angka'
    ]);

    // Ambil data item dari screen_opname
    $item = ScreenOpname::findOrFail($id);

    // Simpan nama obat lama untuk referensi
    $oldNamaObat = $item->nama_obat;

    // Simpan nama obat lama untuk referensi
    $oldNoSeri = $item->no_seri;

    // Simpan nama obat lama untuk referensi
    $oldQty = $item->qty;

    // Simpan nama obat lama untuk referensi
    $oldExp = $item->exp;

    // Update data di tabel screen_opname
    $data = $request->only(['no_seri', 'nama_obat', 'unit', 'exp', 'qty']);
    $item->update($data);

   // Jika nama_obat, no_seri, atau harga_umum berubah, update juga di tabel pricelist
    if ($oldNamaObat !== $data['nama_obat'] || $oldNoSeri !== $data['no_seri']) {
        PriceList::where('nama_obat', $oldNamaObat)
            ->where('no_seri', $oldNoSeri)
            ->update([
                'nama_obat' => $data['nama_obat'],
                'no_seri' => $data['no_seri'],
            ]);
    }

    // Jika nama_obat, no_seri, atau harga_umum berubah, update juga di tabel pricelist
    if ($oldNamaObat !== $data['nama_obat'] || $oldNoSeri !== $data['no_seri'] || $oldExp!== $data['exp']) {
        Kasir::where('nama_obat', $oldNamaObat)
            ->where('no_seri', $oldNoSeri)
            ->where('exp', $oldExp)
            ->update([
                'nama_obat' => $data['nama_obat'],
                'no_seri' => $data['no_seri'],
                'qty' => $data['qty'],
                'exp' => $data['exp'],
            ]);
    }

    // Jika nama_obat, no_seri, atau harga_umum berubah, update juga di tabel pricelist
    if ($oldNamaObat !== $data['nama_obat'] || $oldNoSeri !== $data['no_seri'] || $oldExp!== $data['exp']) {
        Cart::where('nama_obat', $oldNamaObat)
            ->where('no_seri', $oldNoSeri)
            ->where('exp', $oldExp)
            ->update([
                'nama_obat' => $data['nama_obat'],
                'no_seri' => $data['no_seri'],
                'exp' => $data['exp'],
            ]);
    }

    return redirect()->route('screenopname.home')->with('success', 'Berhasil mengubah data');
}

//view edit stok
public function pageStokPemasukan ($id) 
{
    $item = ScreenOpname::find($id); // Ambil data berdasarkan ID
    return view('admin_dashboard.screen_opname.add_stok', ['item' => $item]);
}

public function tambahStok(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'pemasukan' => 'required|integer|min:1',
    ], [
        'pemasukan.required' => 'Stok masuk wajib diisi',
        'pemasukan.integer' => 'Stok masuk harus berupa angka',
    ]);

    // Ambil data item berdasarkan ID
    $item = ScreenOpname::findOrFail($id);

    // Tambahkan stok yang masuk ke stok yang ada
    $item->qty += $request->pemasukan;
    $item->pemasukan += $request->pemasukan;
    
    // Simpan perubahan ke database
    $item->save();

    // Perbarui qty di tabel Kasir
    $kasir = Kasir::where('no_seri', $item->no_seri)->where('nama_obat', $item->nama_obat)->first();
    if ($kasir) {
        $kasir->qty += $request->pemasukan; // Tambahkan qty yang sama di kasir
        $kasir->save();
    }

    // Redirect dengan pesan sukses
    return redirect()->route('screenopname.home')->with('success', 'Berhasil mengupdate stok');
}

public function pageStokPengeluaran ($id){
    $item = ScreenOpname::find($id); // Ambil data berdasarkan ID
    return view('admin_dashboard.screen_opname.out_stok', ['item' => $item]);
}

public function stokKeluar(Request $request, $id)
{
    // Validasi input
    $request->validate([
        'pengeluaran' => 'required|integer|min:1',
    ], [
        'pengeluaran.required' => 'Stok keluar wajib diisi',
        'pengeluaran.integer' => 'Stok keluar harus berupa angka',
    ]);

    // Ambil data item berdasarkan ID
    $item = ScreenOpname::findOrFail($id);

    // Cek jika stok sudah habis
    if ($item->qty == 0) {
        return redirect()->route('screenopname.home')->with('error', 'Stok obat sudah habis. Tolong restock ulang terlebih dahulu.');
    }

    // Cek apakah stok mencukupi
    if ($item->qty < $request->pengeluaran) {
        return redirect()->route('screenopname.home')->with('error', 'Stok tidak mencukupi untuk dikurangi.');
    }

    // Kurangi stok yang ada
    $item->qty -= $request->pengeluaran;

    // Tambahkan stok keluar
    $item->pengeluaran += $request->pengeluaran;

    // Simpan perubahan ke database
    $item->save();

    // Kurangi qty di tabel kasir berdasarkan no_seri
    Kasir::where('no_seri', $item->no_seri)
        ->where('exp', $item->exp) // Pastikan exp juga sama agar update akurat
        ->decrement('qty', $request->pengeluaran);

    // Redirect dengan pesan sukses
    return redirect()->route('screenopname.home')->with('success', 'Berhasil mengurangi stok.');
}
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Cari item di screen_opname berdasarkan ID
    $item = ScreenOpname::findOrFail($id);

    // Ambil nama obat dari item yang akan dihapus
    $id = $item->id;

    // Hapus item dari tabel screen_opname
    $item->delete();

    // Hapus item dari tabel daftar_harga yang memiliki nama obat yang sama
    PriceList::where('id', $id)->delete();

    // Hapus item dari tabel daftar_harga yang memiliki nama obat yang sama
    Kasir::where('id', $id)->delete();
    
    // Hapus item dari tabel daftar_harga yang memiliki nama obat yang sama
    Cart::where('id', $id)->delete();

    return redirect()->route('screenopname.home')->with('success', 'Data berhasil dihapus');
}

}