<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class QuestionWord extends Model
{
    use HasFactory,HasTranslations;

    protected $fillable = ['audio','en_text','translation_correct_words','translation_incorrect_words','chapter_id','lesson_id','exercise_id','status','order'];

    public $translatable = ["translation_correct_words","translation_incorrect_words"];

    public function Exercise(){
        return $this->belongsTo(List_exercise::class);
    }

    public function Lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function Chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function getAudio(){
        if(file_exists(public_path('/storage/uploads/question_word_audio/'.$this->audio)) && !is_null($this->audio)){
            return asset('/storage/uploads/question_word_audio/'.$this->audio);
        }else{
            return null;
        }
    }

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            // Find the current highest order number
            $maxOrder = static::max('order');
            // Set the order field to be the highest order number + 1
            $model->order = $maxOrder + 1;
        });
    }

}
