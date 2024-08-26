<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $fillable = ['locale','name','native','flag','status','order'];


    public function getFlag(){
        if(file_exists(public_path('/storage/uploads/lang_icons/'.$this->flag)) && !is_null($this->flag)){
            return asset('/storage/uploads/lang_icons/'.$this->flag);
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
