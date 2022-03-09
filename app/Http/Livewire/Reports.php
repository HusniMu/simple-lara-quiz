<?php

namespace App\Http\Livewire;

use App\Models\Quiz;
use Livewire\Component;

class Reports extends Component
{
    public $reports;
    public $reportSearch = '';

    public function mount()
    {
        // $this->histories = Quiz::where('title', 'LIKE', '%' . $this->questionSearch . '%')->get();
        $this->reports = Quiz::join('questions', 'quizzes.question_id', '=', 'questions.id')
            ->join('users', 'quizzes.user_id', '=', 'users.id')
            ->select('quizzes.id', 'users.name', 'title', 'quizzes.created_at', 'status', 'score')
            ->where('title', 'LIKE', '%' . $this->reportSearch . '%')
            ->orWhere('users.name', 'LIKE', '%' . $this->reportSearch . '%')
            ->get();
    }


    public function render()
    {
        $this->reports = Quiz::join('questions', 'quizzes.question_id', '=', 'questions.id')
            ->join('users', 'quizzes.user_id', '=', 'users.id')
            ->select('quizzes.id', 'users.name', 'title', 'quizzes.created_at', 'status', 'score')
            ->where('title', 'LIKE', '%' . $this->reportSearch . '%')
            ->orWhere('users.name', 'LIKE', '%' . $this->reportSearch . '%')
            ->get();
        return view('livewire.reports', [
            'reports' => $this->reports
        ]);
    }
}