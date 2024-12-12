<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Home;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    // to show data in index page

    public function view(){
        $categories = Category::all();
        $introduction = Home::where('role' , 'introduction')->first();
        $platform_detail = Home::where('role' , 'platform_details')->first();
        return view('index' , compact(['categories' ,'introduction' ,'platform_detail' ]));
    }

    public function index(){

        $categories = Category::all();
        $introduction = Home::where('role' , 'introduction')->first();
        $platform_detail = Home::where('role' , 'platform_details')->first();
        $unreadCount = Auth::user()->unreadNotifications()->count();

        return view('front.home' , compact(['categories' ,'introduction' ,'platform_detail','unreadCount']));
    }


}
