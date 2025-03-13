<?php

namespace App\Livewire;

use App\Models\Item;
use App\Models\ItemImage;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditItem extends Component
{
    use WithFileUploads;

    public $itemId;
    public $name;
    public $price;
    public $currentImage;
    public $newImage;

    public function mount($id)
    {
        $item = Item::with('image')->findOrFail($id);
        $this->itemId = $item->id;
        $this->name = $item->name;
        $this->price = $item->price;
        $this->currentImage = optional($item->image)->image_path;
    }

    public function updateItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|max:999',
            'newImage' => 'nullable|image|max:2048'
        ]);

        $item = Item::findOrFail($this->itemId);
        $item->update(['name' => $this->name, 'price' => $this->price]);

        if ($this->newImage) {
            $imagePath = $this->newImage->store('items', 'public');

            ItemImage::updateOrCreate(
                ['item_id' => $item->id],
                ['image_path' => $imagePath]
            );

            $this->currentImage = $imagePath;
        }

        session()->flash('message', 'Item updated successfully!');
        $this->redirect('/list-view', navigate: true);
    }

    public function render()
    {
        return view('livewire.edit-item');
    }
}
