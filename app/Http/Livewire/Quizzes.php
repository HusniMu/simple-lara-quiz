<?php

namespace App\Http\Livewire;

use App\Models\QuestionDetail;
use App\Models\Quiz;
use App\Models\QuizDetail;
use Livewire\Component;

class Quizzes extends Component
{
    public $quiz;
    public $status;
    public $question;
    public $no;
    public $totalQuestion;

    public $mySelected;
    public $correct;

    public $result;
    public $argument;
    public $material;

    public $timer;

    public function mount()
    {
        $this->status = 'instruction';
        // $this->status = 'summary';
        $quiz = Quiz::find(request('quiz'));
        $questions = QuizDetail::where('quiz_id', $quiz->id)->get();
        $this->quiz = $quiz;
        $this->no = 1;
        $this->totalQuestion = $questions->count();
        $this->correct = 0;
        $this->timer = 15;

        $quizDetail = QuizDetail::where('quiz_id', $this->quiz->id)->where('no', $this->no)->first();
        $this->mySelected = $quizDetail->user_answer ?? null;
        if ($this->mySelected !== $quizDetail->correct_answer) {
            $this->result = "Answer Wrong";
            $this->argument = $quizDetail->questionDetail->argument;
            $this->material = ($quizDetail->material_id !== null) ? $quizDetail->material : null;
        } else {
            $this->result = "Correct";
            $this->argument = $quizDetail->questionDetail->argument;
            $this->material = ($quizDetail->material_id !== null) ? $quizDetail->material : null;
        }
    }

    public $listeners = ['timer', 'summary'];

    public function timer(int $countdown)
    {
        $this->timer = $countdown;
    }

    public function summary()
    {
        // $this->status = 'summary';
        $correct = QuizDetail::where('quiz_id', $this->quiz->id)
            ->whereColumn('correct_answer', 'user_answer')
            ->get();
        $this->correct = $correct->count();
        $totalScore = round(($this->correct * 100) / $this->totalQuestion);
        $this->quiz->update([
            'status' => 'finish',
            'score' => $totalScore
        ]);
    }

    public function changeStatus($status)
    {
        // dd($status);
        $this->status = $status;
        if ($status === 'summary') {
            dd($this->quiz);
        }
    }

    public function choiceOption($index)
    {
        $this->mySelected = $index;

        QuizDetail::where('quiz_id', $this->quiz->id)->where('no', $this->no)->update([
            'user_answer' => $this->mySelected
        ]);

        if ($this->mySelected !== $this->question->correct_answer) {
            $this->result = "Answer Wrong";
            $this->argument = $this->question->questionDetail->argument;
            $this->material = ($this->question->material_id !== null) ? $this->question->material : null;
        } else {
            $this->result = "Correct";
            $this->argument = $this->question->questionDetail->argument;
            $this->material = ($this->question->material_id !== null) ? $this->question->material : null;
        }
        // $this->argument = $this->question->argument;
    }

    public function nextQuestion()
    {
        if ($this->mySelected === $this->question->correct_answer) {
            $this->correct++;
        }
        if ($this->no < $this->totalQuestion) {
            $this->no++;
            $quizDetail = QuizDetail::where('quiz_id', $this->quiz->id)->where('no', $this->no)->first();
            $this->mySelected = $quizDetail->user_answer;
        } else {
            $this->status = 'summary';
            $totalScore = round(($this->correct * 100) / $this->totalQuestion);
            $this->quiz->update([
                'status' => 'finish',
                'score' => $totalScore
            ]);
        }
    }

    public function prevQuestion()
    {
        if ($this->no > 0) {
            $this->no--;
            $quizDetail = QuizDetail::where('quiz_id', $this->quiz->id)->where('no', $this->no)->first();
            $this->mySelected = $quizDetail->user_answer;
        }
    }

    public function render()
    {
        $this->question = QuizDetail::where('quiz_id', $this->quiz->id)->where('no', $this->no)->first();
        return view('livewire.quizzes', [
            'quiz' => $this->quiz,
        ]);
    }
}