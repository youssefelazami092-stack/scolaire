<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attribution extends Model
{
    // Autoriser tous les champs à l'assignation de masse (attention à la sécurité)
    protected $guarded = [];

    /**
     * Relation vers la classe associée à cette attribution.
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    /**
     * Relation vers l'élève (student) associé à cette attribution.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
