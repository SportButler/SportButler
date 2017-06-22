<?php

namespace App;

class Event extends Model
{
  public function users(){
    return $this->belongsToMany(User::class);
  }

  public function field(){
    return $this->belongsTo(Field::class);
  }

  public function sport(){
    return $this->belongsTo(Sport::class);
  }

  public function club(){
    return $this->belongsTo(Club::class);
  }

}
