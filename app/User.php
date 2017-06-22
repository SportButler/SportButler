<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

  /**
  * TODO: remove jokes and fields Relation
  */

  public function events(){
    return $this->belongsToMany(Event::class);
  }

  public function jokes(){
      return $this->hasMany('App\Joke');
  }

  public function fields(){
      return $this->hasMany('App\Field');
  }

  public function clubs(){
      return $this->belongsToMany(Club::class);
  }
  public function hasClubs($club){
    return $this->clubs()->where('club_id', $club->id)->exists();
  }

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
