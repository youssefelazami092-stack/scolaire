<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Attribution;
use App\Models\SchoolYear;

class Student extends Model
{
    protected $fillable = [
        'matricule',
        'nom',
        'prenom',
        'naissance',
        'contact_parent',
        'school_year_id',
    ];

    // Relation avec l'année scolaire (optionnel)
    public function schoolYear()
    {
        return $this->belongsTo(SchoolYear::class);
    }

    // Relation avec les attributions (une inscription)
    public function attributions()
    {
        return $this->hasMany(Attribution::class);
    }
    public function parent(){
        return $this->belongsTo(Family::class);
    }
}
