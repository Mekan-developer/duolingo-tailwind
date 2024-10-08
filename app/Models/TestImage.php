<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TestImage extends Model
{
    use HasFactory;

    
    protected $fillable = ['audio','correct_image','incorrect_image','chapter_id','lesson_id','exercise_id','status','order'];


    public function Exercise(){
        return $this->belongsTo(Exercise::class);
    }

    public function Lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function Chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function getAudio(){
        if(file_exists(public_path('/storage/uploads/test_audio_image/audio/'.$this->audio)) && !is_null($this->audio)){
            return asset('/storage/uploads/test_audio_image/audio/'.$this->audio);
        }else{
            return null;
        }
    }

    public function getCorrectImage(){
        if(file_exists(public_path('/storage/uploads/test_audio_image/image/'.$this->correct_image)) && !is_null($this->correct_image)){
            return asset('/storage/uploads/test_audio_image/image/'.$this->correct_image);
        }else{
            return null;
        }
    }

    public function getIncorrectImage(){
        if(file_exists(public_path('/storage/uploads/test_audio_image/image/'.$this->incorrect_image)) && !is_null($this->incorrect_image)){
            return asset('/storage/uploads/test_audio_image/image/'.$this->incorrect_image);
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
