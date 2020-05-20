<?php

namespace App;

use App\User;
use App\Reply;
use App\Notifications\MarkAsBestReply;

class Discussion extends Model
{
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function replies()
    {
        return $this->hasMany(Reply::class, 'discussion_id');
    }

    public function getBestReply()
    {
        return Reply::find($this->reply_id);
    }

    public function bestReply()
    {
        return $this->belongsTo(Reply::class, 'reply_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function markAsBestReply(Reply $replies)
    {
        $this->update([
            'reply_id' => $replies->id,
        ]);

        if($replies->user->id ===  $this->user->id)
        {
            return; 
        }

        $this->user->notify(new MarkAsBestReply($replies->discussion));
    }

    public function scopeFilterByChannel($builder)
    {
        if(request()->query('channel')) {

            //filter

            $channel = Channel::where('slug', request()->query('channel'))->first();

            if($channel)
            {
                return $builder->where('channel_id', $channel->id);
            }

            return $builder;
        }

        return $builder;
    }
   
}
