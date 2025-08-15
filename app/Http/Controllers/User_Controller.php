<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Notification;

use App\Notifications\UserMail;
use App\Jobs\UserQueue;

// use App\Notifications\UserMail;
// use Illuminate\Support\Facades\Notification;
// use App\Notifications\TestNotification;

class User_Controller extends Controller
{
   

    function signin_function(Request $request){
        $signin_data=$request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|confirmed',
        ]);
        if($signin_data){
            $user=User::create($signin_data);

            // for($i=0; $i<=4; $i++){
            // $user->notify(new UserMail());

            // }

            $user->notify(new UserMail());

            
            // UserQueue::dispatch($user);

            // Notification::route('mail', $request->email)
            //     ->notify(new UserMail(
            //         $request->subject,
            //         $request->message
            //     ));
             
          
            
            return redirect()->back()->with('alert','succesful' );
        }
        else{
            return redirect()->back()->with('alert','not_succesful' );
        }
        
    }

    function login_function(Request $request){
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required',
        ]);
        if(Auth::attempt( $credentials)){
            return redirect()->route('home');
        }
        else{
            return redirect()->back()->with('alert','not_succesful' );
        }

    }
    

    function home_function(){
        if(Auth::check()){
        return view('home_page');

        }
        else{
        return redirect('login');
        }
    }


    function logout_function(){
        Auth::logout();
        return redirect('login');
    }

}
