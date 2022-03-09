<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="flex justify-center m-5">
                        @hasanyrole('Admin|Super Admin')
                        <h1 class="text-3xl">Welcome</h1>
                        @endhasanyrole
                        @role('User')
                        @foreach ($data as $dt)
                        <a href="{{ $dt['status'] === 'open' ? route('generate-quiz', $dt['id']) : " #" }}">
                            <button {{ $dt['status']==='open' ? '' : 'disabled' }}
                                class="px-6 py-4 m-3 text-xl text-white {{ $dt['status']==='open' ? 'bg-blue-600 hover:bg-blue-500' : 'bg-gray-600 hover:bg-gray-500' }}  border rounded shadow ">
                                {{ $dt['title'] }}
                            </button>
                        </a>
                        @endforeach
                        @endrole
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
