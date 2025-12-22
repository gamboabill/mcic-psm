<?php

namespace App\Livewire\Map;

use App\Models\Code;
use App\Models\Project;
use App\Models\ProjectFile;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class DeleteModal extends Component
{

    public $openDeleteModal = false;
    public $name;
    public $inputCode;

    public $projectDeleteId;

    public $deletionCode;

    protected $rules = [
        'inputCode' => 'required',
    ];

    protected $messages = [
        'inputCode.required' => 'please enter deletion :attribute',
    ];

    protected $validationAttributes = [
        'inputCode' => 'code', // This will replace :attribute in error messages
    ];

    #[On('open-delete-modal')]
    public function openDeleteModal($id)
    {
        $this->openDeleteModal = true;

        $project = Project::findOrFail($id);

        $this->projectDeleteId = $project->id;

        $this->name = $project->name;
    }

    public function deleteProject()
    {
        $codes = Code::first();

        if (empty($codes)) {

            $this->dispatch('no-delete-code');

            $this->dispatch('showAlert', type: 'error', message: 'No deletion code set! Please contact the administrator.');

            $this->openDeleteModal = false;

            $this->reset();
        } else {

            $deletionCode = $codes->delete_code;

            if (! Hash::check($this->inputCode, $deletionCode)) {
                $this->addError('inputCode', 'Access Denied!');

                $this->openDeleteModal = true;
            } else {

                $project = Project::with('files')->findOrFail($this->projectDeleteId);

                foreach ($project->files as $file) {
                    if (Storage::disk('public')->exists($file->file_path)) {
                        Storage::disk('public')->delete($file->file_path);
                    }
                }

                $projectFolder = 'project_files/' . $this->name;

                if (Storage::disk('public')->exists($projectFolder)) {
                    Storage::disk('public')->deleteDirectory($projectFolder);
                }


                $project->delete();

                $this->dispatch('showAlert', type: 'success', message: 'Project: ' . $project->name . ' successfully deleted!');

                $this->reset();

                $this->openDeleteModal = false;

                $this->dispatch('refreshTable');
            }
        }
    }

    public function render()
    {
        return view('livewire.map.delete-modal');
    }
}
