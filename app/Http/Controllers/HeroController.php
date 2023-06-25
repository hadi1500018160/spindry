<?php

namespace App\Http\Controllers;

use App\Models\Hero;
use Illuminate\Contracts\Pagination\Paginator;
use Illuminate\Http\Request;

class HeroController extends Controller
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
             $heroes = Hero::where('title','like', '%'.$q.'%')->paginate($pagination);
        } else{
            // $heroes = Hero::all(); //cara membaca data ::all  $heroes bungkus hero memanggil data dari database
            //return $heroes;
              
             $heroes = Hero::paginate($pagination);
            //  return $heroes;

        }
        return view('pages.hero', compact('heroes','q','pagination'));   //compact untuk meyelipkan data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.hero-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //return $request;
        //Hero :: create($request->all());
        //jonsen(|) = atau
        //



        $request->validate([
            'title' => 'required|min:5|max:10',
            'subtitle' => 'required|min:10|max:30',
            'background' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2044'
        ],
        [
            'title.required' => 'Kolom TITEL Tidak boleh kosong Tante!!',
            'title.min' => 'Kolom TITLE Terlalu Pendek! ',
            'title.max' => 'Kolom TITLE Terlalu Panjang! ',
            'subtitle.required' => 'Kolom SUBTITLE Tidak boleh kosong Tante!!',
            'subtitle.min' => 'Kolom SUBTITLE Terlalu Pendek !',
            'subtitle.max' => 'Kolom SUBTITLE Terlalu Panjang !',
            'background.required' => 'Kolom BACKGROUND Tidak boleh kosong Tante!!',
            'background.image' => 'Kolom BACKGROUND harus file image! ',
            'background.mimes' => 'File pada kolom  BACKGROUND harus jpeg, png, gif, atau svg! ',
            'background.max' => 'File pada kolom  BACKGROUND terlalu besar!',
        ]
    );

        $background = $request->file('background');
        $filename = time() . '-' . rand() . $background->getClientOriginalName(); //untuk insert file background 
        $background->move(public_path('/img/heros'), $filename); // kedalam folder publick img/hero (sesuaikan dengan folder anda)

        $status = $request->has('status') ? 'show' : 'hide'; //untuk mengatur hiden atau show

        Hero::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'background' => $filename, //=> cara memangil array sedangkan -> untuk memangil object
            'status' => $status,
        ]);
        return redirect('/hero')->with('success', $request->title.'berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Hero $hero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Hero $hero)
    {
        //untuk menambah gambar
        //return $hero;
        return view('pages.hero-edit', compact('hero'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Hero $hero)
    {
        //return $request;
        $request->validate(
            [
            'title' => 'required|min:5|max:10',
            'subtitle' => 'required|min:10|max:30',
            // 'background' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2044'
            ],
            [
                'title.required' => 'Kolom TITEL Tidak boleh kosong Tante!!',
                'title.min' => 'Kolom TITLE Terlalu Pendek! ',
                'title.max' => 'Kolom TITLE Terlalu Panjang! ',
                'subtitle.required' => 'Kolom SUBTITLE Tidak boleh kosong Tante!!',
                'subtitle.min' => 'Kolom SUBTITLE Terlalu Pendek !',
                'subtitle.max' => 'Kolom SUBTITLE Terlalu Panjang !',
            ]
    );
        $status = $request->has('status') ? 'show' : 'hide'; //untuk mengatur hiden atau show
       
        if ($request->has('background')) {
            unlink(public_path('/img/heros/'.$hero->background));
            $background = $request->file('background');
            $filename = time() . '-' . rand() . $background->getClientOriginalName(); //untuk insert file background 
            $background->move(public_path('/img/heros'), $filename); // kedalam folder publick img/hero (sesuaikan dengan folder anda)

            Hero::where('id',$hero->id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
                'background' => $filename, //=> cara memangil array sedangkan -> untuk memangil object
                'status' => $status,
            ]);
        }else
        {
            Hero::where('id',$hero->id)->update([
                'title' => $request->title,
                'subtitle' => $request->subtitle,
               //=> cara memangil array sedangkan -> untuk memangil object
                'status' => $status,
            ]);

        }
        return redirect('hero');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Hero $hero)
    {
        if(file_exists (public_path('img/heros/'.$hero->background)) ) {
        unlink(public_path('/img/heros/'.$hero->background));
    }
        Hero::destroy('id', $hero->id);
        // Hero::where('id', $hero->id)->delete();
        return redirect('/hero');
    }
}
