<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Quiz '.$quiz->question->title) }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            {{-- question --}}
            @if($status === 'instruction')
            <div class="m-5">
                <h1>Instruction</h1>
                <h1>
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis beatae corrupti atque nihil
                    repudiandae perferendis molestiae odit soluta ullam architecto modi, dolores odio explicabo sit at
                    possimus repellendus nulla reprehenderit.
                </h1>
                <button class="px-5 py-2 text-white bg-green-500 border rounded hover:bg-green-400"
                    wire:click="changeStatus('quiz')">Start</button>
            </div>
            @elseif($status === 'quiz')
            <div class="m-5">
                <h1>Question {{ $no }}/{{ $totalQuestion }}</h1>
                <hr>
                <h1 class="text-3xl">
                    {{ $question->question }}
                </h1>
                @foreach (json_decode($question->answer) as $index => $answer)
                <div class="flex items-center mt-2">
                    <input type="radio" class="p-3 mr-3 {{ $mySelected!== null ? 'text-gray-500' : 'text-black' }}"
                        name="detail-correct" value="{{ $index }}" wire:click="choiceOption({{ $index }})" {{
                        $mySelected===$index ? 'checked' : '' }} {{ $mySelected!==null ? 'disabled' : '' }} />
                    <label for=""
                        class="text-xl form-check-label {{ $mySelected !== null ? 'text-gray-500' : 'text-black' }}">
                        {{ $answer }}
                    </label>
                </div>
                @endforeach
                <hr>
                <div class="flex justify-between mt-2">
                    {{-- <button class="px-4 py-2 border rounded shadow hover:bg-gray-500 hover:text-white"
                        wire:click="prevQuestion">
                        back
                    </button> --}}
                    @if($mySelected !== null)
                    <button class="px-4 py-2 text-white bg-indigo-600 border rounded shadow hover:bg-indigo-500"
                        wire:click="nextQuestion">
                        next
                    </button>
                    @endif
                </div>
                @if($mySelected !== null)
                <div class="mt-2">
                    {{ $result }}
                    <br>
                    {{ $argument }}
                    @if($material !== null)
                    <br>
                    <a href="{{ route('user-materials-show',$material->id) }}" target="_blank">{{ $material->title
                        }}</a>
                    {{-- <br>
                    {{ $material->body }} --}}
                    @endif
                </div>
                @endif
            </div>
            {{-- score --}}
            @elseif($status === 'summary')
            <div class="m-5">
                <h1>finish</h1>
                <hr>
                <h1>correct answer {{ $correct }}</h1>
                <h1>score {{ round(($correct*100)/$totalQuestion) }}</h1>
            </div>
            @endif
        </div>
    </div>
</div>
