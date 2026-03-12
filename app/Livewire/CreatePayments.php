<?php

namespace App\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use App\Models\Payment;
use App\Models\SchoolYear;
use App\Models\Student;
use Exception;
use Livewire\Component;

class CreatePayments extends Component
{
    public $matricule;
    public $montant;
    public $fullname;
    public $student_id;
    public $success;
    public $haveSuccess = false;
    public $error;
    public $haveError = false;

    public function updatedMatricule()
    {
        $student = Student::where('matricule', $this->matricule)->first();

        if ($student) {
            $this->fullname = $student->nom . ' ' . $student->prenom;
            $this->student_id = $student->id;
        } else {
            $this->fullname = null;
            $this->student_id = null;
        }
    }

    public function store()
    {
        $this->reset(['error', 'haveError', 'success', 'haveSuccess']);

        $this->validate([
            'matricule' => 'required|string',
            'montant'   => 'required|integer|min:1',
        ]);

        $activeSchoolYear = SchoolYear::where('active', 1)->first();
        if (!$activeSchoolYear) {
            $this->setError("Aucune année scolaire active trouvée.");
            return;
        }

        $student = Student::where('matricule', $this->matricule)->first();
        if (!$student) {
            $this->setError("Étudiant introuvable.");
            return;
        }

        $this->fullname = $student->nom . ' ' . $student->prenom;
        $this->student_id = $student->id;

        $attribution = Attribution::where('student_id', $student->id)
            ->where('school_year_id', $activeSchoolYear->id)
            ->first();

        if (!$attribution) {
            $this->setError("Aucune attribution trouvée pour cet étudiant.");
            return;
        }

        $classe = Classe::with('level')->find($attribution->classe_id);
        if (!$classe || !$classe->level) {
            $this->setError("Classe ou niveau introuvable.");
            return;
        }

        $montantScolarite = (int) $classe->level->scolarite;

        $totalPaid = Payment::where('student_id', $student->id)
            ->where('school_year_id', $activeSchoolYear->id)
            ->sum('montant');

        $reste = $montantScolarite - $totalPaid;

        if ($reste <= 0) {
            $this->setSuccess("Félicitations ! La scolarité est déjà réglée.");
            return;
        }

        if ($this->montant > $reste) {
            $this->setError("Attention ! Il reste à payer $reste MAD.");
            return;
        }

        try {
            $payment = new Payment();
            $payment->student_id = $student->id;
            $payment->classe_id = $classe->id;
            $payment->school_year_id = $activeSchoolYear->id;
            $payment->montant = $this->montant;

            $payment->save();

            $this->setSuccess("Paiement effectué avec succès.");
            $this->reset(['montant']);
        } catch (Exception $e) {
            $this->setError("Erreur lors de l'enregistrement : " . $e->getMessage());
        }
    }

    public function setError($message)
    {
        $this->error = $message;
        $this->haveError = true;
    }

    public function setSuccess($message)
    {
        $this->success = $message;
        $this->haveSuccess = true;
    }

    public function render()
    {
        return view('livewire.create-payments');
    }
}
