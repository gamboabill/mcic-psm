<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class MapViewFinished extends Component
{
    public $projects = [];

    public string $title = 'Map View';

    public array $projectsGeoJSON = [];

    public function mount()
    {
        $projects = Project::select('id', 'name', 'description', 'latitude', 'longitude')->where('status', 1)->get();

        $this->projectsGeoJSON = [
            'type' => 'FeatureCollection',
            'features' => $projects->map(function ($p) {
                return [
                    'type' => 'Feature',
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [
                            (float) $p->longitude,
                            (float) $p->latitude,
                        ],
                    ],
                    'properties' => [
                        'id' => $p->id,
                        'name' => $p->name,
                        'description' => $p->description,
                    ],
                ];
            })->values()->toArray(),
        ];
    }

    public function render()
    {
        return view('livewire.map.map-view-finished')->layout('components.standalone');
    }
}
