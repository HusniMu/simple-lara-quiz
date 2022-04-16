<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('History') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="m-5">
                <div class="flex justify-between w-full mb-1">
                    <input type="text" wire:model="historySearch" class="w-full border rounded shadow">
                </div>
                <div class="mb-1">
                    <table class="w-full rounded table-auto">
                        <thead>
                            <tr>
                                <th>
                                    Title
                                </th>
                                <th>
                                    Created At
                                </th>
                                <th>
                                    Status
                                </th>
                                <th>
                                    Score
                                </th>
                                <th>
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($histories as $history)
                            <tr>
                                <td>{{ $history->title }}</td>
                                <td>{{ $history->created_at->diffForHumans() }}</td>
                                <td>{{ $history->status }}</td>
                                <td>{{ $history->score ?? 0 }}</td>
                                <td class="text-center">
                                    <a href="{{ route('quizzes',['quiz'=>$history->id]) }}">
                                        <i
                                            class="p-1 text-white bg-blue-700 border rounded fa fa-pencil hover:bg-blue-500">Edit</i>
                                    </a>
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
