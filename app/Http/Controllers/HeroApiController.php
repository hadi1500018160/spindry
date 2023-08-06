<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Http\Request;

class HeroApiController extends Controller
{
    public function getData()
    {
        $heros = Hero::where('status','show')->first();
        $data = [
            'status' => 'success',
            'message' => 'data service berhasil di ambil',
            'data' => $heros
        ];
        return response()->json($data);
    }
}
