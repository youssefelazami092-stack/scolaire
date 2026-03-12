<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classe extends Model
{
    // Protection contre l'assignation en masse
    protected $guarded = [];

    /**
     * Relation vers le niveau (Level) auquel appartient cette classe.
     */
    public function level()
    {
        return $this->belongsTo(Level::class);
    }

    /**
     * Relation vers les attributions (inscriptions) liées à cette classe.
     */
    public function attributions()
    {
        return $this->hasMany(Attribution::class, 'classe_id');
    }
}
