<?php

namespace App\Livewire\Map;

use App\Models\Project;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public string $title = 'Projects';

    #[On('add-success')]
    public function addFlashMessage()
    {
        session()->flash('success', 'Project successfully added!');
    }

    #[On('finish-success')]
    public function finishFlashMessage()
    {
        session()->flash('success', 'Project successfully finished!');
    }

    public function openAddModal()
    {
        $this->dispatch('open-add-modal');
    }

    public function openFinishModal($id)
    {
        $this->dispatch('open-finish-modal', id: $id);
    }

    public function render()
    {
        $projects = Project::orderBy('id', 'desc')->where('status', '0')->paginate(10);

        return view('livewire.map.index', [
            'projects' => $projects,
            'title' => $this->title,
        ]);
    }
}
