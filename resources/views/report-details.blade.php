<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Report Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
                <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg">
                    <div class="border rounded shadow p-5">
                        <h1 class="text-2xl">Judul uji: {{ $quiz->user->name }}</h1>
                        <h1>Peserta uji: {{ $quiz->user->name }}</h1>
                        <h1>Waktu uji: {{ $quiz->created_at }}</h1>
                        <h1>Status uji: {{ $quiz->status }}</h1>
                    </div>
                    <div class="border rounded shadow mt-5 p-5">
                        @foreach ($quizDetails as $qd)
                        <div class="border rounded shadow mt-5 p-5">
                            <table>
                                <tr>
                                    <td>Pertanyaan</td>
                                    <td>: {{ $qd->question }}</td>
                                </tr>
                                <tr>
                                    <td>
                                        Pilihan
                                    </td>
                                    <td>:</td>
                                </tr>
                                <tr>
                                    <td></td>
                                    <td>
                                        <input type="hidden" value="{{ $i = 1 }}">
                                        @foreach (json_decode($qd->answer) as $answer)
                                        {{ $i }})&nbsp;&nbsp;{{ $answer }}
                                        <br>
                                        <input type="hidden" value="{{ $i++ }}">
                                        @endforeach
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jawaban Peserta Uji</td>
                                    <td>:
                                        {{ ($qd->user_answer!== null)?$qd->user_answer+1:'-' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jawaban Benar</td>
                                    <td>: {{ $qd->correct_answer+1 }}</td>
                                </tr>
                                <tr>
                                    <td>Hasil</td>
                                    <td>: {{ ($qd->correct_answer === $qd->user_answer)? 'Benar': 'Salah' }}</td>
                                </tr>
                            </table>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
