<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Payment;

class ShowStudent extends Component
{
    public $eleve;

    public function getCurrentClasse()
    {
        $query = Attribution::where('student_id', $this->eleve->id)->first();

        if (!$query) {
            return "Non attribué"; // ou return null;
        }

        $currentClasseId = $query->classe_id;
        $classeQuery = Classe::find($currentClasseId);

        return $classeQuery ? $classeQuery->libelle : "Classe introuvable";
    }

    public function render()
    {
        $studentsLastPayment = Payment::where('student_id', $this->eleve->id)->paginate(10);
        return view('livewire.show-student', compact('studentsLastPayment'));
    }
}
