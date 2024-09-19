<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Information extends Model
{
    use HasFactory,HasTranslations;

    protected $fillable = [
        "lessons","exercises",'part',"information","active"
    ];

    public $translatable = ["information"];


}
