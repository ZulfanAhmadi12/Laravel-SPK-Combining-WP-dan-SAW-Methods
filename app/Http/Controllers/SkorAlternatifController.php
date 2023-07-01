<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SkorAlternatif;

class SkorAlternatifController extends Controller
{
    //
    public function LihatSkorAlternatif(){
        $skoralternatif = SkorAlternatif::orderByDesc('skor')->get();
        return view('admin.skoralternatif.lihat_skor', compact('skoralternatif'));


    }// End Method

    public function HapusSkorAlternatif($id){

        SkorAlternatif::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Skor Alternatif telah berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);    


    }// End Method
}
