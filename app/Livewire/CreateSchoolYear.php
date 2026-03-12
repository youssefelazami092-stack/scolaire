<?php

namespace App\Livewire;

use App\Models\SchoolYear;
use Carbon\Carbon;
use Exception;
use Livewire\Component;

class CreateSchoolYear extends Component
{
    public $libelle;
    protected $rules = [
        'libelle' => 'required|string|unique:school_years,school_year',
    ];
    public function store()
    {
        $this->validate();
        try {
            $currentYear = Carbon::now()->format('Y');

            // Vérifier si une année scolaire est déjà enregistrée pour l'année courante
            $exists = SchoolYear::where('current_Year', $currentYear)->exists();

            if ($exists) {
                session()->flash('error', "Une année scolaire avec l'année courante ($currentYear) existe déjà.");
                return;
            }
            // Création de l'année scolaire
            SchoolYear::create([
                'school_year'   => $this->libelle,
                'current_Year'  => $currentYear,
                'active'        => 0, // optionnel selon ta structure
            ]);

            $this->reset('libelle');
            session()->flash('success', 'Année scolaire ajoutée avec succès.');

        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.create-school-year');
    }
}
