<?php

namespace App\Http\Livewire\Composition;

use App\Models\Composition;
use Livewire\Component;

class Create extends Component
{
    public Composition $composition;

    public function mount(Composition $composition)
    {
        $this->composition = $composition;
    }

    public function render()
    {
        return view('livewire.composition.create');
    }

    public function submit()
    {
        $this->validate();

        $this->composition->save();

        return redirect()->route('admin.compositions.index');
    }

    protected function rules(): array
    {
        return [
            'composition.title' => [
                'string',
                'min:2',
                'max:255',
                'required',
            ],
            'composition.subtitle' => [
                'string',
                'min:2',
                'max:255',
                'nullable',
            ],
        ];
    }
}
