<?php

namespace App\Http\Livewire\Program;

use App\Models\Event;
use App\Models\Program;
use Livewire\Component;

class Create extends Component
{
    public Program $program;

    public array $listsForFields = [];

    public function mount(Program $program)
    {
        $this->program = $program;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.program.create');
    }

    public function submit()
    {
        $this->validate();

        $this->program->save();

        return redirect()->route('admin.programs.index');
    }

    protected function rules(): array
    {
        return [
            'program.event_id' => [
                'integer',
                'exists:events,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['event'] = Event::pluck('name', 'id')->toArray();
    }
}
