<div>
    <x-app-layout>
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Manage Users') }}
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

                    <a wire:navigate href="{{ route('admin.users.add') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Add User</a>

                    <table class="min-w-full bg-white mb-4">
                        <thead>
                            <tr class="bg-gray-200 text-gray-600 uppercase text-sm">
                                <th class="py-3 px-6">Name</th>
                                <th class="py-3 px-6">Email</th>
                                <th class="py-3 px-6">Role</th>
                                <th class="py-3 px-6 text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-700 text-sm">
                            @foreach ($users as $user)
                                <tr class="border-b">
                                    <td class="py-3 px-6">{{ $user['name'] }}</td>
                                    <td class="py-3 px-6">{{ $user['email'] }}</td>
                                    <td class="py-3 px-6">{{ implode(', ', array_column($user['roles'], 'name')) }}</td>
                                    <td class="py-3 px-6 text-center">
                                        <a wire:navigate href="{{ route('admin.users.edit', $user['id']) }}" class="text-blue-500">Edit</a>
                                        <button wire:click="deleteUser({{ $user['id'] }})" class="text-red-500 ml-2">Delete</button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </x-app-layout>
</div>
