<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Kabupaten;
use Illuminate\Http\Request;

class WilayahController extends Controller
{
    public function getKabupaten(Request $request)
    {
        $provinsiId = $request->get('provinsi_id');

        $kabupatens = Kabupaten::where('provinsi_id', $provinsiId)->orderBy('nama')->get();

        return response()->json($kabupatens);
    }
}
