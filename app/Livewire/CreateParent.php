<?php

namespace App\Livewire;

use App\Models\Family;
use App\Notifications\SendParentRegistrationNotification;
use Livewire\Component;
use Exception;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CreateParent extends Component
{
    use AuthorizesRequests; // optionnel selon besoin

    public $email;
    public $nom;
    public $prenom;
    public $contact;

    protected $rules = [
        'email' => 'required|email|unique:parents,email',
        'nom' => 'required|string|max:255',
        'prenom' => 'required|string|max:255',
        'contact' => 'required|string|max:20',
    ];
    public function store()
    {
        $this->resetErrorBag();

        $this->validate();

        try {
            $parent = Family::create([
                'nom'     => $this->nom,
                'prenom'  => $this->prenom,
                'email'   => $this->email,
                'contact' => $this->contact,
            ]);

            if ($parent) {
                $parent->notify(new SendParentRegistrationNotification());
            }
            session()->flash('success', 'Parent ajouté avec succès.');

            // Reset des champs pour un nouveau formulaire vide
            $this->reset(['nom', 'prenom', 'email', 'contact']);

            // Optionnel : rediriger vers la liste des parents
            // return redirect()->route('parents.index');

        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.create-parent');
    }
}
