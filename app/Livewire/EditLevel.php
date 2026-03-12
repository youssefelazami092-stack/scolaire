<?php

namespace App\Livewire;

use App\Models\Level;
use Exception;
use Livewire\Component;

class EditLevel extends Component
{
    public Level $level;
    public $code;
    public $libelle;
    public $scolarite;

    protected function rules()
    {
        return [
            'code' => 'required|string|max:255',
            'libelle' => 'required|string|max:255',
            'scolarite' => 'required|integer|min:0',
        ];
    }

    public function mount(Level $level)
    {
        $this->level = $level;
        $this->code = $level->code;
        $this->libelle = $level->libelle;
        $this->scolarite = $level->scolarite;
    }

    public function update()
    {
        $this->validate();

        try {
            $this->level->update([
                'code' => $this->code,
                'libelle' => $this->libelle,
                'scolarite' => $this->scolarite,
            ]);

            return redirect()->route('niveaux')->with('success', 'Niveau mis à jour avec succès.');
        } catch (Exception $e) {
            session()->flash('error', 'Erreur lors de la mise à jour : ' . $e->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.edit-level');
    }
}
