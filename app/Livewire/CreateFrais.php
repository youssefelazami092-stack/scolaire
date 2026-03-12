<?php

namespace App\Livewire;

use App\Models\Level;
use App\Models\SchoolFees;
use App\Models\SchoolYear;
use Exception;
use Livewire\Component;

class CreateFrais extends Component
{
    public $amount;
    public $level_id;
    public $error;

    public function store()
    {
        $this->resetErrorBag();
        $this->error = null;

        $activeSchoolYear = SchoolYear::where('active', 1)->first();
        if (!$activeSchoolYear) {
            $this->error = 'Aucune année scolaire active trouvée.';
            return;
        }
        $this->validate([
            'amount' => 'required|integer|min:0',
            'level_id' => 'required|exists:levels,id',
        ]);
        // Vérifie l’existence de frais pour ce niveau et cette année
        $exists = SchoolFees::where('level_id', $this->level_id)
            ->where('school_year_id', $activeSchoolYear->id)
            ->exists();
        if ($exists) {
            $this->error = 'Ce niveau a déjà une scolarité. Veuillez la modifier !';
            return;
        }
        try {
            SchoolFees::create([
                'level_id' => $this->level_id,
                'school_year_id' => $activeSchoolYear->id,
                'montant' => $this->amount,
            ]);
            session()->flash('success', 'Frais de scolarité ajouté avec succès.');
            return redirect()->route('fees');
        } catch (Exception $e) {
            $this->error = 'Une erreur est survenue lors de l\'enregistrement.';
        }
    }
    public function render()
    {
        $activeSchoolYear = SchoolYear::where('active', 1)->first();
        $currentLevels = $activeSchoolYear
            ? Level::where('school_year_id', $activeSchoolYear->id)->get()
            : collect();
        return view('livewire.create-frais', compact('currentLevels'));
    }
}
