<?php

namespace App\Http\Livewire\Ensemble;

use App\Models\Ensemble;
use Livewire\Component;

class Create extends Component
{
    public Ensemble $ensemble;

    public function mount(Ensemble $ensemble)
    {
        $this->ensemble = $ensemble;
    }

    public function render()
    {
        return view('livewire.ensemble.create');
    }

    public function submit()
    {
        $this->validate();

        $this->ensemble->save();

        return redirect()->route('admin.ensembles.index');
    }

    protected function rules(): array
    {
        return [
            'ensemble.name' => [
                'string',
                'min:8',
                'max:255',
                'required',
                'unique:ensembles,name',
            ],
        ];
    }
}
