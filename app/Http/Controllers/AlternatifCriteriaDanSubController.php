<?php

namespace App\Http\Controllers;

use App\Models\AlternatifCriteriaDanSub;
use App\Models\Kriteria;
use App\Models\SkorAlternatif;
use App\Models\SubKriteria;
use Illuminate\Support\Carbon;

use Illuminate\Http\Request;

use function PHPUnit\Framework\isEmpty;

class AlternatifCriteriaDanSubController extends Controller
{
    protected $NilaiAlternatif = [];

    //
    public function LihatAlternatifKriteria(){
        $alternatifCriteriaSubs = AlternatifCriteriaDanSub::all();
        return view('admin.nilaialternatif.lihat_nilaialternatif', compact('alternatifCriteriaSubs'));


    }// End Method

    public function HapusAlternatifKriteria($id){

        AlternatifCriteriaDanSub::where('alternatif_id', $id)->delete();        
        $notification = array(
            'message' => 'Nilai Alternatif telah berhasil dihapus',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);    


    }// End Method

    public function SimpanAlternatifKriteria(Request $request){
        $alternatifId = $request->alternatif_id;
        $subId = $request->subkriteria_id;
        $kritId = $request->kriteria_id;
        
        $data = [];
        $periksaAlternatifId = AlternatifCriteriaDanSub::where('alternatif_id', $request->alternatif_id)->first();
        if(isset($periksaAlternatifId)){
            if($periksaAlternatifId->alternatif_id == $alternatifId){
                $notification = array(
                    'message' => 'Gagal Menambahkan Karena Nilai Alternatif Tersebut Telah Ada',
                    'alert-type' => 'error'
                );
        
                return redirect()->route('lihat.alternatifkriteria')->with($notification);
            }
        }

        
        // Get the total count of $subId
        $count = count($subId);

        // Iterate over the input values to construct the data array
        for ($i = 0; $i < $count; $i++) {
            $data[] = [
                'alternatif_id' => $alternatifId,
                'sub_kriteria_id' => $subId[$i],
                'kriteria_id' => $kritId[$i],
            ];
        }
        // Simpan data masukan ke dalam tabel intermediasi
        AlternatifCriteriaDanSub::insert($data);

        $notification = array(
            'message' => 'Nilai Alternatif Berhasil Ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('lihat.alternatifkriteria')->with($notification);
    } // End Method

    public function TambahAlternatifKriteria(){
        return view('admin.nilaialternatif.tambah_nilaialternatif');

    }// End Method

    public function HitungSkorAlternatif(){
        $namaAlternatif = [];
        $this->NilaiAlternatif = collect([]);


        $alternatifCriteriaSubs = AlternatifCriteriaDanSub::all();


        $data = [];
        $hasilHitungSkor = $this->HitungSkor($alternatifCriteriaSubs);
        foreach($hasilHitungSkor as $alternatifId => $skor){
            $data[] = [
                'alternatif_id' => $alternatifId,
                'skor' => $skor,
                'created_at' => Carbon::now(),
            ];
        }
        SkorAlternatif::insert($data);
        $notification = array(
            'message' => 'Hasil perhitungan berhasil ditambahkan',
            'alert-type' => 'success'
        );

        return redirect()->route('lihat.skoralternatif')->with($notification);

    }// End Method

    public function HitungSkor($AlternatifItem){
        $kriteria = Kriteria::all();
        $hasilNormalisasiBenefit = [];
        $hasilNormalisasiCost = [];

        // Cari Nilai Minimal dan Maximum dari sekumpulan nilai-nilai Sub-Kriteria pada setiap Kriteria
        $ValuesSub = [];
        foreach ($AlternatifItem as $item) {
            $ValuesSub[$item->kriteria_id][] = $item->sub_kriteria_id;
        }

        $MaxValue = [];
        $MinValue = [];
        foreach ($ValuesSub as $ids => $item){
            foreach($item as $id){
                $rows = SubKriteria::where('id', $id)->value('bobot_sub');
                $MaxValue[$ids][] = $rows;
            }
        }
        foreach ($ValuesSub as $ids => $item){
            foreach($item as $id){
                $rows = SubKriteria::where('id', $id)->value('bobot_sub');
                $MinValue[$ids][] = $rows;
            }
        }
        $OriginalItemBenefit = [];
        $OriginalItemCost = [];
        $OriginalItemNilai = [];

    // Foreach ini untuk memperoleh mana Data di tabel intermediasi yang atributnya Benefit dan Cost
        foreach($AlternatifItem as $ids => $item){
            foreach($kriteria as $kriteriaItem){
                $CekAttribut = $kriteriaItem->where('id', $item->kriteria_id)->value('atribut_kriteria');
                if($CekAttribut == "Benefit"){
                    $OriginalItemBenefit[$item->alternatif_id][$item->kriteria_id] = $item->sub_kriteria_id; 
                }
                else{
                    $OriginalItemCost[$item->alternatif_id][$item->kriteria_id] = $item->sub_kriteria_id; 
                }

                $OriginalItemNilai[$item->alternatif_id][$item->kriteria_id] = $item->sub_kriteria_id; 
            }
        }
        // Melakukan Normalisasi pada Sub-Kriteria Menggunakan Cara Metode SAW

        if(isset($OriginalItemBenefit)){
            $hasilNormalisasiBenefit = $this->BenefitNormalisasi($OriginalItemBenefit, $MaxValue);
        }

        if(isset($OriginalItemCost)){
            $hasilNormalisasiCost = $this->CostNormalisasi($OriginalItemCost, $MinValue);
        }

        foreach($hasilNormalisasiCost as $ids => $values){
            foreach($values as $value){
                $hasilNormalisasiBenefit[$ids] = $hasilNormalisasiBenefit[$ids] + $values;
            }
        }

        $hasilNormalisasi = $hasilNormalisasiBenefit;
        // Akhir Melakukan Normalisasi


        // Perhitungan WP Menggunakan Hasil Normalisasi SAW

        // Perbaiki Bobot Kriteria
        $fixBobotKriteria = [];
        foreach ($AlternatifItem as $item) {
            foreach($kriteria as $kriteriaItem){
                $fixBobotKriteria[$item->kriteria_id] = $kriteriaItem->where('id', $item->kriteria_id)->value('bobot');
                
            }
        }

        // Perbaiki Bobot Kriteria dan Mengubah Bobot Kriteria Tipe Cost Menjadi Negatif
        $sum = array_sum($fixBobotKriteria);
        foreach($fixBobotKriteria as $id => $item){
            $atribut_kriteria = $kriteria->where('id', $id)->value('atribut_kriteria');
            if($atribut_kriteria == 'Cost'){
                $fixBobotKriteria[$id] =  $item / $sum; 
            }else{
                $fixBobotKriteria[$id] = $item / $sum; 
            }
        }

        // Menghitung Vektor S
        $hasilPerhitunganVektorS = [];
        foreach($hasilNormalisasi as $alternatifId => $values){
            foreach($values as $kriteriaId => $value){
                $hasilPerhitunganVektorS[$alternatifId][] = $value**$fixBobotKriteria[$kriteriaId]  ;
            }            
        }

        foreach($hasilPerhitunganVektorS as $alternatifId => $values){
            $nilaiVektor = 1;
            foreach($values as $value){
                $nilaiVektor = $value * $nilaiVektor;
            }
            $hasilPerhitunganVektorS[$alternatifId] = $nilaiVektor;
        }
        
        // Menghitung Vektor V

        $sumVektorS = array_sum($hasilPerhitunganVektorS);
        $hasilPerhitunganVektorV = [];
        foreach($hasilPerhitunganVektorS as $id => $value){
            $hasilPerhitunganVektorV[$id] = $value / $sumVektorS;
        }
        // Akhir Perhitungan WP
        return $hasilPerhitunganVektorV;

        // // Perhitungan Perkalian Bobot Kriteria dan Hasil Normalisasi Nilai Sub-Kriteria Menggunakan Metode SAW
        // $ambilBobotKriteria = [];
        // $ambilIdKriteria = [];
        // foreach($hasilNormalisasi as $ids => $values){
        //     foreach($values as $id => $value){
        //         $idKriteria[] = $id;
        //     }
        //     $ambilIdKriteria = $idKriteria;
        // }

        // $ambilIdKriteria = array_unique($ambilIdKriteria);

        // $KriteriaBobotItem = [];
        // foreach($OriginalItemNilai as $ids => $Item){
        //     foreach($ambilIdKriteria as $id){
        //         $KriteriaBobotItem[$ids][$id] = $kriteria->where('id', $id)->value('bobot') / 100;
        //     }
        // }

        // $SkorAlternatif = [];
        // foreach($KriteriaBobotItem as $AlternatifIds => $values){
        //     foreach($values as $KriteriaId => $value){
        //         $SkorAlternatif[$AlternatifIds][$KriteriaId] = $value * $hasilNormalisasi[$AlternatifIds][$KriteriaId];
        //     }
        // }

        // $SumSkorAlternatif = [];
        // foreach($SkorAlternatif as $AlternatifIds => $values){
        //     $skor = 0;
        //     foreach($values as $nilai){
        //         $skor = $skor + $nilai;  
        //     }
        //     $SumSkorAlternatif[$AlternatifIds] = $skor;
        // }

        // dd($SumSkorAlternatif);


    }// End Method

    public function BenefitNormalisasi($OriginalItem, $MaxValues){
        $SubKriteriaTable = SubKriteria::all();


        foreach($OriginalItem as $ids => $values){
            foreach($values as $id => $value){
                $BobotSub = $SubKriteriaTable->where('id', $values[$id])->value('bobot_sub');
                $NormalizedValue = $BobotSub / max($MaxValues[$id]);

                $OriginalItem[$ids][$id] = $NormalizedValue;

            }
        }

        return $OriginalItem;
    }// End Method

    public function CostNormalisasi($OriginalItem, $MinValues){
        $SubKriteriaTable = SubKriteria::all();


        foreach($OriginalItem as $ids => $values){
            foreach($values as $id => $value){
                $BobotSub = $SubKriteriaTable->where('id', $values[$id])->value('bobot_sub');
                $NormalizedValue =  min($MinValues[$id]) / $BobotSub;

                $OriginalItem[$ids][$id] = $NormalizedValue;

            }
        }

        return $OriginalItem;
    }// End Method

}
