<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    // {
    //     //cara pemanggilan di awal tampil di browser
    //      $services = Service::all();
    //      return view('pages.service', compact('services'));
    // }
    {
        $q = $request->q;
        $pagination = $request->has('pagination') ? $request->pagination : 10;
        if ($q) {
            $services = Service::where('title', 'like', '%' . $q . '%')->paginate($pagination);
        } else {

            $services = Service::paginate($pagination); //cara membaca data ::all  $heroes bungkus hero memanggil data dari database
            //return $promotions;
        }
        return view('pages.service', compact('services', 'q', 'pagination'));   //compact untuk meyelipkan data
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.service-create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate(
            [
                'logo' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2044',
                'title' => 'required|min:5|max:50',
                'price' => 'required|numeric',
                'description' => 'required'
            ],
            [
                'logo.required' => 'Kolom Logo Tidak boleh kosong Tante!!',
                'logo.image' => 'Kolom Logo  harus file image! ',
                'logo.mimes' => 'File pada kolom Logo  harus jpeg, png, gif, atau svg! ',
                'logo.max' => 'File pada kolom Logo  terlalu besar!',
                'title.required' => 'Kolom TITEL Tidak boleh kosong Tante!!',
                'title.min' => 'Kolom TITLE Terlalu Pendek! ',
                'title.max' => 'Kolom TITLE Terlalu Panjang! ',
                'price.required' => 'Kolom PRICE Tidak boleh kosong Tante!!',
                'price.numeric' => 'Kolom PRICE harus angka! ',
                'description.required' => 'Kolom  DescriptionTidak boleh kosong Tante!!',
                'description.min' => 'Kolom Description Terlalu Pendek !',
                'description.max' => 'Kolom Description Terlalu Panjang !',
            ]
        );

        $logo = $request->file('logo');
        $filename = time() . '-' . rand() . $logo->getClientOriginalName(); //untuk insert file background 
        $logo->move(public_path('/img/services'), $filename); // kedalam folder publick img/hero (sesuaikan dengan folder anda)


        Service::create([
            'logo' => $filename, //=> cara memangil array sedangkan -> untuk memangil object
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        return redirect('/service')->with('success', $request->title . 'berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(Service $service)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        return view('pages.service-edit', compact('service'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {
        //return $request;
        $request->validate(
            [
                'title' => 'required|min:5|max:50',
                'price' => 'required|numeric',
                'description' => 'required' // mengatur angka discount
                // 'background' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2044'
            ],
            [
                'title.required' => 'Kolom TITEL Tidak boleh kosong Tante!!',
                'title.min' => 'Kolom TITLE Terlalu Pendek! ',
                'title.max' => 'Kolom TITLE Terlalu Panjang! ',
                'price.required' => 'Kolom PRICE Tidak boleh kosong Tante!!',
                'price.numeric' => 'Kolom PRICE harus angka! ',
                'description.required' => 'Kolom  DescriptionTidak boleh kosong Tante!!',
                'description.min' => 'Kolom Description Terlalu Pendek !',
                'description.max' => 'Kolom Description Terlalu Panjang !',
            ]
        );
        //untuk mengatur hiden atau show
       
        if ($request->has('service')) {
            unlink(public_path('/img/services/' . $service->logo));
            $logo = $request->file('service');
            $filename = time() . '-' . rand() . $logo->getClientOriginalName(); //untuk insert file background 
            $logo->move(public_path('/img/services'), $filename); // kedalam folder publick img/hero (sesuaikan dengan folder anda)

            Service::where('id', $service->id)->update([
                'logo' => $filename, //=> cara memangil array sedangkan -> untuk memangil object
                'title' => $request->title,
                'price' => $request->price,
                'description' => $request->description, //=> cara memangil array sedangkan -> untuk memangil object

            ]);
        } else {
            Service::where('id', $service->id)->update([
                'title' => $request->title,
                'price' => $request->price,
                //=> cara memangil array sedangkan -> untuk memangil object
                'description' => $request->description,
            ]);
        }
        return redirect('service');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        if (file_exists(public_path('img/services/' . $service->logo))) {
            unlink(public_path('/img/services/' . $service->logo));
        }
        Service::destroy('id', $service->id);
        // Hero::where('id', $hero->id)->delete();
        return redirect('/service');
    }
}
