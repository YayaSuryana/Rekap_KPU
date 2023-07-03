<?php

namespace App\Http\Controllers;
use App\Models\Dprd;
use App\Models\Desa;
use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\Parpol;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DprdController extends Controller
{
    public function index()
    {
        $kab = request('kabupaten');
        $kec = request('kecamatan');
        $des = request('desa');
        $tps = request('tps');
        $collection = Dprd::report()->get();

        $partai = Dprd::select('partai', DB::raw('SUM(total) AS total_suara_partai'))
                
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

            $tpsVal = Dprd::select('tps', DB::raw('SUM(total) AS total_suara_tps'))

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
        
            
            
            
            $desaVal = Dprd::select('desa', DB::raw('SUM(total) AS total_suara_desa'))
        
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


            $kecamatanVal = Dprd::select('kecamatan', DB::raw('SUM(total) AS total_suara_kecamatan'))
        
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
            
            $kabupatenVal = Dprd::select('kabupaten', DB::raw('SUM(total) AS total_suara_kabupaten'))
        
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

        return view('dprd', compact('collection','partai','tpsVal','desaVal','kecamatanVal','kabupatenVal','kabupaten','parpol','kab','kec','des','tps'));

    }
}
