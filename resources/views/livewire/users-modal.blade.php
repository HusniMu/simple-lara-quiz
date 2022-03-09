<div class="p-10">
    @if($user)
    <h1 class="text-3xl font-semibold">
        Edit User {{ $user->name }}
    </h1>
    <form wire:submit.prevent='editUser({{ $user->id }})'>
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="user-name" class="block text-sm font-medium text-gray-700">User Name</label>
                        <input type="hidden" name="id" value="null" wire:model="userId">
                        <input type="text" wire:model="userName" name="user-name" id="user-name"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="user-email" class="block text-sm font-medium text-gray-700">User Email</label>
                        <input type="email" wire:model="userEmail" name="user-email" id="user-email"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                        @foreach ($roles as $role)
                        <span>
                            <input type="checkbox" class="border rounded shadow" {{in_array($role->id,
                            $user->roles->pluck('id')->toArray())? 'checked':''
                            }} value="{{ $role->id }}" onclick='Livewire.emit("editRoles", {{
                            $role->id }})'>
                            {{$role->name }}
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
        Add User
    </h1>
    <form wire:submit.prevent='addUser'>
        <div class="overflow-hidden shadow sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="user-name" class="block text-sm font-medium text-gray-700">User Name</label>
                        <input type="hidden" name="id" value="null" wire:model="userId">
                        <input type="text" wire:model="userName" name="user-name" id="user-name"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="user-email" class="block text-sm font-medium text-gray-700">User Email</label>
                        <input type="email" wire:model="userEmail" name="user-email" id="user-email"
                            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </div>
                </div>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-6">
                        <label for="roles" class="block text-sm font-medium text-gray-700">Roles</label>
                        @foreach ($roles as $role)
                        <span>
                            <input type="checkbox" class="border rounded shadow" value="{{ $role->id }}"
                                onclick='Livewire.emit("addRoles", {{ $role->id }})'>
                            {{$role->name }}
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
