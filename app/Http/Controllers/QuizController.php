<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionDetail;
use App\Models\QuizDetail;
use Illuminate\Support\Facades\Auth;

class QuizController extends Controller
{
    public function index()
    {
        $current_level = Quiz::where('user_id', Auth::id())->where('score', '>=', '70')->orderBy('question_id', 'desc')->first();
        $questions = '';
        $old = '';
        if ($current_level !== null) {
            if ($current_level->status == 'finish') {
                $questions = Question::where('id', '>', $current_level->question_id + 1)->get();
                $old = Question::where('id', '<=', $current_level->question_id + 1)->get();
            } else {
                $questions = Question::where('id', '>', $current_level->question_id)->get();
                $old = Question::where('id', '<=', $current_level->question_id)->get();
            }
        } else {
            $old = Question::orderBy('id', 'asc')->limit(1)->get();
            $questions = Question::orderBy('id', 'asc')->limit(1000)->skip(1)->get();
        }
        $data = [];
        if ($old !== '') {
            foreach ($old as $o) {
                if ($o->QuestionDetail->count() >= 10)
                    $data[] = [
                        'id' => $o->id,
                        'title' => $o->title,
                        'status' => 'open'
                    ];
            }
        }
        if ($questions !== '') {
            foreach ($questions as $q) {
                if ($q->QuestionDetail->count() >= 10)
                    $data[] = [
                        'id' => $q->id,
                        'title' => $q->title,
                        'status' => 'locked'
                    ];
            }
        }
        // dd($data);
        return view('dashboard', compact('data'));
    }

    public function initiate(Question $question)
    {
        $user_id = Auth::user()->id;
        $questions = QuestionDetail::where('question_id', $question->id)
            // ->inRandomOrder()
            ->get();

        $quiz = Quiz::create([
            'user_id' => $user_id,
            'question_id' => $question->id,
            'status' => 'unfinish'
        ]);

        $old = [];
        // dd(1 << 30);
        // 2147483648
        // dd(6 % 2147483648);

        // dd($questions);
        foreach ($questions as $dt) {
            $lcg = $this->bsd_rand(5, $question->id, $dt->id);
            $old[$lcg()] = $dt;
        }
        // dd($questions, $old);
        ksort($old);
        $i = 1;
        // dd($old);
        foreach ($old as $o) {
            QuizDetail::create([
                'quiz_id' => $quiz->id,
                'question_detail_id' => $o->id,
                'no' => $i,
                'question' => $o->question,
                'answer' => $o->answer,
                'correct_answer' => $o->correct_answer,
                'material_id' => $o->material_id
            ]);
            $i++;
        }

        return redirect(route('quizzes', ['quiz' => $quiz->id]));
    }

    public function bsd_rand($seed, $quiz, $question)
    {
        return function () use (&$seed, &$question, &$quiz) {
            // return $seed = (1103515245 * $seed + 12345) % (1 << 31);
            // return $seed = (random_int(0, 50) * $seed + random_int(0, 50)) % (1 << 31);
            return $seed = (random_int(1, 50) * $question + auth()->id()) % (1 << 31);
        };
    }
}