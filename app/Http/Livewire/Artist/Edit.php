<?php

namespace App\Http\Livewire\Artist;

use App\Models\Artist;
use App\Models\Artisttype;
use Livewire\Component;

class Edit extends Component
{
    public Artist $artist;

    public array $artisttype = [];

    public array $listsForFields = [];

    public function mount(Artist $artist)
    {
        $this->artist     = $artist;
        $this->artisttype = $this->artist->artisttype()->pluck('id')->toArray();
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.artist.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->artist->save();
        $this->artist->artisttype()->sync($this->artisttype);

        return redirect()->route('admin.artists.index');
    }

    protected function rules(): array
    {
        return [
            'artist.name' => [
                'string',
                'min:2',
                'max:255',
                'required',
                'unique:artists,name,' . $this->artist->id,
            ],
            'artisttype' => [
                'array',
            ],
            'artisttype.*.id' => [
                'integer',
                'exists:artisttypes,id',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['artisttype'] = Artisttype::pluck('descr', 'id')->toArray();
    }
}
