<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubKriteria extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'kriteria_id');
    }

    public function alternatifs()
    {
        return $this->belongsToMany(Alternatif::class, 'alternatif_criteria_dan_subs', 'sub_kriteria_id', 'alternatif_id');
    }


}
