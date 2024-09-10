<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Phonetics extends Model
{
    use HasFactory,HasTranslations;

    protected $fillable = ['phonetic_alphabet','phonetic_text','audio','examples','sounds',
        'chapter_id','lesson_id','exercise_id','status','order'
    ];

    protected $casts = ['examples' => 'array',"sounds" => 'array'];
    
    public $translatable = ["phonetic_text","examples","sounds"];

    
    public function Exercise(){
        return $this->belongsTo(List_exercise::class);
    }

    public function Lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function Chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function getSound($phonetics){
        if(file_exists(public_path('/storage/uploads/phonetics/'.$phonetics)) && !is_null($phonetics)){
            return asset('/storage/uploads/phonetics/'.$phonetics);
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
