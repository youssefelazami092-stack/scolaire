<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Level extends Model
{
    // Attributs assignables en masse
    protected $fillable = [
        'code',
        'libelle',
        'scolarite',
        'school_year_id',
    ];

    /**
     * Relation vers l'année scolaire associée à ce niveau.
     */
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }
    public function classes()
    {
        return $this->hasMany(Classe::class);
    }
    public function schoolFees(){
        return $this->hasMany(SchoolFees::class);
    }

}
