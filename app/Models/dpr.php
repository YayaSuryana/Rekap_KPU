<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dpr extends Model
{
    use HasFactory;

    public function scopeSearch($query)
    {
        return $query->where('transaksiID','like','%'.request('search').'%')->Orwhere('bulan','like','%'.request('search').'%')->orWhere('name','like','%'.request('search').'%');
    }


    public function scopeReport($query)
    {
        // // where date between
        // if (request('start_date') && request('end_date')) {
        //     $start =  Carbon::parse(request()->start_date)->startOfDay()->toDateTimeString();
        //     $end = Carbon::parse(request()->end_date)->endOfDay()->toDateTimeString();
        //     $filleter = $query->whereBetween('updated_at',[$start, $end]);
        //     return $filleter;
        // }else{
        //     return $query;
        // }
        // $collection = DB::table('dprs')
        // ->select('partai', DB::raw('SUM(total) as total_suara'))
        // ->where('partai', 'Partai Kebangkitan Bangsa') // Sesuaikan dengan nama partai yang Anda inginkan
        // ->groupBy('partai')
        // ->get();

        if (request('tps') && request('desa') && request('kecamatan') && request('kabupaten')) {
            $query->where('tps', request('tps'))
            ->where('desa', request('desa'))
            ->where('kecamatan', request('kecamatan'))
            ->where('kabupaten', request('kabupaten'))
            ->select('nama', 'tps', 'desa', 'kecamatan', 'kabupaten', 'partai', DB::raw('SUM(total) as total_suara'))
            
            ->groupBy('nama', 'tps', 'desa', 'kecamatan', 'kabupaten', 'partai')
            ->orderBy('total_suara', 'desc');
            return $query;
        }elseif (request('desa') && request('kecamatan') && request('kabupaten')) {
            $query->where('desa', request('desa'))
            ->where('kecamatan', request('kecamatan'))
            ->where('kabupaten', request('kabupaten'))
            ->select('nama', 'desa', 'kecamatan', 'kabupaten', 'partai', DB::raw('SUM(total) as total_suara'))
            
            ->groupBy('nama', 'desa', 'kecamatan', 'kabupaten', 'partai')
            ->orderBy('total_suara', 'desc');
            return $query;
        }elseif(request('kecamatan') && request('kabupaten')){
            $query->where('kecamatan', request('kecamatan'))
            ->where('kabupaten', request('kabupaten'))
            ->select('nama', 'kecamatan', 'kabupaten', 'partai', DB::raw('SUM(total) as total_suara'))
            ->groupBy('nama', 'kecamatan', 'kabupaten', 'partai')
            ->orderBy('total_suara', 'desc');
            return $query;
        }elseif(request('kabupaten')){
            $query->where('kabupaten', request('kabupaten'))
            ->select('nama','kabupaten', 'partai', DB::raw('SUM(total) as total_suara'))
            ->groupBy('nama', 'kabupaten', 'partai')
            ->orderBy('total_suara', 'desc');
            return $query;
        }else{
            return $query;
        }
    }
}
