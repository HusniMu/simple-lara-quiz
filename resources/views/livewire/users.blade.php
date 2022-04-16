<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Users') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="m-5">
                <div class="flex justify-between w-full mb-1">
                    <input type="text" wire:model="userSearch" class="w-full border rounded shadow">
                    <button onclick='Livewire.emit("openModal", "users-modal", {{ json_encode(["user" => ""]) }})'>Add
                        User</button>
                </div>
                <div class="mb-1">
                    <table class="w-full rounded table-auto">
                        <thead>
                            <tr>
                                <th>
                                    User Name
                                </th>
                                <th>
                                    Roles
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>
                                    @foreach ($user->roles->pluck('name') as $role)
                                    <span class="px-2 mx-1 bg-green-400 rounded shadow bordered">
                                        {{ $role }}
                                    </span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <i onclick='Livewire.emit("openModal", "users-modal", {{ json_encode(["user" => $user->id]) }})'
                                        class="p-1 text-white bg-blue-700 border rounded fa fa-pencil hover:bg-blue-500">Edit</i>
                                    <i class="p-1 text-white bg-red-700 border rounded fa fa-trash-o hover:bg-red-500"
                                        onclick='Livewire.emit("removeUser", {{ $user->id }})'>Delete</i>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
