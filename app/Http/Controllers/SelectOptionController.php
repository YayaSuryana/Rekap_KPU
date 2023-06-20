<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kecamatan;

class SelectOptionController extends Controller
{
    public function kecamatan(request $request)
    {
        $kabupatens = $request->kabupatens;
        $kecamatans = Kecamatan::where('kabupaten_id', $kabupatens)->get();
        // dd($kecamatans);
        foreach($kecamatans as $kecamatan){
            echo "<option value='$kecamatan->kecamatan'>$kecamatan->kecamatan</option>";
        }
    }
}
