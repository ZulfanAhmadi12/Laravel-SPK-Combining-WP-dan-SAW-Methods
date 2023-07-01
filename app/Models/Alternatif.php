<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function subKriteria()
    {
        return $this->hasMany(SubKriteria::class);
    }

    public function kriterias()
    {
        return $this->belongsToMany(Kriteria::class, 'alternatif_criteria_dan_subs', 'alternatif_id', 'kriteria_id');
    }

    public function subKriterias()
    {
        return $this->belongsToMany(SubKriteria::class, 'alternatif_criteria_dan_subs', 'alternatif_id', 'sub_kriteria_id');
    }
}
