<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Item') }}
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

                    <form wire:submit.prevent="updateItem">
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" wire:model="name" class="border rounded w-full p-2"/>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Current Image:</label>
                            @if ($currentImage)
                                <img src="{{ asset('storage/' . $currentImage) }}" class="w-24 h-24 rounded mb-2" />
                            @else
                                <p class="text-gray-500">No image available.</p>
                            @endif
                        </div>

                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Upload New Image:</label>
                            <input type="file" wire:model="newImage" class="border rounded w-full p-2"/>
                            @error('newImage') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                            
                            @if ($newImage)
                                <div class="mt-2">
                                    <p class="text-gray-700 text-sm mb-1">New Image Preview:</p>
                                    <img src="{{ $newImage->temporaryUrl() }}" class="w-24 h-24 rounded mb-2" />
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center gap-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                            <a wire:navigate href="/list-view" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
