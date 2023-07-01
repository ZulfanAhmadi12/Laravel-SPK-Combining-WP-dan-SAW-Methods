@extends('admin.admin_master')
@section('admin')
@php 


    // The code assign to the $subKriterias will take the subKriterias() eloquent function result from $kriteria. then you can directly access the value of subKriterias like this dd($subKriterias[0]->nama_subkriteria);
    // With this i don't have to query two times by calling the instance using just latest()->get() then calling the relation using eloquent function in models. 
    // i can just call it once from database all of it, then manipulate it using PHP function pluck() and flatten()
    // $kriteria = $alternatifKriteria->pluck('kriterias')->flatten();
    // $subKriteria = $alternatifSubKriteria->pluck('subKriterias')->flatten();
    $uniqueAlternatifIds = collect($alternatifCriteriaSubs)->pluck('alternatif_id')->unique();
    $uniqueKriteriaIds = collect($alternatifCriteriaSubs)->pluck('kriteria_id')->unique();

    $alternatif = [];

    foreach ($uniqueAlternatifIds as $id) {
        $alternatif[] = App\Models\Alternatif::find($id);
    }

    $kriteria = [];
    $subKriteria = [];
    
    foreach ($alternatifCriteriaSubs as $row) {
    $test[] = $row->sub_kriteria_id;
    $kriteria[] = App\Models\Kriteria::find($row->kriteria_id);
    $subKriteria[] = App\Models\SubKriteria::find($row->sub_kriteria_id);
    }

@endphp

<div class="page-content">
<div class="container-fluid">

    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0">Tabel Nilai Alternatif</h4>

            </div>
        </div>
    </div>
    <!-- end page title -->
    
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <h4 class="card-title">Data Nilai Alternatif</h4>
                    <br><p class="card-title-desc">Ini adalah tabel data yang berisikan Kriteria-Kriteria. 
                        Kriteria tersebut merupakan kondisi atau penentu yang dapat mempengaruhi hasil keputusan
                        dari Sistem Pendukung Keputusan.
                    </p>
                    <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                        <tr>
                            <th style="width: 120px;">Nomor</th>
                            <th>Nama Alternatif</th>
                            <th>Nama Kriteria</th>
                            <th>Nama Sub-Kriteria</th>
                            <th style="width: 200px;">Aksi</th>
                        </tr>
                        </thead>

                        @if(count($alternatifCriteriaSubs) > 0)
                        <tbody>
                            @php($num = 1)
                            @php($iSub = 0)
                            @foreach($alternatif as $item)
                            @for ($i = 0; $i < count($uniqueKriteriaIds); $i++)
                            <tr>
                                @if($i === 0)
                                    <td rowspan="{{ count($uniqueKriteriaIds) }}">{{ $num++ }}</td>
                                    <td rowspan="{{ count($uniqueKriteriaIds) }}">
                                        @if ($item->nama_alternatif)
                                            {{ $item->nama_alternatif }}
                                        @endif
                                    </td>
                                @endif
                                <td>{{ $kriteria[$i]->nama_kriteria }}</td>
                                <td>{{ $subKriteria[$iSub]->nama_subkriteria }}</td>
                                @php($iSub++)
                                @if($i === 0)
                                    <td rowspan="{{ count($uniqueKriteriaIds) }}">
                                        <a href="{{ route('hapus.alternatifkriteria', $item->id) }}" class="btn btn-danger sm" title="Delete Data" id="delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>
                                    </td>
                                @endif
                            </tr>
                            @endfor
                            @endforeach
                        </tbody>
                        @endif
                    </table>

                </div>          
            </div>
        </div> <!-- end col -->
    </div> <!-- end row -->
    <div class="container">
        <div class="row">
          <div class="d-flex">
            <a href="{{ route('hitungskor.alternatif') }}" class="btn-lg btn-primary align-items-center py-2"><span class="mb-5">Hitung Skor Alternatif</span></a>
          </div>
        </div>
      </div>
    
</div> <!-- container-fluid -->
</div>

@endsection