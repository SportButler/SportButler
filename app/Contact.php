<?php

namespace App;

class Contact extends Model
{
  public function sport(){
    return $this->belongsTo(Sport::class);
  }

  public function club(){
    return $this->belongsTo(Club::class);
  }
}
