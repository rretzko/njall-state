<?php

namespace App\Http\Livewire\Participant;

use App\Models\Instrumentation;
use App\Models\Participant;
use App\Models\School;
use Livewire\Component;

class Create extends Component
{
    public Participant $participant;

    public array $listsForFields = [];

    public function mount(Participant $participant)
    {
        $this->participant = $participant;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.participant.create');
    }

    public function submit()
    {
        $this->validate();

        $this->participant->save();

        return redirect()->route('admin.participants.index');
    }

    protected function rules(): array
    {
        return [
            'participant.first' => [
                'string',
                'min:1',
                'max:255',
                'required',
            ],
            'participant.last' => [
                'string',
                'min:2',
                'max:255',
                'required',
            ],
            'participant.instrumentation_id' => [
                'integer',
                'exists:instrumentations,id',
                'required',
            ],
            'participant.school_id' => [
                'integer',
                'exists:schools,id',
                'required',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['instrumentation'] = Instrumentation::pluck('descr', 'id')->toArray();
        $this->listsForFields['school']          = School::pluck('name', 'id')->toArray();
    }
}
