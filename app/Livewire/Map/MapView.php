<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Component;

class MapView extends Component
{
    public string $title = 'Map View';

    public function render()
    {
        return view('livewire.map.map-view')
            ->layout('components.standalone');
    }
}
