<?php

namespace App\Livewire\Map;

use App\Models\Project;
use App\Models\ProjectFile;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class FileUploadModal extends Component
{
    use WithFileUploads;

    public $openUploadModal = false;
    public $projectId = null;
    public $projectName;

    public $file;
    public $category;

    protected $rules = [
        'file' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,jpg,jpeg,png,pptx,mp4|max:20480',
        'category' => 'required|string|max:50',
    ];


    #[On('open-upload-modal')]
    public function openUploadModal($id)
    {
        $project = Project::findOrFail($id);

        $this->projectId = $project->id;
        $this->projectName = $project->name;

        $this->openUploadModal = true;
    }

    public function uploadFile()
    {
        $this->validate();

        $path = $this->file->store('project_files/' . $this->projectName, 'public');

        ProjectFile::create([
            'project_id' => $this->projectId,
            'original_name' => $this->file->getClientOriginalName(),
            'file_path' => $path,
            'mime_type' => $this->file->getMimeType(),
            'file_size' => $this->file->getSize(),
            'category'  => $this->category,
        ]);

        $this->reset(['file', 'category']);

        $this->dispatch('showAlert', type: 'success', message: 'File uploaded successfully!');

        $this->openUploadModal = false;

        $this->dispatch('refreshFiles');
    }

    public function render()
    {
        return view('livewire.map.file-upload-modal');
    }
}
