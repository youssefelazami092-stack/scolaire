<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Family;

class ListeParent extends Component
{
    use WithPagination;

    public $confirmingDeleteId = null;
    public $search = '';

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
        $parent = Family::find($this->confirmingDeleteId);
        if (!$parent) {
            session()->flash('error', 'Parent introuvable.');
            $this->confirmingDeleteId = null;
            return;
        }
        try {
            $parent->delete();
            session()->flash('success', 'Parent supprimé avec succès.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }
        $this->confirmingDeleteId = null;
    }
    public function render()
    {
        $query = Family::query();
        if (!empty(trim($this->search))) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('nom', 'like', $searchTerm)
                  ->orWhere('prenom', 'like', $searchTerm)
                  ->orWhere('email', 'like', $searchTerm)
                  ->orWhere('contact', 'like', $searchTerm);
            });
        }
        $parents = $query->latest()->paginate(10);
        return view('livewire.liste-parent', compact('parents'));
    }
}
