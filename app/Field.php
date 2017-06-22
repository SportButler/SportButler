<?php

namespace App;

class Field extends Model

{
    public function user(){
        return $this->belongsTo('App\User');
    }

    public function events(){
      return $this->hasMany(Event::class);
    }

    public function club(){
      return $this->belongsTo(Club::class);
    }

    public function sports(){
      return $this->belongsToMany(Sport::class);
    }
    public function hasSport($sport){
      return $this->sports()->where('sport_id', $sport->id)->exists();
    }

}
