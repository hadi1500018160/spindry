<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Validator;

class UserApiController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'password' => 'required',
                'address' => 'required',
                'telephone' => 'required',
                'email' => 'required|unique:users,email',
                'name' => 'required|unique:users,name'
            ],
            [
                'name.required' => 'username tidak boleh kosong !',
                'name.unique' => 'username telah terdaftar sebelumnya!!',
                'password.required' => 'password tidak boleh kosong !',
                'email.required' => 'email tidak boleh kosong!!',
                'email.unique' => 'email telah terdaftar sebelumnya!!',
                'address.required' => 'address tidak boleh kosong!!',
                'telephone.required' => 'handphone tidak boleh kosong!!',

            ]
        );
        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => $validator->errors() //json
                ]
            );
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'telephone' => $request->telephone,
            'role' => 'user',
            'password' => Hash::make($request->password)
        ]);
        return response()->json(
            [
                'status' => 'success',
                'message' => ' berhasil register !',
            ]

            );

    }
    public function login(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'email' => 'required',
                'password' => 'required'
            ],
            [
                'email.required' => 'email tidak boleh kosong !',
                'password.required' => 'password tidak boleh kosong !'
            ]
        );

        if ($validator->fails()) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' =>$validator->errors()
                ]
            );
        }
        $credential = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($credential)) {
            $user = User::where('email', $request->email)->first();
            $token = $user->createToken('authToken')->plainTextToken;
            $user->token = $token;
            $user->token_type = 'Bearer';
            $data = [
                'status' => 'success',
                'message' => 'anda berhasil login !',
                'data' => $user,
            ];
            return response()->json($data);
        } else {
            $pesan = [
                'pesan' => ['email atau password salah silahkan ulang kembali !']
            ];
            $data = [
                'status' => 'error',
                'message' => $pesan,
                'data' => NULL,
            ];
            return response()->json($data);
        }
    }

    public function logout()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $user->tokens()->delete();
        return response()->json(
            [
                'status' => 'success',
                'message' => 'berhasil keluar',
                'data' => NULL,
            ]
        );
    }
}