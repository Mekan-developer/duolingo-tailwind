<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Lesson extends Model
{
    use HasFactory,HasTranslations;

    protected $fillable = ['title','chapter_id','order','dopamine_image1','dopamine_image2','dopamine_image3','dopamine_image4'];
    public $translatable = ['title'];

    public function listExercise()
    {
        return $this->hasMany(List_exercise::class);
    }


    public function chapter(){
        return $this->belongsTo(Chapter::class);
    }

    public function getDopamine($image){
        if(file_exists(public_path('/storage/uploads/dopamine_images/'.$image)) && !is_null($image)){
            return asset('/storage/uploads/dopamine_images/'.$image);
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
