<?php

namespace App\Livewire;

use App\Models\Item;
use Livewire\Component;

class ListViewAdmin extends Component
{
    public $items = [];
    public $newItem = '';
    public $editItem = null;
    public $editName = '';

    public function mount()
    {
        $this->items = Item::all()->toArray();
    }

    public function addItem()
    {
        if (!empty($this->newItem)) {
            $item = Item::create(['name' => $this->newItem]);
            $this->items[] = $item->toArray();
            $this->newItem = '';
        }
    }

    public function deleteItem($id)
    {
        Item::destroy($id);
        $this->items = array_filter($this->items, fn($item) => $item['id'] !== $id);
    }

    public function editItem($id)
    {
        $item = collect($this->items)->firstWhere('id', $id);
        if ($item) {
            $this->editItem = $id;
            $this->editName = $item['name'];
        }
    }

    public function updateItem()
    {
        if ($this->editItem && !empty($this->editName)) {
            $item = Item::find($this->editItem);
            if ($item) {
                $item->update(['name' => $this->editName]);
                foreach ($this->items as &$localItem) {
                    if ($localItem['id'] === $this->editItem) {
                        $localItem['name'] = $this->editName;
                        break;
                    }
                }
            }
            $this->reset('editItem');
            $this->reset('editName');
        }
    }

    public function cancelEdit()
    {
        $this->reset('editItem');
        $this->reset('editName');
    }

    public function render()
    {
        return view('livewire.list-view-admin');
    }
}
