<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Dpr;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Parpol;
use Illuminate\Support\Facades\DB;

class DprController extends Controller
{
    public function getKecamatan(Request $request){
        $kecamatan = Kecamatan::where("id_kabupaten", $request->kabID)
        ->orderBy('kecamatan','asc')
        ->pluck('kecamatan');
        return response()->json($kecamatan);
    }
    
    public function getDesa(Request $request){
        $desa = Desa::where("id_kematan", $request->kecID)
        ->orderBy('desa','asc')
        ->pluck('desa');
        return response()->json($desa);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kab = request('kabupaten');
        $kec = request('kecamatan');
        $des = request('desa');
        $tps = request('tps');
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
        ->when(request('partai'), function ($query){
            return $query->where('partai', request('partai'))->havingRaw('SUM(total) > 0');
        })
        ->groupBy('partai')
        ->pluck('total_suara_partai', 'partai')
        ->mapWithKeys(function ($value, $key) {
            return [$key => $value];
        })
        ->toArray();

            $tpsVal = Dpr::select('tps', DB::raw('SUM(total) AS total_suara_tps'))

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
            ->when(request('partai'), function ($query){
                return $query->where('partai', request('partai'))->havingRaw('SUM(total) > 0');
            })
            ->groupBy('tps')
            ->pluck('total_suara_tps', 'tps')
            ->mapWithKeys(function ($value, $key) {
                return [$key => $value];
            })
            ->toArray();
        
            
            
            
            $desaVal = Dpr::select('desa', DB::raw('SUM(total) AS total_suara_desa'))
        
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
            ->when(request('partai'), function ($query){
                return $query->where('partai', request('partai'))->havingRaw('SUM(total) > 0');
            })
            ->groupBy('desa')
            ->pluck('total_suara_desa', 'desa')
            ->mapWithKeys(function ($value, $key) {
                return [$key => $value];
            })
            ->toArray();


            $kecamatanVal = Dpr::select('kecamatan', DB::raw('SUM(total) AS total_suara_kecamatan'))
        
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
            ->when(request('partai'), function ($query){
                return $query->where('partai', request('partai'))->havingRaw('SUM(total) > 0');
            })
            ->groupBy('kecamatan')
            ->pluck('total_suara_kecamatan', 'kecamatan')
            ->mapWithKeys(function ($value, $key) {
                return [$key => $value];
            })
            ->toArray();
            
            $kabupatenVal = Dpr::select('kabupaten', DB::raw('SUM(total) AS total_suara_kabupaten'))
        
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
            ->when(request('partai'), function ($query){
                return $query->where('partai', request('partai'))->havingRaw('SUM(total) > 0');
            })
            ->groupBy('kabupaten')
            ->pluck('total_suara_kabupaten', 'kabupaten')
            ->mapWithKeys(function ($value, $key) {
                return [$key => $value];
            })
            ->toArray();
            
            $kabupaten = Kabupaten::all();
            $parpol = Parpol::all();

        return view('welcome', compact('collection','partai','tpsVal','desaVal','kecamatanVal','kabupatenVal','kabupaten','parpol','kab','kec','des','tps'));


        // return view('welcome', compact('collection'));
    }

    public function kecamatan(request $request)
    {
        $kabupatens = $request->kabupatens;
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupatens)->get();
        // dd($kecamatans);
        foreach($kecamatans as $kecamatan){
            echo "<option value='$kecamatan->kecamatan'>$kecamatan->kecamatan</option>";
        }
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
