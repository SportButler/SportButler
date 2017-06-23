<?php

namespace App;

class Sport extends Model
{
  public function contacts(){
    return $this->hasMany(Contact::class);
  }

  public $table = "sports";

  public function club(){
    return $this->belongsTo(Club::class);
  }

  public function events(){
    return $this->hasMany(Event::class);
  }

  public function fields(){
    return $this->belongsToMany(Field::class);
  }
}
