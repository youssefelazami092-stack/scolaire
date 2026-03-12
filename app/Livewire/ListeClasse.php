<?php

namespace App\Livewire;
use App\Models\Classe;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Database\QueryException;

class ListeClasse extends Component
{
    use WithPagination;
    public $search = '';
    protected $paginationTheme = 'tailwind'; // Pagination compatible Tailwind CSS
    
    // Réinitialise la pagination quand la recherche change
    public function updatedSearch()
    {
        $this->resetPage();
    }
    public function render()
    {
        $query = Classe::with('level');

        if (!empty($this->search)) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('libelle', 'like', $searchTerm)
                  ->orWhere('code', 'like', $searchTerm);
            });
        }
        $classesList = $query->paginate(10);
        return view('livewire.liste-classe', ['classes' => $classesList]);
    }

    public function delete($id)
    {
        try {
            $classe = Classe::findOrFail($id);

            // Si tu veux supprimer aussi les attributions liées, décommente :
            // $classe->attributions()->delete();

            $classe->delete();

            session()->flash('success', 'Classe supprimée avec succès.');
        } catch (QueryException $e) {
            // Code SQLSTATE 23000 = violation de contrainte d'intégrité (FK par exemple)
            if ($e->getCode() === '23000') {
                session()->flash('error', 'Impossible de supprimer cette classe car elle est liée à des inscriptions.');
            } else {
                // Relancer l'exception pour d'autres erreurs inattendues
                throw $e;
            }
        } catch (\Exception $e) {
            // Gestion générique d'erreur
            session()->flash('error', 'Erreur inattendue : ' . $e->getMessage());
        }
    }
}
