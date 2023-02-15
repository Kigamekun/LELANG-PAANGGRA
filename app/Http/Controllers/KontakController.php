<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class KontakController extends Controller
{
    public function index()
    {
        return view('vkontak',['lelangs'=>DB::table('tb_lelang')->get()]);
    }
    public function create(Request $request)
    {

        DB::table('lelang')->insert([
            'nama_lelang' => $request->nama_lelang
        ]);
        return redirect()->back()->with(['message'=>'data berhasil di create','status'=>'success']);
    }

    public function update(Request $request, $id)
    {

        DB::table('lelang')->where('id_lelang',$id)->update([
            'nama_lelang' => $request->nama_lelang
        ]);
        return redirect()->back()->with(['message'=>'data berhasil di update','status'=>'success']);
    }

    public function delete($id)
    {
        DB::table('lelang')->where('id_lelang',$id)->delete();
        return redirect()->back();
    }
}
