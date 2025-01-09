<?php

namespace App\Http\Controllers;

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
        'no_seri' => 'required|integer',
        'nama_obat' => 'required',
        'qty' => 'required|integer'
    ], [ 
        'no_seri.required' => 'No seri wajib diisi',
        'no_seri.integer' => 'No seri harus berupa angka',
        'nama_obat.required' => 'Nama obat wajib diisi',
        'qty.required' => 'Qty wajib diisi',
        'qty.integer' => 'Qty harus berupa angka'
    ]);

    // Simpan data ke tabel screen_opname
    $data = [
        'no_seri' => $request->input('no_seri'),
        'nama_obat' => $request->input('nama_obat'),
        'qty' => $request->input('qty')
    ];

    ScreenOpname::create($data);

    // Simpan data ke tabel daftar_harga dengan default harga
    PriceList::create([
        'nama_obat' => $request->input('nama_obat'),
        'harga_Umum' => 0,
        'harga_BPJS' => 0,
        'harga_Tender' => 0
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
        'no_seri' => 'required|integer',
        'nama_obat' => 'required',
        'qty' => 'required|integer'
    ], [
        'no_seri.required' => 'No seri wajib diisi',
        'no_seri.integer' => 'Quantity harus beruba nomer',
        'nama_obat.required' => 'Nama obat wajib diisi',
        'qty.required' => 'Quantity wajib diisi',
        'qty.integer' => 'Quantity harus beruba nomer'
    ]);

    // Ambil data item dari screen_opname
    $item = ScreenOpname::findOrFail($id);

    // Simpan nama obat lama untuk referensi
    $oldNamaObat = $item->nama_obat;

    // Update data di tabel screen_opname
    $data = $request->only(['no_seri', 'nama_obat', 'qty']);
    $item->update($data);

    // Jika nama obat berubah, update juga di tabel daftar_harga
    if ($oldNamaObat !== $data['nama_obat']) {
        PriceList::where('nama_obat', $oldNamaObat)->update(['nama_obat' => $data['nama_obat']]);
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
        'stok_masuk' => 'required|integer|min:1',
    ], [
        'stok_masuk.required' => 'Stok masuk wajib diisi',
        'stok_masuk.integer' => 'Stok masuk harus berupa angka',
    ]);

    // Ambil data item berdasarkan ID
    $item = ScreenOpname::findOrFail($id);

    // Tambahkan stok yang masuk ke stok yang ada
    $item->qty += $request->stok_masuk;
    $item->stok_masuk += $request->stok_masuk;

    // Update stok keluar jika diperlukan (optional, tergantung logika)
    $item->stok_keluar = $request->stok_keluar ?? $item->stok_keluar;

    // Simpan perubahan ke database
    $item->save();

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
        'stok_keluar' => 'required|integer|min:1',
    ], [
        'stok_keluar.required' => 'Stok keluar wajib diisi',
        'stok_keluar.integer' => 'Stok keluar harus berupa angka',
    ]);

    // Ambil data item berdasarkan ID
    $item = ScreenOpname::findOrFail($id);

    // Cek jika stok sudah habis
    if ($item->qty == 0) {
        return redirect()->route('screenopname.home')->with('error', 'Stok obat sudah habis. Tolong restock ulang terlebih dahulu.');
    }

    // Cek apakah stok mencukupi
    if ($item->qty < $request->stok_keluar) {
        return redirect()->route('screenopname.home')->with('error', 'Stok tidak mencukupi untuk dikurangi.');
    }

    // Kurangi stok yang ada
    $item->qty -= $request->stok_keluar;

    // Tambahkan stok keluar
    $item->stok_keluar += $request->stok_keluar;

    // Simpan perubahan ke database
    $item->save();

    // Redirect dengan pesan sukses
    return redirect()->route('screenopname.home')->with('success', 'Berhasil mengurangi stok.');
}





    // $validated = $request->validate([
    //     'tambah_stok' => 'required|integer|min:1'
    // ]);

    // // Ambil item berdasarkan ID
    // $item = ScreenOpname::findOrFail($id);

    // // Tambah stok ke qty dan stok masuk
    // $item->qty += $validated['tambah_stok'];
    // $item->stok_masuk += $validated['tambah_stok'];

    // // Simpan perubahan
    // $item->save();

    // // Redirect ke halaman screenopname.addstok setelah stok berhasil ditambah
    // return redirect()->route('screenopname.addstok')->with('success', 'Stok berhasil ditambah!');



    


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
{
    // Cari item di screen_opname berdasarkan ID
    $item = ScreenOpname::findOrFail($id);

    // Ambil nama obat dari item yang akan dihapus
    $namaObat = $item->nama_obat;

    // Hapus item dari tabel screen_opname
    $item->delete();

    // Hapus item dari tabel daftar_harga yang memiliki nama obat yang sama
    PriceList::where('nama_obat', $namaObat)->delete();

    return redirect()->route('screenopname.home')->with('success', 'Data berhasil dihapus');
}

public function getChartData(Request $request)
{
    // Data Dummy Mingguan
    $weeklyData = [];
    for ($month = 1; $month <= 12; $month++) {
        $daysInMonth = cal_days_in_month(CAL_GREGORIAN, $month, 2025);
        $weeksInMonth = ceil($daysInMonth / 7);

        for ($week = 1; $week <= $weeksInMonth; $week++) {
            $startDay = ($week - 1) * 7 + 1;
            $endDay = min($startDay + 6, $daysInMonth);

            // Data untuk minggu tersebut
            $weekData = [];
            for ($day = $startDay; $day <= $endDay; $day++) {
                $weekData[] = (object) [
                    'date' => sprintf('2025-%02d-%02d', $month, $day),
                    'total_in' => rand(100, 300),
                    'total_out' => rand(50, 200),
                ];
            }

            $weeklyData[] = (object) [
                'week' => $week,
                'month' => sprintf('%04d-%02d', 2025, $month),
                'start_date' => sprintf('2025-%02d-%02d', $month, $startDay),
                'end_date' => sprintf('2025-%02d-%02d', $month, $endDay),
                'data' => $weekData,
            ];
        }
    }

    // Data Dummy Bulanan
    $monthlyData = [];
    for ($month = 1; $month <= 12; $month++) {
        $monthlyData[] = (object) [
            'month' => sprintf('%04d-%02d', 2025, $month),
            'total_in' => rand(1000, 3000),
            'total_out' => rand(800, 2500),
        ];
    }

    // Return ke view dengan data dummy
    return view('admin_dashboard.chart.index', [
        'weeklyData' => collect($weeklyData),
        'monthlyData' => collect($monthlyData),
        'message' => null,
    ]);
}




}

 // // Data Mingguan
    // $weeklyData = ScreenOpname::selectRaw('
    //     YEARWEEK(created_at) as week, 
    //     DATE_FORMAT(created_at, "%Y-%m") as month,
    //     DATE_FORMAT(MIN(created_at), "%a, %d %b %Y") as start_date, 
    //     DATE_FORMAT(MAX(created_at), "%a, %d %b %Y") as end_date, 
    //     SUM(stok_masuk) as total_in, 
    //     SUM(stok_keluar) as total_out
    // ')
    // ->groupBy('week', 'month')
    // ->orderBy('week', 'asc')
    // ->get();

    // // Data Bulanan
    // $monthlyData = ScreenOpname::selectRaw('
    //     DATE_FORMAT(created_at, "%Y-%m") as month, 
    //     DATE_FORMAT(MIN(created_at), "%d %b %Y") as start_date, 
    //     DATE_FORMAT(MAX(created_at), "%d %b %Y") as end_date, 
    //     CAST(SUM(stok_masuk) AS UNSIGNED) as total_in, 
    //     CAST(SUM(stok_keluar) AS UNSIGNED) as total_out
    // ')
    // ->groupBy('month')
    // ->orderBy('month', 'asc')
    // ->get();

    // // Pengecekan Data Kosong
    // $message = null;
    // if ($weeklyData->isEmpty() && $monthlyData->isEmpty()) {
    //     $message = 'Data tidak tersedia untuk periode yang diminta.';
    // }

    // // Return ke View dengan Data
    // return view('admin_dashboard.chart.index', [
    //     'weeklyData' => $weeklyData,
    //     'monthlyData' => $monthlyData,
    //     'message' => $message
    // ]);
