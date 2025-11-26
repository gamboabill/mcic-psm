<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Component;

class MapView extends Component
{
    public $projects = [];

    public string $title = 'Map View';

    public function mount()
    {
        // Load all projects with latitude & longitude
        $this->projects = Project::select('name', 'latitude', 'longitude', 'description')->where('status', '0')->get()
            ->map(function ($p) {
                return [
                    'name' => $p->name,
                    'description' => $p->description,
                    'latitude' => (float)$p->latitude,
                    'longitude' => (float)$p->longitude,
                ];
            });
    }

    public function render()
    {
        return view('livewire.map.map-view')->layout('components.standalone');
    }
}
