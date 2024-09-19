<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'type_id', 'order','image','audio'
    ];




    public function getImage(){
        if(file_exists(public_path('/storage/uploads/exercises/dephomine/'.$this->image)) && !is_null($this->image)){
            return asset('storage/uploads/exercises/dephomine/'.$this->image);
        }else{
            return null;
        }
    }

    public function getAudio(){
        if(file_exists(public_path('/storage/uploads/exercises/audio/'.$this->audio)) && !is_null($this->audio)){
            return asset('storage/uploads/exercises/audio/'.$this->audio);
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
