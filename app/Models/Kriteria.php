<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subKriterias()
    {
        return $this->hasMany(SubKriteria::class);
    }
    public function alternatifs()
    {
        return $this->belongsToMany(Alternatif::class, 'alternatif_criteria_dan_subs', 'kriteria_id', 'alternatif_id');
    }

}
