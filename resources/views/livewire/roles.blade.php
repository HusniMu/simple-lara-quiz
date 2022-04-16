<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Roles') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="m-5">
                <div class="flex justify-between w-full mb-1">
                    <input type="text" wire:model="roleSearch" class="w-full border rounded shadow">
                    <button onclick='Livewire.emit("openModal", "roles-modal", {{ json_encode(["role" => ""]) }})'>Add
                        Role</button>
                </div>
                <div class="mb-1">
                    <table class="w-full rounded table-auto">
                        <thead>
                            <tr>
                                <th>
                                    Roles Name
                                </th>
                                <th>
                                    Permissions
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->name }}</td>
                                <td>
                                    @foreach ($role->permissions->pluck('name') as $permission)
                                    <span class="px-2 mx-1 bg-green-400 rounded shadow bordered">
                                        {{ $permission }}
                                    </span>
                                    @endforeach
                                </td>
                                <td class="text-center">
                                    <i onclick='Livewire.emit("openModal", "roles-modal", {{ json_encode(["role" => $role->id]) }})'
                                        class="p-1 text-white bg-blue-700 border rounded fa fa-pencil hover:bg-blue-500">Edit</i>
                                    <i class="p-1 text-white bg-red-700 border rounded fa fa-trash-o hover:bg-red-500"
                                        onclick='Livewire.emit("removeRole", {{ $role->id }})'>Delete</i>
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
