<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class BeritaController extends Controller
{
    public function index()
    {
        return view('vberita',['barangs'=>DB::table('tb_barang')->get()]);
    }
    public function create(Request $request)
    {

        DB::table('tb_barang')->insert([
            'nama_barang' => $request->nama_barang,
            'tgl' => $request->tgl,
            'harga_awal' => $request->harga_awal,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
        ]);
        return redirect()->back()->with(['message'=>'data berhasil di update','status'=>'success']);
    }

    public function update(Request $request, $id)
    {

        DB::table('tb_barang')->where('id_barang',$id)->update([
            'nama_barang' => $request->nama_barang,
            'tgl' => $request->tgl,
            'harga_awal' => $request->harga_awal,
            'deskripsi_barang' => $request->deskripsi_barang,
            'status_barang' => $request->status_barang,
        ]);
        return redirect()->back()->with(['message'=>'data berhasil di update','status'=>'success']);
    }

    public function delete($id)
    {
        DB::table('tb_barang')->where('id_barang',$id)->delete();
        return redirect()->back();
    }
}
