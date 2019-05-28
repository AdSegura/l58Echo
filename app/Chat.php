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
}
