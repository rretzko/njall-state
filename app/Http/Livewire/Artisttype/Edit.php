<?php

namespace App\Http\Livewire\Artisttype;

use App\Models\Artisttype;
use Livewire\Component;

class Edit extends Component
{
    public Artisttype $artisttype;

    public function mount(Artisttype $artisttype)
    {
        $this->artisttype = $artisttype;
    }

    public function render()
    {
        return view('livewire.artisttype.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->artisttype->save();

        return redirect()->route('admin.artisttypes.index');
    }

    protected function rules(): array
    {
        return [
            'artisttype.descr' => [
                'string',
                'min:2',
                'max:255',
                'required',
                'unique:artisttypes,descr,' . $this->artisttype->id,
            ],
        ];
    }
}
