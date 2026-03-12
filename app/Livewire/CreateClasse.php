<?php

namespace App\Livewire;

use App\Models\Classe;
use App\Models\Level;
use App\Models\SchoolYear;
use Livewire\Component;
use Exception;

class CreateClasse extends Component
{
    public $libelle;
    public $level_id;

    public function store()
    {
        $this->resetErrorBag();

        $validated = $this->validate([
            'libelle' => 'required|string|max:255',
            'level_id' => 'required|exists:levels,id',
        ]);

        try {
            Classe::create($validated);
            session()->flash('success', 'Classe ajoutée avec succès.');
            return redirect()->route('classes');
        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de la création de la classe : ' . $e->getMessage());
        }
    }
    public function render()
    {
        $activeSchoolYear = SchoolYear::where('active', 1)->first();
        $currentLevels = collect();

        if ($activeSchoolYear) {
            $currentLevels = Level::where('school_year_id', $activeSchoolYear->id)->get();
        } else {
            session()->flash('error', 'Aucune année scolaire active trouvée.');
        }
        return view('livewire.create-classe', [
            'currentLevels' => $currentLevels,
        ]);
    }
}
