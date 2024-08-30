<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spelling extends Model
{
    use HasFactory;

    protected $fillable = ['en_text','image','chapter_id','lesson_id','exercise_id','status','order'];


    public function Exercise(){
        return $this->belongsTo(List_exercise::class);
    }

    public function Lesson(){
        return $this->belongsTo(Lesson::class);
    }

    public function Chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function getImage(){
        if(file_exists(public_path('/storage/uploads/spelling/'.$this->image)) && !is_null($this->image)){
            return asset('/storage/uploads/spelling/'.$this->image);
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
