<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolFees extends Model
{
    use HasFactory;

    // Correction : tableau vide pour autoriser l'assignation de masse sur tous les champs
    protected $guarded = [];

    /**
     * Relation vers l'année scolaire associée (school_year_id).
     */
    public function schoolyear()
    {
        return $this->belongsTo(SchoolYear::class, 'school_year_id');
    }

    /**
     * Relation vers le niveau associé (level_id).
     */
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id');
    }
}
