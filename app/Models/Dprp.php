<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dprp extends Model
{
    use HasFactory;

    public function scopeReport($query)
    {
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
        }elseif(request('partai')){
            $query->where('partai', request('partai'))
            ->select('nama','partai', DB::raw('SUM(total) as total_suara'))
            ->groupBy('nama', 'partai')
            ->orderBy('total_suara', 'desc');
            return $query;
        }elseif (request('partai') && request('tps') && request('desa') && request('kecamatan') && request('kabupaten')) {
                $query->where('partai', request('partai'))
                ->where('tps', request('tps'))
                ->where('desa', request('desa'))
                ->where('kecamatan', request('kecamatan'))
                ->where('kabupaten', request('kabupaten'))
                ->select('nama', 'tps', 'desa', 'kecamatan', 'kabupaten', 'partai', DB::raw('SUM(total) as total_suara'))
                
                ->groupBy('nama', 'partai','tps','desa','kecamatan','kabupaten')
                
                ->orderBy('total_suara', 'desc');
                return $query;
        }elseif (request('partai') && request('desa') && request('kecamatan') && request('kabupaten')) {
            $query->where('partai', request('partai'))
            ->where('desa', request('desa'))
            ->where('kecamatan', request('kecamatan'))
            ->where('kabupaten', request('kabupaten'))
            ->select('nama', 'tps', 'desa', 'kecamatan', 'kabupaten', DB::raw('SUM(total) as total_suara'))
            
            ->groupBy('nama','partai','desa','kecamatan','kabupaten')
            
            ->orderBy('total_suara', 'desc');
            return $query;
        }elseif (request('partai') && request('kecamatan') && request('kabupaten')) {
            $query->where('partai', request('partai'))
            ->where('kecamatan', request('kecamatan'))
            ->where('kabupaten', request('kabupaten'))
            ->select('nama', 'desa', 'kecamatan', 'kabupaten', 'partai', DB::raw('SUM(total) as total_suara'))
            
            ->groupBy('nama','partai','kecamatan','kabupaten')
            
            ->orderBy('total_suara', 'desc');
            return $query;
        }elseif(request('partai') && request('kabupaten')){
            $query->where('partai', request('partai'))
            ->where('kabupaten', request('kabupaten'))
            ->select('nama','kabupaten', 'partai', DB::raw('SUM(total) as total_suara'))
            ->groupBy('nama','partai','kabupaten')
            ->orderBy('total_suara', 'desc');
            return $query;
        }else{
            return $query;
        }
    }
}
