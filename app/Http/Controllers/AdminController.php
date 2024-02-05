<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

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
}
