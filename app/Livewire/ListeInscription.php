<?php

namespace App\Livewire;

use App\Models\Attribution;
use App\Models\Classe;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class ListeInscription extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDeleteId = null;
    public $selected_classe_id = null;

    protected $paginationTheme = 'tailwind';

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
            session()->flash('error', 'Aucune inscription sélectionnée pour suppression.');
            return;
        }

        try {
            $attribution = Attribution::findOrFail($this->confirmingDeleteId);
            $attribution->delete();

            session()->flash('success', 'Inscription supprimée avec succès.');
        } catch (QueryException $e) {
            // Par ex. contrainte FK
            if ($e->getCode() === '23000') {
                session()->flash('error', 'Impossible de supprimer cette inscription car elle est liée à d’autres données.');
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
        $classeList = Classe::all();

        $inscriptionList = Attribution::with('student', 'classe')
            ->when($this->search, function ($query) {
                $searchTerm = '%' . $this->search . '%';
                $query->whereHas('student', function ($q) use ($searchTerm) {
                    $q->where('nom', 'like', $searchTerm)
                      ->orWhere('prenom', 'like', $searchTerm);
                });
            })
            ->when($this->selected_classe_id, function ($query) {
                $query->where('classe_id', $this->selected_classe_id);
            })
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('livewire.liste-inscription', [
            'inscriptionList' => $inscriptionList,
            'classeList' => $classeList,
        ]);
    }
}
