<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lesson extends Model
{
    use HasFactory,HasTranslations;

    // protected $fillable = ['title','name','chapter_id','order','dopamine_image1','dopamine_image2','dopamine_image3','dopamine_image4'];
    protected $fillable = ['title','name','chapter_id','order'];
    public $translatable = ['title'];


    public function chapter(){
        return $this->belongsTo(Chapter::class);
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


    // 11 exercise type below relation
    public function exerciseType1(){
        return $this->hasMany(Vocabulary::class,'exercise_id','id');
    }
    public function exerciseType2(){
        return $this->hasMany(QuestionWord::class,'exercise_id','id');
    }
    public function exerciseType3(){
        return $this->hasMany(Video::class,'exercise_id','id');
    }
    
    public function exerciseType4(){
        return $this->hasMany(AudioTranslation::class,'exercise_id','id');
    }
    public function exerciseType5(){
        return $this->hasMany(QuestionImage::class,'exercise_id','id');
    }

    public function exerciseType6(){
        return $this->hasMany(Spelling::class,'exercise_id','id');
    }

    public function exerciseType7(){
        return $this->hasMany(Pronunciation::class,'exercise_id','id');
    }

    public function exerciseType8(){
        return $this->hasMany(Grammar::class,'exercise_id','id');
    }
    public function exerciseType9(){
        return $this->hasMany(TestImage::class,'exercise_id','id');
    }
    public function exerciseType10(){
        return $this->hasMany(TestWord::class,'exercise_id','id');
    }
    
    public function exerciseType11(){
        return $this->hasMany(Listening::class,'exercise_id','id');
    }
}
