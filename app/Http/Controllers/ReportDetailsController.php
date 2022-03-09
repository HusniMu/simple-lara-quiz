<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\QuizDetail;
use Illuminate\Http\Request;

class ReportDetailsController extends Controller
{
    public function show($quiz_id)
    {
        $quiz = Quiz::find($quiz_id);
        $quizDetails = QuizDetail::where('quiz_id', $quiz->id)->get();

        return view('report-details', compact('quiz', 'quizDetails'));
    }
}