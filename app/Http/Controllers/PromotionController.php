<?php

namespace App\Http\Controllers;

use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( Request $request)
    {
        $q = $request->q ;
        $pagination = $request->has('pagination') ? $request ->pagination:10;
        if($q)
        {
            $promotions = Promotion::where('title','like','%'.$q.'%')->paginate($pagination);
        } else{

            $promotions = Promotion::paginate($pagination); //cara membaca data ::all  $heroes bungkus hero memanggil data dari database
            //return $promotions;
        }
         return view('pages.promotion', compact('promotions','q','pagination'));   //compact untuk meyelipkan data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.promotion-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'title' => 'required|min:5|max:50',
            'discount' => 'required|min:0|max:100',
            'picture' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2044'
        ],
        [
            'title.required' => 'Kolom TITEL Tidak boleh kosong Tante!!',
            'title.min' => 'Kolom TITLE Terlalu Pendek! ',
            'title.max' => 'Kolom TITLE Terlalu Panjang! ',
            'discount.required' => 'Kolom DISCOUNT Tidak boleh kosong Tante!!',
            'discount.min' => 'Kolom DISCOUNT Terlalu Pendek !',
            'discount.max' => 'Kolom DISCOUNT Terlalu Panjang !',
            'picture.required' => 'Kolom PICTURE Tidak boleh kosong Tante!!',
            'pictute.image' => 'Kolom PICTURE harus file image! ',
            'picture.mimes' => 'File pada kolom  PICTURE harus jpeg, png, gif, atau svg! ',
            'picture.max' => 'File pada kolom  PICTURE terlalu besar!',
        ]
    );

        $picture = $request->file('picture');
        $filename = time() . '-' . rand() . $picture->getClientOriginalName(); //untuk insert file background 
        $picture->move(public_path('/img/promotions'), $filename); // kedalam folder publick img/hero (sesuaikan dengan folder anda)

        $status = $request->has('status') ? 'show' : 'hide'; //untuk mengatur hiden atau show

        Promotion::create([
            'title' => $request->title,
            'discount' => $request->discount,
            'picture' => $filename, //=> cara memangil array sedangkan -> untuk memangil object
            'status' => $status,
        ]);
        return redirect('/promotion')->with('success', $request->title.'berhasil ditambahkan');;
    }

    /**
     * Display the specified resource.
     */
    public function show(Promotion $promotion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promotion $promotion)
    {
        return view('pages.promotion-edit', compact('promotion'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promotion $promotion)
    {
         //return $request;
         $request->validate([
            'title' => 'required|min:5|max:10',
            'discount' => 'required|min:0|max:100', // mengatur angka discount
            // 'background' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2044'
         ],
         [
         'title.required' => 'Kolom TITEL Tidak boleh kosong Tante!!',
         'title.min' => 'Kolom TITLE Terlalu Pendek! ',
         'title.max' => 'Kolom TITLE Terlalu Panjang! ',
         'discount.required' => 'Kolom DISCOUNT Tidak boleh kosong Tante!!',
         'discount.min' => 'Kolom DISCOUNT Terlalu Pendek !',
         'discount.max' => 'Kolom DISCOUNT Terlalu Panjang !',
         ]
    );
        $status = $request->has('status') ? 'show' : 'hide'; //untuk mengatur hiden atau show
        unlink(public_path('/img/promotions/'.$promotion->picture));
        if ($request->has('picture')) {
            $picture = $request->file('picture');
            $filename = time() . '-' . rand() . $picture->getClientOriginalName(); //untuk insert file background 
            $picture->move(public_path('/img/promotions'), $filename); // kedalam folder publick img/hero (sesuaikan dengan folder anda)

            Promotion::where('id',$promotion->id)->update([
                'title' => $request->title,
                'discount' => $request->discount,
                'picture' => $filename, //=> cara memangil array sedangkan -> untuk memangil object
                'status' => $status,
            ]);
        }else
        {
            Promotion::where('id',$promotion->id)->update([
                'title' => $request->title,
                'discount' => $request->discount,
               //=> cara memangil array sedangkan -> untuk memangil object
                'status' => $status,
            ]);

        }
        return redirect('promotion');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promotion $promotion)
    {
        if(file_exists (asset('img/promotions/'.$promotion->picture)) ) {
            unlink(public_path('/img/promotions/'.$promotion->picture));
        }
            Promotion::destroy('id', $promotion->id);
            // Hero::where('id', $hero->id)->delete();
            return redirect('/promotion');
        }
    }

