<?php

namespace App\Livewire;


use App\Models\Item;
use App\Models\ItemImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class ListViewAdmin extends Component
{
    use WithFileUploads;

    public $items = [];
    public $newItem = '';
    public $newImage;
    public $editItem = null;
    public $editName = '';
    public $editImage;

    public function mount()
    {
        $this->items = Item::with('image')->get()->toArray();
    }

    public function addItem()
    {
        $this->validate([
            'newItem' => 'required|string|max:255',
            'newImage' => 'nullable|image|max:2048'
        ]);

        $item = Item::create(['name' => $this->newItem]);

        if ($this->newImage) {
            $imagePath = $this->newImage->store('items', 'public');
            ItemImage::create([
                'item_id' => $item->id,
                'image_path' => $imagePath,
            ]);
        }

        $this->reset(['newItem', 'newImage']);
        $this->mount();
    }

    public function deleteItem($id)
    {
        Item::destroy($id);
        session()->flash('message', 'Item deleted successfully!');
        $this->mount();
    }

    public function render()
    {
        return view('livewire.list-view-admin');
    }
}
