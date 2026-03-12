<?php

namespace App\Livewire;

use App\Models\Payment;
use Livewire\Component;
use Livewire\WithPagination;

class ListePayments extends Component
{
    use WithPagination;

    public $search = '';
    public $confirmingDeleteId = null;

    protected $paginationTheme = 'tailwind';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function confirmDelete($id)
    {
        $this->confirmingDeleteId = $id;
    }

    public function cancelDelete()
    {
        $this->confirmingDeleteId = null;
    }

    public function delete()
    {
        if (!$this->confirmingDeleteId) {
            return;
        }

        $payment = Payment::find($this->confirmingDeleteId);

        if (!$payment) {
            session()->flash('error', 'Paiement introuvable.');
            $this->confirmingDeleteId = null;
            return;
        }

        try {
            $payment->delete();
            session()->flash('success', 'Paiement supprimé avec succès.');
        } catch (\Exception $e) {
            session()->flash('error', 'Erreur lors de la suppression : ' . $e->getMessage());
        }

        $this->confirmingDeleteId = null;
    }

    public function render()
    {
        $query = Payment::with(['student', 'classe']);

        if (!empty(trim($this->search))) {
            $searchTerm = '%' . $this->search . '%';
            $query->whereHas('student', function ($q) use ($searchTerm) {
                $q->where('nom', 'like', $searchTerm)
                  ->orWhere('prenom', 'like', $searchTerm)
                  ->orWhere('matricule', 'like', $searchTerm);
            });
        }

        $payments = $query->orderBy('id', 'desc')->paginate(10);

        return view('livewire.liste-payments', compact('payments'));
    }
}
