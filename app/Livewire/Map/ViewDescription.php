<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class ViewDescription extends Component
{
    public $descriptionId = null;
    public $description;
    public $name;

    public $open = false;

    #[On('open-description-modal')]
    public function openDescriptionModal($id)
    {

        $project = Project::findOrFail($id);

        if ($project) {
            $this->descriptionId = $project->id;

            $this->description = $project->description;
            $this->name = $project->name;
            $this->open = true;
        }
    }

    public function render()
    {
        return view('livewire.map.view-description');
    }
}
