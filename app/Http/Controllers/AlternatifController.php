<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;


class AlternatifController extends Controller
{
    //
    public function LihatAlternatif(){
        $alternatif = Alternatif::get();
        return view('admin.alternatif.lihat_alternatif', compact('alternatif'));


    }// End Method

    public function TambahAlternatif(){

        return view('admin.alternatif.tambah_alternatif');


    }// End Method

    public function UbahAlternatif($id){

        $alternatif = Alternatif::findOrFail($id);
        return view('admin.alternatif.ubah_alternatif', compact('alternatif'));


    }// End Method

    public function SimpanAlternatif(Request $request){
        $request->validate([
            'nama_alternatif' => 'required',
        ],[
            'nama_alternatif.required' => 'Nama Kriteria Tidak Boleh Kosong',
        ]);

        Alternatif::insert([
            'nama_alternatif' => $request->nama_alternatif,
            'deskripsi_alternatif' => $request->deskripsi_alternatif,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Alternatif Berhasil Ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('lihat.alternatif')->with($notification);


    }// End Method

    public function HapusAlternatif($id){

        Alternatif::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Alternatif telah berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);    


    }// End Method

    public function UpdateAlternatif(Request $request){

        $request->validate([
            'nama_alternatif' => 'required',
        ],[
            'nama_alternatif.required' => 'Nama Kriteria Tidak Boleh Kosong',
        ]);

        $kriteria_id = $request->id;
            Alternatif::findOrFail($kriteria_id)->update([
                'nama_alternatif' => $request->nama_alternatif,
                'deskripsi_alternatif' => $request->deskripsi_alternatif,
            ]);
            $notification = array(
                'message' => 'Alternatif telah berhasil diupdate',
                'alert-type' => 'success'
            );
            return redirect()->route('lihat.alternatif')->with($notification);
    }// End Method

}
