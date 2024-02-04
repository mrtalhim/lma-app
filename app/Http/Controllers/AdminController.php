<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request) {
        if (session('user_type') != 'admin') {
            $data = User::where('id', session('user_id'))->get()->first();
            return view('edit-app', compact('data'));
        }
        $users = User::get([
            'id',
            'name',
            'aims',
            'cabang',
            'badan',
            'pendapatan_value'
        ]);
        return view('admin.index', compact('users'));
    }

    public function show(Request $request) {
        if(session('user_id') != 'admin') {
            return route('edit-app');
        }

        $id = $request->id;
        $data = User::where('id', $id)->get()->first();

        return view('jquery', 
        // [
        //     'data' => $data,
        //     'data_id' => $id,
        // ]
        )->with('data', $data);
    }
}
