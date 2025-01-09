<?php

namespace App\Http\Controllers;

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
            'harga_Umum' => 'required|string',
            'harga_BPJS' => 'required|string',
            'harga_Tender' => 'required|string',
        ],[
            'harga_Umum.required' => 'harga Umum wajib diisi',
            'harga_BPJS.required' => 'harga BPJS wajib diisi',
            'harga_Tender.required' => 'harga Tender wajib diisi',
        ]);

    // Ambil data item dari screen_opname
    $item = PriceList::findOrFail($id);

    // Update data di tabel screen_opname
    $data = $request->only(['harga_Umum', 'harga_BPJS', 'harga_Tender']);
    $item->update($data);

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
