<?php

namespace App\Livewire;

use App\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class ListeEleve extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDeleteId = null;

    protected $paginationTheme = 'tailwind';

    // Réinitialise la pagination lors de la mise à jour de la recherche
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        if (!$this->confirmingDeleteId) {
            session()->flash('error', 'Aucun élève sélectionné pour suppression.');
            return;
        }

        try {
            $student = Student::findOrFail($this->confirmingDeleteId);

            // Supprimer les attributions liées d'abord
            $student->attributions()->delete();

            // Puis supprimer l'étudiant
            $student->delete();

            session()->flash('success', 'Élève supprimé avec succès.');
        } catch (QueryException $e) {
            // Gestion d'erreurs liées aux contraintes en base de données
            if ($e->getCode() === '23000') {
                session()->flash('error', 'Impossible de supprimer cet élève, il est lié à d’autres données.');
            } else {
                session()->flash('error', 'Erreur lors de la suppression : ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur inattendue : ' . $e->getMessage());
        }

        $this->confirmingDeleteId = null;
    }

    public function render()
    {
        $query = Student::query();

        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nom', 'like', $searchTerm)
                  ->orWhere('prenom', 'like', $searchTerm)
                  ->orWhere('matricule', 'like', $searchTerm);
            });
        }

        $students = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.liste-eleve', compact('students'));
    }
}
