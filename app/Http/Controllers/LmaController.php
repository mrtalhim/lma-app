<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LmaController extends Controller
{
    public function index(Request $request) {
        return view('jquery',);
    }
    public function show(Request $request) {
        return view('jquery',);
    }

    public function store(Request $request) {
        return view('index', [
            'penghasilan' => $request->input('penghasilan'),
            'wasiyatType' => $request->input('wasiyatType')
        ]);
    }
}
