<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LmaController extends Controller
{
    public function show(Request $request) {
        return view('index',);
    }
    
    public function store(Request $request) {
        return view('index', [
            'penghasilan' => $request->input('penghasilan'),
            'wasiyatType' => $request->input('wasiyatType')
        ]);
    }
}
