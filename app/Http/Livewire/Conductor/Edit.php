<?php

namespace App\Http\Livewire\Conductor;

use App\Models\Conductor;
use Livewire\Component;

class Edit extends Component
{
    public Conductor $conductor;

    public function mount(Conductor $conductor)
    {
        $this->conductor = $conductor;
    }

    public function render()
    {
        return view('livewire.conductor.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->conductor->save();

        return redirect()->route('admin.conductors.index');
    }

    protected function rules(): array
    {
        return [
            'conductor.name' => [
                'string',
                'min:8',
                'max:255',
                'required',
                'unique:conductors,name,' . $this->conductor->id,
            ],
        ];
    }
}
