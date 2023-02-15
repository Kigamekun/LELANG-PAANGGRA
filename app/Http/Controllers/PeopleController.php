<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PeopleController extends Controller
{
    public function index()
    {
        return view('vpeople',['historys'=>DB::table('history_lelang')->get()]);
    }
    public function create(Request $request)
    {



        try {
            DB::table('history_lelang')->insert([
                'id_lelang' => $request->id_lelang,
                'penawaran_harga' => $request->penawaran_harga
            ]);
            return redirect()->back()->with(['message'=>'data berhasil di update','status'=>'success']);
        } catch (\Illuminate\Database\QueryException $ex) {
            return redirect()->back()->with(['message'=>'data berhasil di gagal '.$ex->getMessage(),'status'=>'error']);
            //throw $th;
        }
    }


}
