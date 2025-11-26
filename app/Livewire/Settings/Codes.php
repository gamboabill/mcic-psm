<?php

namespace App\Livewire\Settings;

use App\Models\Code;
use Livewire\Component;

class Codes extends Component
{
    public $code;

    public function saveCode()
    {
        $this->validate([
            'code' => 'required|max:255',
        ]);

        Code::create([
            'delete_code' => $this->code,
        ]);

        session()->flash('success', 'Code successfully registered');

        $this->reset();
    }

    public function removeCode() {}

    public function render()
    {
        $id = Code::first()->value('id');

        $codeCounts = Code::all();

        $count = $codeCounts->count();

        return view('livewire.settings.code', [
            'count' => $count,
            'id' => $id,
        ]);
    }
}
