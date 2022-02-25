<?php

namespace App\Http\Livewire\Artist;

use App\Models\Artist;
use App\Models\Artisttype;
use Livewire\Component;

class Create extends Component
{
    public Artist $artist;

    public array $artisttype = [];

    public array $listsForFields = [];

    public function mount(Artist $artist)
    {
        $this->artist = $artist;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.artist.create');
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
                'unique:artists,name',
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
