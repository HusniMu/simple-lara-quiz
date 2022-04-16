<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('User Materials Show') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="p-5 border rounded shadow">
                        <h1 class="text-2xl">Judul Material: {{ $material->title }}</h1>
                        <h1>Published : {{ $material->created_at->diffForHumans() }}</h1>
                        <table>
                            <tr>
                                <td>Pembahasan</td>
                                <td>:</td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    {{--
                                    <pre style="white-space: pre-wrap;" class="font-semibold"> --}}
                                        <p  class="font-semibold">
                                            {!! nl2br($material->body) !!}
                                        </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
