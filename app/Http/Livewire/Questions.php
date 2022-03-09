<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Question;

class Questions extends Component
{
    public $questions;
    public $questionSearch = '';

    public $listeners = ['removeQuestion'];

    public function mount()
    {
        $this->questions = Question::where('title', 'LIKE', '%' . $this->questionSearch . '%')->get();
    }

    public function removeQuestion(Question $question)
    {
        $question->delete();
    }

    public function render()
    {
        $this->questions = Question::where('title', 'LIKE', '%' . $this->questionSearch . '%')->get();
        return view('livewire.questions', [
            'questions' => $this->questions
        ]);
    }
}