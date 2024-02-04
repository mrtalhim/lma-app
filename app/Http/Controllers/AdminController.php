<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {
        if (session('user_type') != 'admin') {
            $data = User::where('id', session('user_id'))->get()->first();
            if (empty($data))
                return redirect()->route('index');
            else
                return view('edit-app', ['id'=>$data]);
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

    public function show($id) {
        if(session('user_id') != 'admin') {
            return redirect()->route('index');
        }

        $data = User::where('id', $id)->get()->first();

        return view('jquery', 
        // [
        //     'data' => $data,
        //     'data_id' => $id,
        // ]
        )->with('data', $data);
    }
}
