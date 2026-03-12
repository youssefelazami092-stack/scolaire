<?php

namespace App\Livewire;

use App\Models\SchoolFees;
use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Database\QueryException;

class ListeFrais extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDeleteId = null;

    protected $paginationTheme = 'tailwind';

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function delete()
    {
        if (!$this->confirmingDeleteId) {
            session()->flash('error', 'Aucune scolarité sélectionnée pour suppression.');
            return;
        }

        try {
            $fee = SchoolFees::findOrFail($this->confirmingDeleteId);
            $fee->delete();

            session()->flash('success', 'Scolarité supprimée avec succès.');
        } catch (QueryException $e) {
            if ($e->getCode() === '23000') {
                session()->flash('error', 'Impossible de supprimer cette scolarité car elle est liée à d’autres données.');
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
        $activeSchoolYear = SchoolYear::where('active', 1)->first();

        if (!$activeSchoolYear) {
            // Création d'un paginator vide avec 0 total, 10 par page, page 1
            $fees = new LengthAwarePaginator([], 0, 10, 1);
        } else {
            $query = SchoolFees::with('level', 'schoolyear')
                ->where('school_year_id', $activeSchoolYear->id);

            // Optionnel : ajouter une recherche sur level.libelle si tu veux filtrer
            if (!empty($this->search)) {
                $searchTerm = '%' . $this->search . '%';
                $query->whereHas('level', function ($q) use ($searchTerm) {
                    $q->where('libelle', 'like', $searchTerm);
                });
            }

            $fees = $query->paginate(10);
        }

        return view('livewire.liste-frais', compact('fees'));
    }
}
