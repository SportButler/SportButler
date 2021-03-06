<?php

namespace App;

class Event extends Model
{
  public function users(){
    return $this->belongsToMany('App\User');
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
  public function hasField($field){
    return $this->field()->where('field_id', $field->id)->exists();
  }

}
