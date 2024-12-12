<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Mail\ComplaintMail;
use App\Models\User;
use App\Notifications\ComplaintMailNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ComplaintController extends Controller
{
    public function sendMail(Request $request){

        $validated = $request->validate([
            'name' => ['string', 'required'],
            'email' => ['email', 'required'],
            'complaint' => ['required', 'string']
        ]);
        
        // Get the admin email (retrieve the email as a string)
        $admin = User::where('role', 'admin')->first();

        // Mail::to($admin_email)->send(new ComplaintMail($validated));
        
        $admin->notify(new ComplaintMailNotification($validated));


        // Redirect back after sending the email
        return Redirect::back();
        

    }
}
