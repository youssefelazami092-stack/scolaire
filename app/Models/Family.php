<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Family extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'parents';

    protected $fillable = ['nom', 'prenom', 'email', 'contact'];
    public function students(){
        return $this->belongsTo(Student::class);
    }
}
