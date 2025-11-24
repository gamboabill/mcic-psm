<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;

class AddModal extends Component
{
    public $openAddModal = false;

    public $name;
    public $description;
    public $latitude;
    public $longitude;

    protected $rules = [
        'name' => 'required|unique:projects,name',
    ];

    protected $messages = [
        'name.unique' => 'The :attribute has already been taken.',
    ];

    protected $validationAttributes = [
        'name' => 'id', // This will replace :attribute in error messages
    ];

    #[On('open-add-modal')]
    public function openAddModal()
    {
        $this->openAddModal = true;
    }

    public function saveProject()
    {
        $data = $this->validate([
            'name' => 'required|max:255|string|unique:projects,name',
            'description' => 'nullable|string|max:1000',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);

        Project::create($data);

        $this->dispatch('add-success');

        $this->reset();

        $this->openAddModal = false;
    }

    public function render()
    {
        return view('livewire.map.add-modal');
    }
}
