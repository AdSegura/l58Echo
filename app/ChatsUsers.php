<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ChatsUsers extends Pivot
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'chat_id'
    ];
}
