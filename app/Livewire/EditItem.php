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
    public $currentImage;
    public $newImage;

    public function mount($id)
    {
        $item = Item::with('image')->findOrFail($id);
        $this->itemId = $item->id;
        $this->name = $item->name;
        $this->currentImage = optional($item->image)->image_path;
    }

    public function updateItem()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'newImage' => 'nullable|image|max:2048'
        ]);

        $item = Item::findOrFail($this->itemId);
        $item->update(['name' => $this->name]);

        if ($this->newImage) {
            $imagePath = $this->newImage->store('items', 'public');

            ItemImage::updateOrCreate(
                ['item_id' => $item->id],
                ['image_path' => $imagePath]
            );

            $this->currentImage = $imagePath;
        }

        return redirect()->route('list-view');
    }

    public function render()
    {
        return view('livewire.edit-item');
    }
}
