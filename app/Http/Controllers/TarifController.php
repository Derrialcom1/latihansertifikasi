<?php

namespace App\Http\Controllers;

use App\Models\Tarif;
use Illuminate\Http\Request;

class TarifController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Tarif::all(); //SELECT * FROM tarif
        return view('tarif', ["data" => $data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Tarif::create([
            "daya" => $request->daya,
            "tarifperkwh" => $request->tarifperkwh
        ]);

        return redirect()->route('tarif');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // mengambil data tarif yang id nya sesuai dengan parameter
        // first mengambil data pertama
        $data = Tarif::where('id', $id)->first();
        if ($data) {
            return view('edittarif', ["data" => $data]);
        } else {
            // abort untuk mengalihkan ke page 404 atau halaman not found
            return abort("404");
        }
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = Tarif::where('id', $id)->first();
        if ($data) {
            //merubah data yang sudah didapatkan dari database menjadi data yang didapat dari input website
            $data->daya = $request->daya;
            $data->tarifperkwh = $request->tarifperkwh;
            //proses menyimpan atau memperbaharui data yang sudah ada di database
            $result = $data->save();

            //pengecekan jika berhasil terubah maka akan kembali kehalaman tarif
            if ($result) {
                return redirect()->route('tarif');
            } else {
                return abort("404");
            }
            
            return view('edittarif', ["data" => $data]);
        } else {
            // abort untuk mengalihkan ke page 404 atau halaman not found
            return abort("404");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tarif  $tarif
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Tarif::where('id', $id)->first();
        if ($data) {
            if ($data->delete()) {
                return redirect()->route('tarif');
            } else {
                return abort("404");
            }
        } else {
            // abort untuk mengalihkan ke page 404 atau halaman not found
            return abort("404");
        }
    }
}
