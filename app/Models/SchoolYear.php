<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SchoolYear extends Model
{
    // Champs autorisés à la création ou mise à jour par assignation de masse
    protected $fillable = [
        'school_year',  // à remplacer si c'est le champ correct (au lieu de 'name')
        'start_date',
        'end_date',
        'active',
        'current_Year'  // à ajouter si tu utilises ce champ (comme dans d'autres codes)
    ];
    public function levels()
{
    return $this->hasMany(Level::class);
}
}
