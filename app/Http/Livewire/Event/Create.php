<?php

namespace App\Http\Livewire\Event;

use App\Models\Event;
use Livewire\Component;

class Create extends Component
{
    public Event $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.event.create');
    }

    public function submit()
    {
        $this->validate();

        $this->event->save();

        return redirect()->route('admin.events.index');
    }

    protected function rules(): array
    {
        return [
            'event.name' => [
                'string',
                'min:8',
                'max:255',
                'required',
                'unique:events,name',
            ],
            'event.year_of' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
        ];
    }
}
