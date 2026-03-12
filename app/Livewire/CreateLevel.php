<?php

namespace App\Livewire;

use App\Models\Level;
use App\Models\SchoolYear;
use Livewire\Component;
use Exception;

class CreateLevel extends Component
{
    public $code;
    public $libelle;
    public $scolarite;

    protected $rules = [
        'code' => 'required|string|max:255|unique:levels,code',
        'libelle' => 'required|string|max:255',
        'scolarite' => 'required|integer|min:0',
    ];

    public function store()
    {
        $this->resetErrorBag(); // Nettoyer les erreurs précédentes
        $this->validate();

        $activeSchoolYear = SchoolYear::where('active', 1)->first();

        if (!$activeSchoolYear) {
            session()->flash('error', "Aucune année scolaire active trouvée.");
            return;
        }

        try {
            Level::create([
                'code' => $this->code,
                'libelle' => $this->libelle,
                'scolarite' => $this->scolarite,
                'school_year_id' => $activeSchoolYear->id,
            ]);

            session()->flash('success', 'Niveau ajouté avec succès.');
            $this->reset(['code', 'libelle', 'scolarite']);
        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de l\'ajout : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.create-level');
    }
}
