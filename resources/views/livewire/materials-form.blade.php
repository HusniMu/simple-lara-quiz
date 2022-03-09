<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Materials Form') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="m-5">
                <h1 class="text-3xl font-semibold">
                    {{ ($material === null) ? 'Create Material' : 'Edit Material '.$material->id }}
                </h1>
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="material-title" class="block text-sm font-medium text-gray-700">
                                    Material Title
                                </label>
                                <input type="hidden" name="id" value="null" wire:model="materialId">
                                <input type="text" wire:model.defer="materialTitle" name="material-title"
                                    id="material-title"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="material-Body" class="block text-sm font-medium text-gray-700">
                                    Material Body
                                </label>
                                <textarea name="material-body" id="material-body" cols="30" rows="10"
                                    wire:model.defer="materialBody" class="w-full border rounded shadow"></textarea>
                                {{-- <input type="text" wire:model.defer="materialBody" name="material-body"
                                    id="material-body"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                --}}
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <a href="/materials">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cancel
                            </button>
                        </a>
                        @if($material === null)
                        <button type="button" wire:click="createMoreMaterial"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                            Save & Create More
                        </button>
                        <button type="button" wire:click="createMaterial"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        @else
                        <button type="button" wire:click="updateMaterial({{ $material->id }})"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
