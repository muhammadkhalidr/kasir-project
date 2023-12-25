<?php

namespace App\Http\Controllers;

use App\Models\Rekening;
use App\Http\Requests\StoreRekeningRequest;
use App\Http\Requests\UpdateRekeningRequest;
use Illuminate\Support\Facades\Auth;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = Rekening::all();

        return view('rekening.data', [
            'title' => env('APP_NAME') . ' | ' . 'Data Rekening',
            'breadcrumb' => 'Data Rekening',
            'user' => $user,
            'data' => $data
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRekeningRequest $request)
    {
        $rekening = new Rekening;
        $rekening->no_rekening = $request->norek;
        $rekening->atas_nama = $request->atasnama;
        $rekening->bank = $request->bank;
        $rekening->no_refferensi = $request->noreff;
        $rekening->save();
        return redirect()->back()->with('success', 'Data Rekening Berhasilsil Ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekening $rekening)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRekeningRequest $request, Rekening $rekening)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekening $rekening)
    {
        //
    }
}
