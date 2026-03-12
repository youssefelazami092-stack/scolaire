<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Exception;
class CreateEleve extends Component
{
    public $matricule;
    public $nom;
    public $prenom;
    public $naissance;
    public $contact_parent;

    public function store()
    {
        $this->resetErrorBag();

        $validated = $this->validate([
            'matricule' => 'required|string|unique:students,matricule',
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'naissance' => 'required|date',
            'contact_parent' => 'required|string|max:20',
        ]);
        try {
            Student::create($validated);

            session()->flash('success', 'Élève ajouté avec succès.');

            $this->reset([
                'matricule',
                'nom',
                'prenom',
                'naissance',
                'contact_parent',
            ]);
        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de l\'ajout de l\'élève : ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.create-eleve');
    }
}
