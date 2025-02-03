<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\PriceList;
use Illuminate\Http\Request;

class PricelistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $max_data = 10;

        if(request('search')){
            $data = PriceList::where('nama_obat','like','%'.request('search').'%')->paginate($max_data);
        } else {
            $data = PriceList::orderBy('nama_obat', 'asc') -> paginate($max_data);
        }
        return view('admin_dashboard.daftar_harga.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    // public function create()
    // {
    //     return view('admin_dashboard.daftar_harga.add');
    // }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'nama_obat' => 'required',
        //     'harga_Umum' => 'required|integer',
        //     'harga_BPJS' => 'required|integer',
        //     'harga_Tender' => 'required|integer',
        // ],[
        //     'nama_obat.required' => 'nama obat wajib diisi',
        //     'harga_Umum.required' => 'harga Umum wajib diisi',
        //     'harga_Umum.integer' => 'harga Umum harus berupa angka',
        //     'harga_BPJS.required' => 'harga BPJS wajib diisi',
        //     'harga_BPJS.integer' => 'harga BPJS harus berupa angka',
        //     'harga_Tender.required' => 'harga Tender wajib diisi',
        //     'harga_Tender.integer' => 'harga Tender harus berupa angka',
        // ]);

        // $data = [
        //     'nama_obat' => $request->input('nama_obat'),
        //     'harga_Umum' => $request->input('harga_Umum'),
        //     'harga_BPJS' => $request->input('harga_BPJS'),
        //     'harga_Tender' => $request->input('harga_Tender')
        // ];

        

        // PriceList::create($data);
        // return redirect() -> route('daftarharga.home') -> with('success','Data berhasil di simpan');
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
    public function edit($id)
{
    // Ambil data berdasarkan ID
    $item = PriceList::findOrFail($id);
    return view('admin_dashboard.daftar_harga.edit', ['item' => $item]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'harga_Umum' => 'required|integer',
            'harga_BPJS' => 'required|integer',
            'harga_Tender1' => 'required|integer',
            'harga_Tender2' => 'required|integer',
            'harga_Tender3' => 'required|integer',
        ],[
            'harga_Umum.required' => 'harga Umum wajib diisi',
            'harga_BPJS.required' => 'harga BPJS wajib diisi',
            'harga_Tender1.required' => 'harga Tender wajib diisi',
            'harga_Tender2.required' => 'harga Tender wajib diisi',
            'harga_Tender3.required' => 'harga Tender wajib diisi'
        ]);

    // Ambil data item dari screen_opname
    $item = PriceList::findOrFail($id);

    // Simpan nama obat lama untuk referensi
    $oldHargaUmum = $item->harga_Umum;

    // Simpan nama obat lama untuk referensi
    $oldHargaBPJS = $item->harga_BPJS;

    // Simpan nama obat lama untuk referensi
    $oldHargaTender1 = $item->harga_Tender1;

    // Simpan nama obat lama untuk referensi
    $oldHargaTender2 = $item->harga_Tender2;

    // Simpan nama obat lama untuk referensi
    $oldHargaTender3= $item->harga_Tender3;


    // Update data di tabel pricelist
    $data = $request->only(['harga_Umum', 'harga_BPJS', 'harga_Tender1', 'harga_Tender2', 'harga_Tender3']);
    $item->update($data);

     // Jika nama_obat, no_seri, atau harga_umum berubah, update juga di tabel pricelist
    if ($oldHargaUmum !== $data['harga_Umum'] || $oldHargaBPJS !== $data['harga_BPJS'] || $oldHargaTender1 !== $data['harga_Tender2'] || $oldHargaTender2 !== $data['harga_Tender2'] || $oldHargaTender3 !== $data['harga_Tender3']) {
        Kasir::where('harga_Umum', $oldHargaUmum)
            ->where('harga_BPJS', $oldHargaBPJS)
            ->where('harga_Tender1', $oldHargaTender1)
            ->where('harga_Tender2', $oldHargaTender2)
            ->where('harga_Tender3', $oldHargaTender3)
            ->update([
                'harga_Umum' => $data['harga_Umum'],
                'harga_BPJS' => $data['harga_BPJS'],
                'harga_Tender1' => $data['harga_Tender1'],
                'harga_Tender2' => $data['harga_Tender2'],
                'harga_Tender3' => $data['harga_Tender3'],
            ]);
    }

    return redirect()->route('daftarharga.home')->with('success', 'Berhasil mengubah data');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
