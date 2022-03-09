<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuizDetail extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function questionDetail()
    {
        return $this->belongsTo(QuestionDetail::class, 'question_detail_id');
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}