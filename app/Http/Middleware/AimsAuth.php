<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;

class AimsAuth
{
    public function handle(Request $request) {
        if ($request->isMethod('POST')) {
            $aims = $request->input('aims');
            $badan = $request->input('badan');
            $cabang = $request->input('cabang');

            
        }
    }
}
