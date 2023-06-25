<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionApiController extends Controller
{
    public function getData()
    {
        $Promotions = Promotion::all();
        return response()->json($Promotions);
    }
}
