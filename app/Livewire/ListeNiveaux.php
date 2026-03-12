<?php

namespace App\Livewire;

use App\Models\Level;
use App\Models\SchoolFees;
use App\Models\SchoolYear;
use Illuminate\Pagination\LengthAwarePaginator;
use Livewire\Component;
use Livewire\WithPagination;

class ListeNiveaux extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDeleteId = null;

    protected $paginationTheme = 'tailwind';

    // Réinitialise la pagination à la page 1 quand la recherche change
    public function updatingSearch()
    {
        $this->resetPage();
    }

    // Stocke l'ID du niveau à supprimer pour confirmation
    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    // Supprime le niveau après confirmation, avec vérification des relations
    public function delete()
    {
        if (!$this->confirmingDeleteId) {
            return;
        }

        $level = Level::find($this->confirmingDeleteId);

        if (!$level) {
            session()->flash('error', 'Niveau introuvable.');
            $this->confirmingDeleteId = null;
            return;
        }
        
        if ($level->classes()->exists()) {
            session()->flash('error', 'Impossible de supprimer ce niveau car des classes y sont associées.');
            $this->confirmingDeleteId = null;
            return;
        }
        try {
            $level->delete();
            session()->flash('success', 'Niveau supprimé avec succès.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression du niveau : ' . $e->getMessage());
        }
        $this->confirmingDeleteId = null;
    }
    public function getScolatitieAmount($levelId)
{
    $activeSchoolYear = SchoolYear::where('active', 1)->first();

    if (!$activeSchoolYear) {
        return 0;  // ou null, ou un message, selon ce que tu veux afficher
    }
    $schoolFee = SchoolFees::where('level_id', $levelId)
                ->where('school_year_id', $activeSchoolYear->id)
                ->first();
    if (!$schoolFee) {
        return 0;  // Pas de montant trouvé, renvoyer 0 ou autre valeur par défaut
    }
    return $schoolFee->montant;
}
    public function render()
    {
        $activeSchoolYear = SchoolYear::where('active', 1)->first();
        if (!$activeSchoolYear) {
            $levels = new LengthAwarePaginator([], 0, 10, 1);
        } else {
            $query = Level::where('school_year_id', $activeSchoolYear->id);
            if (!empty(trim($this->search))) {
                $searchTerm = '%' . $this->search . '%';
                $query->where(function ($q) use ($searchTerm) {
                    $q->where('libelle', 'like', $searchTerm)
                      ->orWhere('code', 'like', $searchTerm);
                });
            }
            $levels = $query->paginate(10);
        }
        return view('livewire.liste-niveaux', compact('levels'));
    }
}
