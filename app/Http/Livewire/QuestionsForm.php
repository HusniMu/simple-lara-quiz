<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Material;
use App\Models\Question;
use Illuminate\Http\Request;
use App\Models\QuestionDetail;

class QuestionsForm extends Component
{
    public $question, $questionDetails;
    public $questionId,
        $questionTitle;
    public $detailId,
        $detailQuestion,
        $detailAnswer0,
        $detailAnswer1,
        $detailAnswer2,
        $detailAnswer3,
        $detailCorrect,
        $detailArgument,
        $detailMaterial;

    public $listeners = ['updateDetails', 'removeDetail', 'editDetail', 'clearDetail'];

    public function updateDetails()
    {
        $this->questionDetails = QuestionDetail::where('question_id', $this->question->id)->get();
    }

    public function mount()
    {
        $question = Question::find(request('question'));
        $this->question = $question;
        $this->questionId = $question === null ? $question : $question->id;
        $this->questionTitle = $question === null ? $question : $question->title;
        $this->questionDetails = $question === null ? null : QuestionDetail::where('question_id', $question->id)->get();
    }

    public function createQuestion()
    {
        $question = Question::create([
            'title' => $this->questionTitle,
        ]);
        return redirect(route('questions-form', ['question' => $question->id]));
    }
    public function updateQuestion(Question $question)
    {
        $question->update([
            'title' => $this->questionTitle,
        ]);
        return redirect(route('questions-form', ['question' => $question->id]));
    }

    public function createDetail(Question $question)
    {
        $answer = json_encode([$this->detailAnswer0, $this->detailAnswer1, $this->detailAnswer2, $this->detailAnswer3]);
        if ($this->detailId === null || $this->detailId === '') {
            $question = QuestionDetail::create([
                'question_id' => $question->id,
                'question' => $this->detailQuestion,
                'answer' => $answer,
                'correct_answer' => $this->detailCorrect,
                'argument' => $this->detailArgument,
                'material_id' => ($this->detailMaterial === null || $this->detailMaterial === '') ? null : $this->detailMaterial
            ]);
        } else {
            $questionDetail = QuestionDetail::find($this->detailId);
            $questionDetail->update([
                'question' => $this->detailQuestion,
                'answer' => $answer,
                'correct_answer' => $this->detailCorrect,
                'argument' => $this->detailArgument,
                'material_id' => ($this->detailMaterial === null || $this->detailMaterial === '') ? null : $this->detailMaterial
            ]);
        }

        $this->detailId = null;
        $this->detailQuestion = '';
        $this->detailAnswer0 = '';
        $this->detailAnswer1 = '';
        $this->detailAnswer2 = '';
        $this->detailAnswer3 = '';
        $this->detailCorrect = '';
        $this->detailArgument = '';
        $this->detailMaterial = '';

        $this->emit('updateDetails');
    }

    public function removeDetail(QuestionDetail $questionDetail)
    {
        $questionDetail->delete();
        $this->emit('updateDetails');
    }

    public function editDetail(QuestionDetail $questionDetail)
    {
        $this->detailId = $questionDetail->id;
        $this->detailQuestion = $questionDetail === null ? $questionDetail : $questionDetail->question;
        if ($questionDetail !== null) {
            foreach (json_decode($questionDetail->answer) as $key => $answer) {
                if ($key === 0) {
                    $this->detailAnswer0 = $answer;
                } else if ($key === 1) {
                    $this->detailAnswer1 = $answer;
                } else if ($key === 2) {
                    $this->detailAnswer2 = $answer;
                } else if ($key === 3) {
                    $this->detailAnswer3 = $answer;
                }
            }
        }
        $this->detailCorrect = $questionDetail === null ? $questionDetail : $questionDetail->correct_answer;
        $this->detailArgument = $questionDetail === null ? $questionDetail : $questionDetail->argument;
        $this->detailMaterial = $questionDetail === null ? $questionDetail : $questionDetail->material_id;
    }

    public function clearDetail()
    {
        $this->detailId = null;
        $this->detailQuestion = '';
        $this->detailAnswer0 = '';
        $this->detailAnswer1 = '';
        $this->detailAnswer2 = '';
        $this->detailAnswer3 = '';
        $this->detailCorrect = '';
        $this->detailArgument = '';
        $this->detailMaterial = '';
    }

    public function render()
    {
        $materials = Material::all();
        return view('livewire.questions-form', [
            'question' => $this->question,
            'questionDetails' => $this->questionDetails,
            'materials' => $materials
        ]);
    }
}