<?php
namespace App\Http\Livewire;
use Livewire\Component;
use App\Models\User;
use App\Models\Inscription;
use App\Models\Payment;

class DashboardStats extends Component
{
    public $usersCount;
    public $inscriptionsCount;
    public $paymentsSum;

    public function mount()
    {
        $this->usersCount = User::count();
        $this->inscriptionsCount = Inscription::whereMonth('created_at', now()->month)->count();
        $this->paymentsSum = Payment::sum('amount');
    }

    public function render()
    {
        return view('livewire.dashboard-stats');
    }
}
