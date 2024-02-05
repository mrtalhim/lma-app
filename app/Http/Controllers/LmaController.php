<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LmaController extends Controller
{
    public function index() {
        if (empty(auth()->user()->id))
            return view('index');
        else {;
            return redirect()->route('edit-app', auth()->user()->id);
        }
    }
    
    public function show($id, $message = '') {
        if (auth()->user()->id == $id || auth()->user()->type == 'admin') {
            $data = User::where('id', $id)->get()->first();
    
            return view('jquery', ['data'=>$data])
            ->with('message', $message);
        } else {
            return redirect()->route('edit-app', ['id'=>auth()->user()->id])
            ->with('message', 'Silakan mengubah informasi APP milik sendiri');
        }
    }

    public function store(Request $request) {

        $badanType = [
            'Khuddam'=> 25/1000,
            'Ansharullah'=> 15/1000,
            'Lajnah'=> 1/100,
            'Abna'=> 0.0,
            'Banath'=> 0.0,
            'Athfal'=> 0.0,
            'Nasirat'=> 0.0,

        ];
        
        $wasiyat_list = [
            1 => 1/10,
            2 => 1/5,
            3 => 1/3,
        ];

        $id = $request->id;
        $user = User::where('id', $id)->get()->first();
        $user->is_musi = $request->isWasiyat;
        $user->wasiyat_type = $request->wasiyatType;
        $user->pendapatan_value = $request->penghasilan;
        $user->jalsah_value = $request->penghasilan / 120;
        $user->iuran_badan_value = max([$request->penghasilan / 100, 7500]);

        $user->candah_value = $request->penghasilan * $wasiyat_list[$request->wasiyatType];

        $user->ijtima_badan_value = $request->penghasilan * $badanType[$user->badan];
        
        $user->save();

        return back()->with('message', 'Data sudah tersimpan');
    }

    public function login(Request $request) {

        $find_aims = $request->aims;
        $find_badan = $request->badan;
        $find_cabang = $request->cabang;

        if (empty($find_aims) || empty($find_badan) || empty($find_cabang)) {
            return back()->with('message', 'User tidak ditemukan');
        }
        
        $result = User::where('aims', $find_aims)->where('badan', $find_badan)->where('cabang', $find_cabang)->get()->first(); 
        
        if (!empty($result)) {
            auth()->login($result);

            if(auth()->user()->type == 'user') {
                return redirect()->route('edit-app', $result);
            } else if(auth()->user()->type == 'admin') {
                return view('result');
            }

        }
        else
            return back()->with('message', 'User tidak ditemukan');
    }

    public function logout() {

        Auth::logout();

        return redirect()->route('index');
    }
}
