<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table='questions';
    protected $guarded=[];

    public function topics(){
       return $this->belongsToMany(Topic::class)->withTimestamps();
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function answer(){
        return $this->hasMany(Answer::class);
    }
}
