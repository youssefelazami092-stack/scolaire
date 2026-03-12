<?php

namespace App\Livewire;

use App\Models\SchoolYear;
use Livewire\Component;
use Livewire\WithPagination;

class Settings extends Component
{
    use WithPagination;

    public $search = '';

    protected $paginationTheme = 'tailwind';

    // Reset page on search update
    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function toggleStatus($id)
    {
        $schoolYear = SchoolYear::findOrFail($id);

        if ($schoolYear->active) {
            // Désactiver l'année scolaire active
            $schoolYear->active = false;
            $schoolYear->save();
        } else {
            // Désactiver toutes les autres années scolaires actives
            SchoolYear::where('active', 1)->update(['active' => 0]);

            // Activer celle sélectionnée
            $schoolYear->active = true;
            $schoolYear->save();
        }
    }

    public function render()
    {
        $query = SchoolYear::query();

        if (!empty(trim($this->search))) {
            $searchTerm = '%' . $this->search . '%';
            $query->where(function($q) use ($searchTerm) {
                $q->where('school_year', 'like', $searchTerm)
                  ->orWhere('current_Year', 'like', $searchTerm);
            });
        }

        $schoolYearList = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.settings', compact('schoolYearList'));
    }
}
