<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use App\Models\SubKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class SubKriteriaController extends Controller
{
    //
    public function LihatSubkriteria(){
        $subkriteriaList = SubKriteria::with('kriteria')->get();

        
        return view('admin.subkriteria.lihat_subkriteria', compact('subkriteriaList'));


    }// End Method

    public function TambahSubkriteria(){

        return view('admin.subkriteria.tambah_subkriteria');

    }// End Method

    public function UbahSubkriteria($id){

        $subkriteria = SubKriteria::with('kriteria')->findOrFail($id);
        return view('admin.subkriteria.ubah_subkriteria', compact('subkriteria'));


    }// End Method

    public function SimpanSubkriteria(Request $request){
        $request->validate([
            'nama_subkriteria' => 'required',
            'kriteria_id' => 'required',
            'bobot_sub' => 'required',
        ],[
            'nama_subkriteria.required' => 'Nama Sub-Kriteria Tidak Boleh Kosong',
            'kriteria_id.required' => 'Wajib Memilih Salah Satu Kriteria',
            'bobot_sub.required' => 'Bobot Sub-Kriteria Tidak Boleh Kosong',
        ]);

        if($request->bobot_sub <= 0){
            $notification = array(
                'message' => 'Sub Kriteria Gagal Diubah, Bobot Sebuah Sub-Kriteria Tidak Boleh Kurang Dari Sama Dengan 0 ',
                'alert-type' => 'error'
            );
    
            return redirect()->route('lihat.subkriteria')->with($notification);
        }

        SubKriteria::insert([
            'nama_subkriteria' => $request->nama_subkriteria,
            'kriteria_id' => $request->kriteria_id,
            'bobot_sub' => $request->bobot_sub,
            'created_at' => Carbon::now()
        ]);
        $notification = array(
            'message' => 'Sub-Kriteria Berhasil Ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('lihat.subkriteria')->with($notification);


    }// End Method

    public function UpdateSubkriteria(Request $request){
        $request->validate([
            'nama_subkriteria' => 'required',
            'kriteria_id' => 'required',
            'bobot_sub' => 'required',
        ],[
            'nama_subkriteria.required' => 'Nama Sub-Kriteria Tidak Boleh Kosong',
            'kriteria_id.required' => 'Wajib Memilih Salah Satu Kriteria',
            'bobot_sub.required' => 'Bobot Sub-Kriteria Tidak Boleh Kosong',
        ]);

        if($request->bobot_sub <= 0){
            $notification = array(
                'message' => 'Sub Kriteria Gagal Diubah, Bobot Sebuah Sub-Kriteria Tidak Boleh Kurang Dari Sama Dengan 0 ',
                'alert-type' => 'error'
            );
    
            return redirect()->route('lihat.subkriteria')->with($notification);
        }

        $subkriteria_id = $request->id;
            SubKriteria::findOrFail($subkriteria_id)->update([
                'nama_subkriteria' => $request->nama_subkriteria,
                'kriteria_id' => $request->kriteria_id,
                'bobot_sub' => $request->bobot_sub,
            ]);
            $notification = array(
                'message' => 'Sub-Kriteria telah berhasil diupdate',
                'alert-type' => 'success'
            );
            return redirect()->route('lihat.subkriteria')->with($notification);
    }// End Method

    public function HapusSubkriteria($id){

        SubKriteria::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub-Kriteria telah berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);    


    }// End Method
}
