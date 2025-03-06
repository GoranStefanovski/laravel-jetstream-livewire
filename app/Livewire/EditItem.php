<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class EditItem extends Component
{
    public $itemId;
    public $name;

    public function mount($id)
    {
        $item = Item::findOrFail($id);
        $this->itemId = $item->id;
        $this->name = $item->name;
    }

    public function updateItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $item = Item::findOrFail($this->itemId);
        $item->update(['name' => $this->name]);

        session()->flash('message', 'Item updated successfully!');
        return redirect()->route('list-view');
    }

    public function render()
    {
        return view('livewire.edit-item');
    }
}
