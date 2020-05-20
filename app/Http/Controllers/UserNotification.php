<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserNotification extends Controller
{
    
    public function notifications()
    {
        auth()->user()->unreadNotifications->markasRead();

        //dd(auth()->user()->notifications->first->data['discussion']['slug']);
        return view('users.notifications', [
            'notifications' => auth()->user()->notifications
        ]);
    }
}
