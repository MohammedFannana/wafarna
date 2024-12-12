<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    public function index(Request $request){

        
        // // Validate the request
        // $request->validate([
        //     'id' => ['required', 'exists:users,id'], // Ensures the ID is present and valid
        // ]);

        // Retrieve the user
        $user = Auth::guard('sanctum')->user();

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404); // Handle null user
        }

        // Retrieve unread notifications
        $notifications = $user->unreadNotifications()->latest()->paginate(6);
        $unreadNotificationsCount = $user->unreadNotifications()->count();

        return response()->json([
            'notifications' => $notifications,
            'unreadCount' => $unreadNotificationsCount,
        ], 200);


    }
}
