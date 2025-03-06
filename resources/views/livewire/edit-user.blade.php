<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit User') }}
            </h2>
        </x-slot>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white shadow-xl sm:rounded-lg p-6">
                    @if (session()->has('message'))
                        <div class="bg-green-200 text-green-800 p-2 rounded mb-4">
                            {{ session('message') }}
                        </div>
                    @endif

                    <form wire:submit.prevent="updateUser">
                        <!-- Name -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Name:</label>
                            <input type="text" wire:model="name" class="border rounded w-full p-2"/>
                            @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                            <input type="email" wire:model="email" class="border rounded w-full p-2"/>
                            @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Password (Leave blank to keep current):</label>
                            <input type="password" wire:model="password" class="border rounded w-full p-2"/>
                            @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Role -->
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Role:</label>
                            <select wire:model="role" class="border rounded w-full p-2">
                                <option value="">Select Role</option>
                                @foreach ($roles as $role)
                                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @error('role') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                        </div>

                        <!-- Submit and Cancel -->
                        <div class="flex items-center gap-2">
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                            <a wire:navigate href="{{ route('admin.users') }}" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </x-app-layout>
</div>
