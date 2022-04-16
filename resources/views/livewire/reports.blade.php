<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Reports') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="m-5">
                <div class="flex justify-between w-full mb-1">
                    <input type="text" wire:model="reportSearch" class="w-full border rounded shadow">
                </div>
                <div class="mb-1">
                    <table class="w-full rounded table-auto">
                        <thead>
                            <tr>
                                <th>
                                    User Name
                                </th>
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
                            @foreach ($reports as $report)
                            <tr>
                                <td>{{ $report->name }}</td>
                                <td>{{ $report->title }}</td>
                                <td>{{ $report->created_at->diffForHumans() }}</td>
                                <td>{{ $report->status }}</td>
                                <td>{{ $report->score ?? 0 }}</td>
                                <td class="text-center">
                                    <a href="{{ route('report-details',$report->id) }}">
                                        <i
                                            class="p-1 text-white bg-green-700 border rounded fa fa-eye hover:bg-green-500">Show</i>
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
