<?php

namespace App\Livewire;

use App\Models\Classe;
use App\Models\Level;
use App\Models\SchoolYear;
use Exception;
use Livewire\Component;

class EditClasse extends Component
{
    public $classe;
    public $libelle;
    public $level_id;

    public function mount()
    {
        $this->libelle = $this->classe->libelle;
        $this->level_id = $this->classe->level_id;
    }

    protected function rules()
    {
        return [
            'libelle' => 'required|string|max:255',
            'level_id' => 'required|integer|exists:levels,id',
        ];
    }

    public function update()
    {
        $this->validate();

        try {
            $classe = Classe::findOrFail($this->classe->id); // sécurise l'accès
            $classe->update([
                'libelle' => $this->libelle,
                'level_id' => $this->level_id,
            ]);

            session()->flash('success', 'La classe a été mise à jour avec succès.');
            return redirect()->route('classes');
        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function render()
    {
        $activeSchoolYear = SchoolYear::where('active', 1)->first();

        $currentLevels = $activeSchoolYear
            ? Level::where('school_year_id', $activeSchoolYear->id)->get()
            : collect(); // collection vide si pas d’année active

        return view('livewire.edit-classe', compact('currentLevels'));
    }
}
