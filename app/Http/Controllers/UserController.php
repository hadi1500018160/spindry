<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function createregister()
    {
        return view('pages.register');
    }
    public function storeRegister(Request $request)
    {
        // return $request;
        $request->validate(
            [
                'email'=> 'required|unique:users,name',
                'username'=> 'required|min:5|max:10|unique:users,name',
                'telephone'=> 'required|numeric',
                'address'=> 'required|min:10|max:255',
                'role'=> 'required',
                'password'=> 'required|min:8|max:30',
                'confirm_password'=> 'required|same:password',

            ],
            [
                'email.required' => 'Kolom Email Tidak boleh kosong Tante!!',
                'username.required' => 'Kolom Username Tidak boleh kosong Tante!!',
                'username.min' => ' Username terlalu pendek',
                'username.max' => ' Username terlalu panjang',
                'username.unique' => ' Username terlalu panjang',
                'telephone.required' => 'Kolom telephone Tidak boleh kosong Tante!!',
                'address.required' => 'Kolom address Tidak boleh kosong Tante!!',
                'role.required' => 'pilih role Tidak boleh kosong Tante!!',
                'password.required' => 'Kolom password Tidak boleh kosong Tante!!',
                'password.min' => ' password terlalu pendek',
                'password.max' => ' password terlalu panjang',
                'confirm_password.required' => 'Kolom confirm_password Tidak boleh kosong Tante!!',
                'confirm_password.same' => 'tidak sama dengan password',
                

            ] );

            User:: create([ 
                'email' => $request->email,
                'name' => $request->username,
                'telephone' => $request->telephone,
                'address' => $request->address,
                'role' => $request->role,
                'password' => Hash::make($request->password),

            ]);
            return redirect('/login');
    }
    public function login()
    {
        return view('pages.login');
    }
    public function prosesLogin(Request $request)
    {
        $request->validate(
            [
                'email' => 'required',
                'password'=> 'required|min:5|max:10',
            ]
            );

            $credential =[
                'email' => $request->email,
                'password'=> $request->password
              
            ];
            if(Auth::attempt($credential)){
                return redirect('/dashboard');
            }else{
                return redirect()->back()->with('gagal','Email atau Password tidak Sesuia');
            }
    }
    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
