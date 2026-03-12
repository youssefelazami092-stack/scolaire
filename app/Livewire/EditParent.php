<?php

namespace App\Livewire;

use App\Models\StudentParent;
use Exception;
use Livewire\Component;

class EditParent extends Component
{
    public StudentParent $parent;

    public $nom;
    public $prenom;
    public $email;
    public $contact;

    public function mount(StudentParent $parent)
    {
        $this->parent = $parent;

        $this->nom = $parent->nom;
        $this->prenom = $parent->prenom;
        $this->email = $parent->email;
        $this->contact = $parent->contact;
    }

    protected function rules()
    {
        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|unique:student_parents,email,' . $this->parent->id,
            'contact' => 'nullable|string|max:20',
        ];
    }

    public function update()
    {
        $this->validate();

        try {
            $this->parent->update([
                'nom' => $this->nom,
                'prenom' => $this->prenom,
                'email' => $this->email,
                'contact' => $this->contact,
            ]);

            session()->flash('success', 'Parent mis à jour avec succès.');

            return redirect()->route('parents');
        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edit-parent');
    }
}
