<?php

namespace App;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
class User extends \TCG\Voyager\Models\User
{
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
    use \Illuminate\Auth\Authenticatable;
    public function posts(){
        return $this->hasMany('App\Post','author_id');

    }
    public function likes(){
        return $this->hasMany('App\Like');

    }
    public function messages(){
        return $this->hasMany('App\Message');

    }


}
