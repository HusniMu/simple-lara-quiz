<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Quiz Form') }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div class="m-5">
                <h1 class="text-3xl font-semibold">
                    {{ ($question === null) ? 'Create Quiz' : 'Edit Quiz '.$question->title }}
                </h1>
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="question-title" class="block text-sm font-medium text-gray-700">
                                    Title
                                </label>
                                <input type="hidden" name="id" value="null" wire:model="questionId">
                                <input type="text" wire:model.defer="questionTitle" name="question-title"
                                    id="question-title"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <a href="/questions">
                            <button type="button"
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                Cancel
                            </button>
                        </a>
                        @if($question === null)
                        <button type="button" wire:click="createQuestion"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                        @else
                        <button type="button" wire:click="updateQuestion({{ $question->id }})"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Update
                        </button>
                        @endif
                    </div>
                </div>
                @if($question !== null)
                {{-- create or update details --}}
                <div class="overflow-hidden shadow sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="detail-question" class="block text-sm font-medium text-gray-700">
                                    Question
                                </label>
                                <input type="hidden" name="id" value="null" wire:model="detailId">
                                <input type="text" wire:model.defer="detailQuestion" name="detail-question"
                                    id="detail-question"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="detail-answer"
                                    class="block text-sm font-medium text-gray-700">Answer</label>
                                <div class="flex items-center mt-1">
                                    <input type="radio" class="p-3 mr-3" name="detail-correct"
                                        wire:model="detailCorrect" value="0" />
                                    <input type="text" wire:model.debounce.1000="detailAnswer0" name="detail-answer0"
                                        id="detail-answer0"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="flex items-center mt-1">
                                    <input type="radio" class="p-3 mr-3" name="detail-correct"
                                        wire:model="detailCorrect" value="1" />
                                    <input type="text" wire:model.debounce.1000="detailAnswer1" name="detail-answer1"
                                        id="detail-answer1"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="flex items-center mt-1">
                                    <input type="radio" class="p-3 mr-3" name="detail-correct"
                                        wire:model="detailCorrect" value="2" />
                                    <input type="text" wire:model.debounce.1000="detailAnswer2" name="detail-answer2"
                                        id="detail-answer2"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                                <div class="flex items-center mt-1">
                                    <input type="radio" class="p-3 mr-3" name="detail-correct"
                                        wire:model="detailCorrect" value="3" />
                                    <input type="text" wire:model.debounce.1000="detailAnswer3" name="detail-answer3"
                                        id="detail-answer3"
                                        class="block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                </div>
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="detail-material" class="block text-sm font-medium text-gray-700">
                                    Material Reference
                                </label>
                                <select name="detail-material" id="detail-material" wire:model="detailMaterial"
                                    class="w-full border rounded shadow">
                                    <option value="">No Material</option>
                                    @foreach ($materials as $material)
                                    <option value="{{ $material->id }}">{{ $material->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-6 gap-6">
                            <div class="col-span-6 sm:col-span-6">
                                <label for="detail-argument" class="block text-sm font-medium text-gray-700">
                                    Argument
                                </label>
                                <input type="text" wire:model.defer="detailArgument" name="detail-argument"
                                    id="detail-argument"
                                    class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </div>
                        </div>
                    </div>
                    <div class="px-4 py-3 text-right bg-gray-50 sm:px-6">
                        <button type="button" onclick='Livewire.emit("clearDetail")'
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-gray-600 border border-transparent rounded-md shadow-sm focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 hover:bg-red-500">Clear</button>
                        <button type="button" wire:click="createDetail({{ $question->id }})"
                            class="inline-flex justify-center px-4 py-2 text-sm font-medium text-white bg-indigo-600 border border-transparent rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ ($detailId !== null) ? "Update Question" : 'Add Question' }}
                        </button>
                    </div>
                </div>

                {{-- list question details --}}
                <table class="w-full mt-5 rounded table-auto">
                    <thead>
                        <tr>
                            <th>
                                Question
                            </th>
                            <th>
                                Answer
                            </th>
                            <th>
                                Correct Answer
                            </th>
                            <th>
                                Argument
                            </th>
                            <th>
                                Material
                            </th>
                            <th>
                                Action
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($questionDetails->count() >0)
                        @foreach ($questionDetails as $qd)
                        <tr>
                            <td>
                                {{ $qd->question }}
                            </td>
                            <td>
                                {{ $qd->answer }}
                            </td>
                            <td>
                                {{ $qd->correct_answer }}
                            </td>
                            <td>
                                {{ $qd->argument }}
                            </td>
                            <td>
                                @if($qd->material_id !== null)
                                {{ $qd->material->title }}
                                @endif
                            </td>
                            <td>
                                <i class="p-1 text-white bg-blue-700 border rounded fa fa-pencil hover:bg-blue-500"
                                    onclick='Livewire.emit("editDetail", {{ $qd->id }})'></i>
                                <i class="p-1 text-white bg-red-700 border rounded fa fa-trash-o hover:bg-red-500"
                                    onclick='Livewire.emit("removeDetail", {{ $qd->id }})'></i>
                            </td>
                        </tr>
                        @endforeach
                        @else
                        <tr>
                            <td colspan="5">-</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                @endif
            </div>
        </div>
    </div>
</div>
