<div class="p-10">
    @if($role)
    <h1 class="text-3xl font-semibold">
        Edit Role {{ $role->name }}
    </h1>
    <form wire:submit.prevent='editRole({{ $role->id }})'>
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="role-name" class="block text-sm font-medium text-gray-700">Role name</label>
                        <input type="hidden" name="id" value="null" wire:model="roleId">
                        <input type="text" wire:model="roleName" name="role-name" id="role-name"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="permissions" class="block text-sm font-medium text-gray-700">Permissions</label>
                        @foreach ($permissions as $permission)
                        <span>
                            <input type="checkbox" class="border rounded shadow" {{in_array($permission->id,
                            $role->permissions->pluck('id')->toArray())? 'checked':''
                            }} value="{{ $permission->id }}" onclick='Livewire.emit("editPermissions", {{
                            $permission->id }})'>
                            {{$permission->name }}
                            {{-- onclick='Livewire.emit("editPermissions", {{ $permission->id }})' --}}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                <button type="submit"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
        </div>
    </form>
    @else
    <h1 class="text-3xl font-semibold">
        Add Role
    </h1>
    <form wire:submit.prevent='addRole'>
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="role-name" class="block text-sm font-medium text-gray-700">Role name</label>
                        <input type="hidden" name="id" value="null" wire:model="roleId">
                        <input type="text" wire:model="roleName" name="role-name" id="role-name"
                            autocomplete="given-name"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="permissions" class="block text-sm font-medium text-gray-700">Permissions</label>
                        @foreach ($permissions as $permission)
                        <span>
                            <input type="checkbox" class="border rounded shadow" value="{{ $permission->id }}"
                                onclick='Livewire.emit("addPermissions", {{ $permission->id }})'>
                            {{$permission->name }}
                        </span>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                <button type="submit"
                    class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Save</button>
            </div>
        </div>
    </form>
    @endif
</div>
