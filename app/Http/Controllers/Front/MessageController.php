<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    public function index(){
        
        $user = Auth::user();
        $notifications = $user->unreadNotifications()->latest()->paginate(6);
        $unreadCount = $user->unreadNotifications()->count();
        return view('front.notification' , compact(['notifications' ,'unreadCount']));
    }
}
