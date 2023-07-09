<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class KriteriaController extends Controller
{
    //

    public function LihatKriteria(){
        $kriteria = Kriteria::get();
        return view('admin.kriteria.lihat_kriteria', compact('kriteria'));


    }// End Method

    public function TambahKriteria(){

        return view('admin.kriteria.tambah_kriteria');


    }// End Method

    public function HapusKriteria($id){

        Kriteria::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Kriteria telah berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);    


    }// End Method

    public function UbahKriteria($id){

        $kriteria = Kriteria::findOrFail($id);
        return view('admin.kriteria.ubah_kriteria', compact('kriteria'));


    }// End Method

    public function SimpanKriteria(Request $request){
        $request->validate([
            'nama_kriteria' => 'required',
            'atribut_kriteria' => 'required',
            'bobot' => 'required',
        ],[
            'nama_kriteria.required' => 'Nama Kriteria Tidak Boleh Kosong',
            'atribut_kriteria.required' => 'Atribut Kriteria Tidak Boleh Kosong',
            'bobot.required' => 'Bobot Tidak Boleh Kosong',
        ]);

        if($request->bobot > 100){
            $notification = array(
                'message' => 'Kriteria Gagal Ditambahkan, Bobot Sebuah Kriteria Tidak Boleh Melebihi Angka 100',
                'alert-type' => 'error'
            );
    
            return redirect()->route('tambah.kriteria')->with($notification);
        }

        Kriteria::insert([
            'nama_kriteria' => $request->nama_kriteria,
            'atribut_kriteria' => $request->atribut_kriteria,
            'bobot' => $request->bobot,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Kriteria Berhasil Ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('lihat.kriteria')->with($notification);


    }// End Method

    public function UpdateKriteria(Request $request){

        $request->validate([
            'nama_kriteria' => 'required',
            'atribut_kriteria' => 'required',
            'bobot' => 'required',
        ],[
            'nama_kriteria.required' => 'Nama Kriteria Tidak Boleh Kosong',
            'atribut_kriteria.required' => 'Atribut Kriteria Tidak Boleh Kosong',
            'bobot.required' => 'Bobot Tidak Boleh Kosong',
        ]);

        if($request->bobot > 100){
            $notification = array(
                'message' => 'Kriteria Gagal Diubah, Bobot Sebuah Kriteria Tidak Boleh Melebihi Angka 100',
                'alert-type' => 'error'
            );
    
            return redirect()->route('lihat.kriteria')->with($notification);
        }

        $kriteria_id = $request->id;
            Kriteria::findOrFail($kriteria_id)->update([
                'nama_kriteria' => $request->nama_kriteria,
                'atribut_kriteria' => $request->atribut_kriteria,
                'bobot' => $request->bobot,
            ]);
            $notification = array(
                'message' => 'Kriteria telah berhasil diupdate',
                'alert-type' => 'success'
            );
            return redirect()->route('lihat.kriteria')->with($notification);
    }// End Method

}
