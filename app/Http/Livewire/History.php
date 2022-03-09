<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class History extends Component
{
    public $histories;
    public $historySearch = '';

    public function mount()
    {
        // $this->histories = Quiz::where('title', 'LIKE', '%' . $this->questionSearch . '%')->get();
        $this->histories = Quiz::join('questions', 'quizzes.question_id', '=', 'questions.id')
            ->select('quizzes.id', 'title', 'quizzes.created_at', 'status', 'score')
            ->where('user_id', Auth::id())
            ->where('title', 'LIKE', '%' . $this->historySearch . '%')
            ->get();
    }


    public function render()
    {
        $this->histories = Quiz::join('questions', 'quizzes.question_id', '=', 'questions.id')
            ->select('quizzes.id', 'title', 'quizzes.created_at', 'status', 'score')
            ->where('user_id', Auth::id())
            ->where('title', 'LIKE', '%' . $this->historySearch . '%')
            ->get();
        return view('livewire.history', [
            'histories' => $this->histories
        ]);
    }
}