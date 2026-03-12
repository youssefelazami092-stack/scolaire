<?php

namespace App\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Level;
use App\Models\SchoolYear;
use App\Models\Student;
use Exception;
use Livewire\Component;

class EditInscription extends Component
{
    public $attribution;
    public $student_id;
    public $level_id;
    public $matricule;
    public $classe_id;
    public $fullname = '';
    public $error;

    public function mount()
    {
        $student = Student::find($this->attribution->student_id);
        if ($student) {
            $this->matricule = $student->matricule;
            $this->student_id = $student->id;
            $this->fullname = $student->nom . ' ' . $student->prenom;
        }

        $classe = Classe::find($this->attribution->classe_id);
        if ($classe) {
            $this->classe_id = $classe->id;
            $this->level_id = $classe->level_id;
        }
    }

    protected function rules()
    {
        return [
            'matricule' => 'required|string|exists:students,matricule',
            'level_id' => 'required|integer|exists:levels,id',
            'classe_id' => 'required|integer|exists:classes,id',
        ];
    }

    public function updatedMatricule()
    {
        $student = Student::where('matricule', $this->matricule)->first();

        if ($student) {
            $this->fullname = $student->nom . ' ' . $student->prenom;
            $this->student_id = $student->id;
        } else {
            $this->fullname = '';
            $this->student_id = null;
        }
    }

    public function updatedLevelId()
    {
        // Reset classe_id quand le niveau change
        $this->classe_id = null;
    }
    public function update()
    {
        $this->validate();

        $activeSchoolYear = SchoolYear::where('active', 1)->first();

        if (!$activeSchoolYear) {
            session()->flash('error', 'Aucune année scolaire active trouvée.');
            return;
        }

        // Vérifier s'il existe déjà une autre inscription pour cet élève dans l'année active (hors l'actuelle)
        $alreadyRegistered = Attribution::where('student_id', $this->student_id)
            ->where('school_year_id', $activeSchoolYear->id)
            ->where('id', '!=', $this->attribution->id)
            ->exists();

        if ($alreadyRegistered) {
            session()->flash('error', 'Cet élève est déjà inscrit pour cette année scolaire.');
            return;
        }

        try {
            $this->attribution->update([
                'student_id' => $this->student_id,
                'classe_id' => $this->classe_id,
                'school_year_id' => $activeSchoolYear->id,
            ]);

            session()->flash('success', 'Inscription modifiée avec succès.');
        } catch (Exception $e) {
            session()->flash('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function render()
    {
        $activeSchoolYear = SchoolYear::where('active', 1)->first();

        if (!$activeSchoolYear) {
            $this->error = 'Aucune année scolaire active trouvée.';
            $currentLevels = collect();
            $classeList = collect();
        } else {
            $currentLevels = Level::where('school_year_id', $activeSchoolYear->id)->get();

            $classeList = !empty($this->level_id)
                ? Classe::where('level_id', $this->level_id)->get()
                : collect();
        }
        return view('livewire.edit-inscription', compact('currentLevels', 'classeList'));
    }
}
