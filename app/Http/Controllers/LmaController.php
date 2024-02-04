<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LmaController extends Controller
{
    public function index() {
        if (empty(session('user_id')))
            return view('index');
        else {
            $id = session('user_id');
            $data = User::where('id', $id)->get()->first();
            return redirect()->route('edit-app', $data);
        }
    }
    
    public function show($id) {
        $data = User::where('id', $id)->get()->first();

        return view('jquery')->with('data', $data);
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

        return back()->with('message', 'tersimpan');
    }

    public function login(Request $request) {

        $find_aims = $request->aims;
        $find_badan = $request->badan;
        $find_cabang = $request->cabang;

        if (empty($find_aims) || empty($find_badan) || empty($find_cabang)) {
            return back();
        }
        
        $result = User::where('aims', $find_aims)->where('badan', $find_badan)->where('cabang', $find_cabang)->get()->first(); 
        
        $id = $result->id;
        $aims = $result->aims;
        $badan = $result->badan;
        $cabang = $result->cabang;
        $type = $result->type;

        if (!empty($result)) {
            session([
                'user_id'=>$id,
                'user_aims'=>$aims,
                'user_badan'=>$badan,
                'user_cabang'=>$cabang,
                'user_type'=>$type
            ]);

            if(session('user_type') == 'user') {
                return redirect()->route('edit-app', $result);
            } else if(session('user_type') == 'admin') {
                return view('result', compact('aims', 'badan', 'cabang', 'result', 'id'));
            }

        }
        else
            return back();
    }

    public function logout() {
        session()->forget([
            'user_id',
            'user_aims',
            'user_badan',
            'user_cabang',
            'user_type'
        ]);
        return redirect()->route('index');
    }
}
