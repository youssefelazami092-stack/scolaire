<?php

namespace App\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Level;
use App\Models\SchoolYear;
use App\Models\Student;
use Exception;
use Livewire\Component;

class CreateInscription extends Component
{
    public $student_id;
    public $level_id;
    public $matricule;
    public $classe_id;
    public $fullname = '';
    public $classeList = [];

    // Chargement des infos de l'élève à partir du matricule
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

    // Chargement des classes selon le niveau
    public function updatedLevelId()
    {
        $this->classeList = Classe::where('level_id', $this->level_id)->get();
        $this->classe_id = null; // reset la classe si le niveau change
    }

    public function store()
    {
        $this->resetErrorBag();

        // Vérifier que l'élève existe
        $student = Student::where('matricule', $this->matricule)->first();

        if (!$student) {
            session()->flash('error', 'Aucun élève trouvé avec ce matricule.');
            return;
        }

        $this->student_id = $student->id;

        $this->validate([
            'matricule' => 'required|string',
            'level_id' => 'required|exists:levels,id',
            'classe_id' => 'required|exists:classes,id',
        ]);

        $activeSchoolYear = SchoolYear::where('active', 1)->first();

        if (!$activeSchoolYear) {
            session()->flash('error', 'Aucune année scolaire active trouvée.');
            return;
        }

        $alreadyRegistered = Attribution::where('student_id', $this->student_id)
            ->where('school_year_id', $activeSchoolYear->id)
            ->exists();

        if ($alreadyRegistered) {
            session()->flash('error', 'Cet élève est déjà inscrit pour l\'année scolaire en cours.');
            return;
        }

        try {
            Attribution::create([
                'student_id' => $this->student_id,
                'classe_id' => $this->classe_id,
                'school_year_id' => $activeSchoolYear->id,
            ]);

            session()->flash('success', 'Inscription effectuée avec succès.');

            $this->reset(['matricule', 'fullname', 'student_id', 'level_id', 'classe_id', 'classeList']);

        } catch (Exception $e) {
            session()->flash('error', 'Une erreur est survenue : ' . $e->getMessage());
        }
    }

    public function render()
    {
        $activeSchoolYear = SchoolYear::where('active', 1)->first();

        $currentLevels = $activeSchoolYear
            ? Level::where('school_year_id', $activeSchoolYear->id)->get()
            : collect();

        return view('livewire.create-inscription', [
            'currentLevels' => $currentLevels,
            'classeList' => $this->classeList,
            'activeSchoolYear' => $activeSchoolYear,
        ]);
    }
}
