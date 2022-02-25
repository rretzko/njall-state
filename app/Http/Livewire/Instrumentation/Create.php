<?php

namespace App\Http\Livewire\Instrumentation;

use App\Models\Instrumentation;
use Livewire\Component;

class Create extends Component
{
    public Instrumentation $instrumentation;

    public function mount(Instrumentation $instrumentation)
    {
        $this->instrumentation = $instrumentation;
    }

    public function render()
    {
        return view('livewire.instrumentation.create');
    }

    public function submit()
    {
        $this->validate();

        $this->instrumentation->save();

        return redirect()->route('admin.instrumentations.index');
    }

    protected function rules(): array
    {
        return [
            'instrumentation.descr' => [
                'string',
                'min:2',
                'max:255',
                'required',
            ],
            'instrumentation.abbr' => [
                'string',
                'min:1',
                'max:16',
                'required',
            ],
        ];
    }
}
