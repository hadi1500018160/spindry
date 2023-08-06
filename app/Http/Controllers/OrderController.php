<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request) //pernyataan dari index
    {
        $q = $request->q ;
        $pagination = $request->has('pagination') ? $request ->pagination:10;
        if($q)
        {
            // $heroes = Hero::where('title','like', '%'.$q.'%')->get();
             $orders = Order::where('title','like', '%'.$q.'%')->paginate($pagination);
        } else{
            // $heroes = Hero::all(); //cara membaca data ::all  $heroes bungkus hero memanggil data dari database
            //return $heroes;
              
             $orders = Order::paginate($pagination);
            //  return $heroes;

        }
        return view('pages.order', compact('orders','q','pagination'));   //compact untuk meyelipkan data
    }
    
     public function status(Order $order)
     {
        if ($order->status == 'notYet') {
            Order::where('id', $order->id)->update([
                'status' => 'finish'
            ]);
            return redirect()->back()->with('status','Status order no'.$order->number. 'berhasil diupdate');
        }else{
            return redirect()->back()->with('status','Status order no'.$order->number. 'telah selesai');
        }
     }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
