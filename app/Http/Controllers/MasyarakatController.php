<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class MasyarakatController extends Controller
{
    public function index()
    {
        return view('masyarakat',['masyarakats'=>DB::table('tb_masyarakat')->get()]);
    }
    public function create(Request $request)
    {

        DB::table('tb_masyarakat')->insert([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => md5($request->password),
            'telp' => $request->telp,

        ]);
        return redirect()->back()->with(['message'=>'data berhasil di update','status'=>'success']);
    }

    public function update(Request $request, $id)
    {

        DB::table('tb_masyarakat')->where('id',$id)->update([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,

            'telp' => $request->telp,
        ]);
        return redirect()->back()->with(['message'=>'data berhasil di update','status'=>'success']);
    }

    public function delete($id)
    {
        DB::table('tb_masyarakat')->where('id',$id)->delete();
        return redirect()->back();
    }
}
