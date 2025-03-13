<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add Item') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                    @if (session()->has('message'))
                        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="addItem">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" wire:model="name" class="border rounded w-full p-2"/>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Price:</label>
                            <input type="number" wire:model="price" class="border rounded w-full p-2"/>
                            @error('price') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Upload Image:</label>
                            <input type="file" wire:model="image" class="border rounded w-full p-2"/>
                            @error('image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

                            @if ($image)
                                <div class="mt-2">
                                    <p class="text-gray-700 text-sm mb-1">New Image Preview:</p>
                                    @if ($image && in_array($image->getClientOriginalExtension(), ['jpg', 'jpeg', 'png', 'gif']))
                                        <img src="{{ $image->temporaryUrl() }}" class="w-24 h-24 rounded mb-2" />
                                    @endif

                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add</button>
                            <a wire:navigate href="{{ route('list-view') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
