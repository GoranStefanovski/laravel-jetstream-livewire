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
    public $price = 0;
    public $image;

    public function addItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|max:999',
            'image' => 'nullable|mimes:jpg,jpeg,png|max:2048'
        ]);

        $item = Item::create(['name' => $this->name, 'price' => $this->price]);

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
