<?php

namespace App\Http\Controllers;

use App\Models\Kasir;
use App\Models\PriceList;
use App\Models\ScreenOpname;
use Illuminate\Http\Request;

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
        

        return view('admin_dashboard.kasir.index', ['data' => $data]);
    }

    

    public function create()
    {
        
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
