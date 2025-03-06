<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Add User') }}
            </h2>
        </x-slot>

        <form wire:submit.prevent="addUser" class="max-w-lg mx-auto bg-white p-6 shadow rounded">
            <input type="text" wire:model="name" placeholder="Name" class="border p-2 mb-2 w-full"/>
            <input type="email" wire:model="email" placeholder="Email" class="border p-2 mb-2 w-full"/>
            <input type="password" wire:model="password" placeholder="Password" class="border p-2 mb-2 w-full"/>

            <select wire:model="role" class="border p-2 mb-2 w-full">
                <option value="">Select Role</option>
                @foreach ($roles as $role)
                    <option value="{{ $role->name }}">{{ $role->name }}</option>
                @endforeach
            </select>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Add User</button>
        </form>
    </x-app-layout>
</div>
