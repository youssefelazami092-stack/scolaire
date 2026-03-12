<?php

namespace App\Livewire;

use App\Models\Student;
use Exception;
use Livewire\Component;

class EditEleve extends Component
{
    public $eleve;
    public $matricule;
    public $nom;
    public $prenom;
    public $naissance;
    public $contact_parent;
    public function mount(Student $eleve)
    {
        $this->eleve = $eleve;
        $this->matricule = $eleve->matricule;
        $this->nom = $eleve->nom;
        $this->prenom = $eleve->prenom;
        $this->naissance = $eleve->naissance;
        $this->contact_parent = $eleve->contact_parent;
    }
    protected function rules()
    {
        return [
            'matricule' => 'required|string|max:50',
            'nom' => 'required|string|max:100',
            'prenom' => 'required|string|max:100',
            'naissance' => 'required|date',
            'contact_parent' => 'nullable|string|max:20',
        ];
    }
    public function update()
    {
        $this->validate();
        try {
            $student = Student::findOrFail($this->eleve->id);

            $student->update([
                'matricule' => $this->matricule,
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'naissance' => $this->naissance,
                'contact_parent' => $this->contact_parent,
            ]);
            return redirect()->route('students')->with('success', 'Informations de l\'élève mises à jour avec succès.');
        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.edit-eleve');
    }
}
