<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dpr;
use Illuminate\Support\Facades\DB;

class DprController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $collection = Dpr::all();
        // $collection = DB::table('dprs')
        // ->select('nama', 'partai', 'desa', DB::raw('SUM(total) as total_suara'))
        // ->groupBy('nama', 'partai', 'desa')
        // ->orderBy('total_suara', 'desc')
        // ->orderBy('desa', 'asc')
        // ->get();
        // $partai = DB::table('dprs')
        //             ->select('partai', DB::raw('SUM(total) AS total_suara'))
        //             ->groupBy('partai')
        //             ->get();

        // $partai = DB::table('dprs')
        //     ->select('partai', DB::raw('SUM(total) AS total_suara_partai'))
        //     ->groupBy('partai')
        //     ->pluck('total_suara_partai', 'partai');
        $collection = Dpr::report()->get();

        $partai = Dpr::select('partai', DB::raw('SUM(total) AS total_suara_partai'))
                ->when(request('tps'), function ($query) {
                    return $query->where('tps', request('tps'));
                })
                ->when(request('desa'), function ($query) {
                    return $query->where('desa', request('desa'));
                })
                ->when(request('kecamatan'), function ($query) {
                    return $query->where('kecamatan', request('kecamatan'));
                })
                ->when(request('kabupaten'), function ($query) {
                    return $query->where('kabupaten', request('kabupaten'));
                })
                ->groupBy('partai')
                ->pluck('total_suara_partai', 'partai')
                ->mapWithKeys(function ($value, $key) {
                    return [$key => $value];
                })
                ->toArray();

            // $partai = array_key_exists($data->partai, $partai) ? $partai[$data->partai] : 0;


        return view('welcome', compact('collection','partai'));


        // return view('welcome', compact('collection'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
