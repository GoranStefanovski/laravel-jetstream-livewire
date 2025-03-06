<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\ItemImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class AddItem extends Component
{
    use WithFileUploads;

    public $name = '';
    public $image;

    public function addItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048'
        ]);

        $item = Item::create(['name' => $this->name]);

        if ($this->image) {
            $imagePath = $this->image->store('items', 'public');
            ItemImage::create([
                'item_id' => $item->id,
                'image_path' => $imagePath,
            ]);
        }

        session()->flash('message', 'Item added successfully!');
        $this->redirect('/list-view', navigate: true);
    }

    public function render()
    {
        return view('livewire.add-item');
    }
}
