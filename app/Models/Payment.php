<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    // Protection contre l'assignation de masse (ici, aucun champ non assignable)
    protected $guarded = []; // Attention, un tableau vide signifie que tous les champs sont assignables

    /**
     * Relation vers la classe associée à ce paiement.
     */
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }

    /**
     * Relation vers l'étudiant associé à ce paiement.
     */
    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
