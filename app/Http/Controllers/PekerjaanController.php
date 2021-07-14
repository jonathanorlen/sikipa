<?php

namespace App\Http\Controllers;

use App\Models\Pekerjaan;
use Illuminate\Http\Request;
use Validator;

class PekerjaanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $data['items'] = Pekerjaan::get();
        return view('backend.pages.pekerjaan',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.pekerjaan_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $data = $request->validate([
            'nama' => 'required|unique:master_pekerjaan,nama'
        ]);

        Pekerjaan::create($data);

        return redirect()->route('admin.pekerjaan')->withSuccess('Pekerjaan '.$request->nama.' Telah Dibuat');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function show(Pekerjaan $pekerjaan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pekerjaan $pekerjaan)
    {   
        $data['item'] = $pekerjaan;
        $data['edit'] = true;
        return view('backend.pages.pekerjaan_form',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pekerjaan $pekerjaan)
    {
        $data = $request->validate([
            'nama' => 'required|unique:master_pekerjaan,nama'
        ]);

        $pekerjaan->update($data);

        return redirect()->route('admin.pekerjaan')->withSuccess('Pekerjaan '.$request->nama.' Telah Disimpan');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pekerjaan  $pekerjaan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pekerjaan $pekerjaan)
    {
        $pekerjaan->delete();
        return redirect()->route('admin.pekerjaan')->withSuccess('Pekerjaan '.$pekerjaan->nama.' Telah Dihapus');
    }
}
