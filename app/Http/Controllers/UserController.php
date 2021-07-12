<?php

namespace App\Http\Controllers;

use App\Mail\ContactRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'profile_img'=>'profile_img.png',
            'password' => bcrypt($request->password)
        ]);

         if(auth()->attempt(['email'=>$request->email,'password'=>$request->password])){
             $token = $user->createToken('programming')->accessToken;
             return response()->json(['token' => $token], 200);


         }


    }

    /**
     * Handles Login Request
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (auth()->attempt($credentials)) {
            $token = auth()->user()->createToken('programming')->accessToken;
            return response()->json(['token' => $token], 200);
        } else {
            return response()->json(['error' => 'UnAuthorised'], 401);
        }
    }
    public function details()
    {
        return response()->json(['user' => auth()->user()], 200);
    }

    public function getUnreadNotifications(){
        $notifications=Auth::user()->unreadNotifications;
        return response()->json($notifications);
    }
    public function getAllNotifications(){
        $notifications=Auth::user()->notifications;
        return response()->json($notifications);
    }
    public function markNotificationAsRead(Request $request){
        $notification = Auth::user()->notifications()->where('id',$request->id)->first();
        $notification->markAsRead();
        return response()->json([
            'msg'=>'ok',
            'notification'=>$notification

        ]);
    }


    public function sendEmail(Request $request){
        $details=[
            'subject'=>$request->subject,
            'message'=>$request->message
        ];
         Mail::to("mygoogle@gmail.com")->send(new ContactRequest($details));

           return response()->json([
               'msg'=>'ok'
           ]);


    }
}
