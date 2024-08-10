<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Color;

class ComponentFilter extends Component
{
    use WithPagination;

    public $perPage = 5;

    public function loadMore()
    {
        $this->perPage += 5;
    }
    public function render()
    {
        return view('livewire.component-filter', [
            'colors' => Color::paginate($this->perPage),

        ]);
    }
}
