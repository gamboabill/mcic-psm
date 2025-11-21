<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;



    public function render()
    {
        $projects = Project::orderBy('id', 'desc')->paginate(10);

        return view('livewire.map.index', [
            'projects' => $projects,
        ]);
    }
}
