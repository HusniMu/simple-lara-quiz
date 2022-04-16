<x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
        {{ __('Quiz '.$quiz->question->title) }}
    </h2>
</x-slot>
<div class="py-12">
    <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
            <div>
                <div class="m-4" x-data="{active: false, countdown: false, status: false}">
                    <div x-show="!active">
                        <form method="POST" action="" name=""
                            @submit.prevent="active = true;countdown = {{ $timer }};window.setInterval(() => {
                                if(countdown > 0) {countdown = countdown - 1; Livewire.emit('timer', countdown); console.log(countdown, status, @js($status))} }, 1000)">
                            @if($status === 'instruction')
                            <h1>Instruction</h1>
                            <h1>
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Veritatis beatae corrupti atque
                                nihil
                                repudiandae perferendis molestiae odit soluta ullam architecto modi, dolores odio
                                explicabo sit at
                                possimus repellendus nulla reprehenderit.
                            </h1>
                            <button class="px-5 py-2 text-white bg-green-500 border rounded hover:bg-green-400"
                                wire:click="changeStatus('quiz')" type="submit">Start</button>
                            @endif
                        </form>
                    </div>
                    <div x-show="active">
                        <template x-if="countdown > 0 && status === false">
                            <div>
                                <div>Counting down</div>
                                <div x-text="countdown"></div>
                                @if($status === 'quiz')
                                <div class="m-5">
                                    <h1>Question {{ $no }}/{{ $totalQuestion }}</h1>
                                    <hr>
                                    <p class="text-1xl">
                                        {!! nl2br($question->question) !!}
                                    </p>
                                    @foreach (json_decode($question->answer) as $index => $answer)
                                    <div class="flex items-center mt-2">
                                        <input type="radio"
                                            class="p-3 mr-3 {{ $mySelected!== null ? 'text-gray-500' : 'text-black' }}"
                                            name="detail-correct" value="{{ $index }}"
                                            wire:click="choiceOption({{ $index }})" {{ $mySelected===$index ? 'checked'
                                            : '' }} {{ $mySelected!==null ? 'disabled' : '' }} />
                                        <p class="text-xl form-check-label {{ $mySelected !==null ? 'text-gray-500'
                                            : 'text-black' }}">
                                            {!! nl2br($answer) !!}
                                        </p>
                                    </div>
                                    @endforeach
                                    <hr>
                                    <div class="flex justify-between mt-2">
                                        @if($mySelected !== null)
                                        <button
                                            class="px-4 py-2 text-white bg-indigo-600 border rounded shadow hover:bg-indigo-500"
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
                                        <a href="{{ route('user-materials-show',$material->id) }}" target="_blank">{{
                                            $material->title
                                            }}</a>
                                        {{-- <br>
                                        {{ $material->body }} --}}
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                @endif
                            </div>
                        </template>
                        <template x-if="countdown === 0 ">
                            <div>
                                <h1>Waktu Habis</h1>
                                <h3>{{ $timer }}</h3>
                                @if($status !== 'summary')
                                <button class="px-5 py-2 text-white bg-gray-500 border rounded hover:bg-gray-400"
                                    @click="(status= true, Livewire.emit('summary'))"
                                    wire:click="Livewire.emit('summary')">OK</button>
                                @endif
                            </div>
                        </template>
                        <template x-if="status === true">
                            <div>
                                <div class="m-5">
                                    <h1>finish</h1>
                                    <hr>
                                    <h1>correct answer {{ $correct }}</h1>
                                    <h1>score {{ round(($correct*100)/$totalQuestion) }}</h1>
                                </div>
                                <a href="{{ route('dashboard') }}"
                                    class="px-5 py-2 text-white bg-gray-500 border rounded hover:bg-gray-400">OK</a>
                            </div>
                        </template>
                        @if($status === 'summary')
                        <div class="m-5">
                            <h1>finish</h1>
                            <hr>
                            <h1>correct answer {{ $correct }}</h1>
                            <h1>score {{ round(($correct*100)/$totalQuestion) }}</h1>
                        </div>
                        <a href="{{ route('dashboard') }}"
                            class="px-5 py-2 text-white bg-gray-500 border rounded hover:bg-gray-400">OK</a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    //     setTimeout(function(){
//     console.log("Hello World");
// }, 2000);
</script>
