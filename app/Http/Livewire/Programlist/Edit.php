<?php

namespace App\Http\Livewire\Programlist;

use App\Models\Composition;
use App\Models\Programlist;
use Livewire\Component;

class Edit extends Component
{
    public Programlist $programlist;

    public array $listsForFields = [];

    public function mount(Programlist $programlist)
    {
        $this->programlist = $programlist;
        $this->initListsForFields();
    }

    public function render()
    {
        return view('livewire.programlist.edit');
    }

    public function submit()
    {
        $this->validate();

        $this->programlist->save();

        return redirect()->route('admin.programlists.index');
    }

    protected function rules(): array
    {
        return [
            'programlist.composition_id' => [
                'integer',
                'exists:compositions,id',
                'required',
            ],
            'programlist.order_by' => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'required',
            ],
            'programlist.opener' => [
                'boolean',
            ],
            'programlist.closer' => [
                'boolean',
            ],
        ];
    }

    protected function initListsForFields(): void
    {
        $this->listsForFields['composition'] = Composition::pluck('title', 'id')->toArray();
    }
}
