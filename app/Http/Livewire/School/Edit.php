<?php

namespace App\Http\Livewire\School;

use App\Models\School;
use Livewire\Component;

class Edit extends Component
{
    public School $school;

    public function mount(School $school)
    {
        $this->school = $school;
    }

    public function render()
    {
        return view('livewire.school.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->school->save();

        return redirect()->route('admin.schools.index');
    }

    protected function rules(): array
    {
        return [
            'school.name' => [
                'string',
                'min:8',
                'max:255',
                'required',
                'unique:schools,name,' . $this->school->id,
            ],
            'school.city' => [
                'string',
                'min:2',
                'max:255',
                'nullable',
            ],
            'school.postal_code' => [
                'string',
                'min:5',
                'max:10',
                'nullable',
            ],
        ];
    }
}
