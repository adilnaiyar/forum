<?php

namespace App;

class Reply extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function discussion()
    {
        return $this->belongsTo('App\Discussion', 'discussion_id');
    }
}
