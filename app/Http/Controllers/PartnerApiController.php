<?php

namespace App\Http\Controllers;

use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerApiController extends Controller
{
    public function getData()
    {
        $partners = Partner::where('status','show')->get();
        $data = [
            'status' => 'success',
            'message' => 'data service berhasil di ambil',
            'data' => $partners
        ];
        return response()->json($data);
    }
}
