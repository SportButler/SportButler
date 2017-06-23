<?php

namespace App;

class Club extends Model
{
  public function users(){
    return $this->belongsToMany('App\User');
  }
  public function hasUser($user){
    return $this->users()->where('user_id', $user->id)->exists();
  }

  public function contacts(){
    return $this->hasMany(Contact::class);
  }

  public function sports(){
    return $this->hasMany(Sport::class);
  }

  public function fields(){
    return $this->hasMany(Field::class);
  }

  public function events(){
    return $this->hasMany(Event::class);
  }
}
