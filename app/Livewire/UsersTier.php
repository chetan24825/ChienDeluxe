<?php

namespace App\Livewire;

use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithoutUrlPagination;

class UsersTier extends Component
{
    use WithPagination,WithoutUrlPagination;

    protected $paginationTheme = 'bootstrap';
    public $levels;
    public $byTier = null;
    protected $listeners = ['tierChanged'];
    public $referrals;
    
    public function mount()
    {
        $this->referrals = []; // or initialize with your data
    }
    
    public function render()
    {
        $referralLevels = getReferralLevels(Auth::user()->id);
        $level = $this->byTier;
        if($this->byTier && $this->byTier !=''){
            $referralLevels = $referralLevels->filter(function ($referralLevel) use ($level) {
                return $referralLevel['level'] == $level;
            });
        }
        $referralLevelsPaginated = paginate($referralLevels, 40);
        $this->levels = Level::all();
        return view('livewire.users-tier',['referralLevels'=>$referralLevelsPaginated,'byLevel'=>$this->byTier]);
    }

    public function tierChanged($value)
    {
        $this->resetPage();
    }
}
