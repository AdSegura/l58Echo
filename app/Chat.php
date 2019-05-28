<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];

    public function users()
    {
        return $this->belongsToMany('App\User', "chatsUser");
    }

    public function messages()
    {
        return $this->hasMany('App\ChatMessages');
    }

    public function isUserAllow(User $user)
    {
        $allowed = $this->users()->get();

        return $allowed->contains('id',$user->id);
    }

    /**
     * Allow $user to enter the Chat Room
     */
    public function allow(User $user)
    {
        return $this->users()->attach($user);
    }

    /**
     * Dissallow $user from Chat Room
     */
    public function notAllow(User $user)
    {
        return $this->users()->detach($user);
    }
}

