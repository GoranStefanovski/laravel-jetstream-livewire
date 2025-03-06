<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Items') }}
        </h2>
    </x-slot>
    <div class="mt-4 p-4 text-right">
    <a href="{{ route('admin.items.add') }}" class="bg-blue-500 text-white px-4 py-2 rounded">Add New Item</a>
</div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                @if(isset($this->items) && count($this->items) > 0)
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm leading-normal">
                                <th class="py-3 px-6 text-left">ID</th>
                                <th class="py-3 px-6 text-left">Image</th>
                                <th class="py-3 px-6 text-left">Name</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm font-light">
                            @foreach ($this->items as $item)
                                <tr class="border-b border-gray-200 hover:bg-gray-100">
                                    <td class="py-3 px-6 text-left">{{ $item['id'] }}</td>

                                    <!-- Display Image if Exists -->
                                    <td class="py-3 px-6 text-left">
                                        @if (isset($item['image']['image_path']))
                                            <img src="{{ asset('storage/' . $item['image']['image_path']) }}" class="w-12 h-12 rounded" />
                                        @else
                                            <img src="https://via.placeholder.com/48" class="w-12 h-12 rounded" />
                                        @endif
                                    </td>

                                    <td class="py-3 px-6 text-left">
                                        @if ($this->editItem === $item['id'])
                                            <input type="text" wire:model="editName" class="border rounded p-1"/>
                                            <input type="file" wire:model="editImage" class="border rounded p-1 mt-2"/>
                                            @error('editImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                                        @else
                                            {{ $item['name'] }}
                                        @endif
                                    </td>

                                    <td class="py-3 px-6 text-center">
                                        @if ($this->editItem === $item['id'])
                                            <button wire:click="updateItem" class="bg-green-500 text-white px-2 py-1 rounded">Save</button>
                                            <button wire:click="cancelEdit" class="bg-gray-500 text-white px-2 py-1 rounded">Cancel</button>
                                        @else
                                            <a wire:navigate href="{{ route('admin.items.edit', $item['id']) }}" class="text-blue-500 hover:underline">Edit</a>
                                            <button wire:click="deleteItem({{ $item['id'] }})" class="text-red-500 hover:underline ml-2">Delete</button>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center p-4">No items available.</p>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
</div>
