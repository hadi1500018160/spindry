<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionApiController extends Controller
{
    public function getData()
    {
        $promotions = Promotion::where('status','show')->get();
        $data = [
            'status' => 'success',
            'message' => 'data service berhasil di ambil',
            'data' => $promotions
        ];
        return response()->json($data);
    }
}
