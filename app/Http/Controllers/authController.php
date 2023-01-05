<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Role;
use App\Models\User;
use App\Models\Verify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Password;

class authController extends Controller
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:8|max:50|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);
        $data['role_id'] = Role::where('name','user')->first()->id;

        $createUser = User::create($data);
        $token = Str::random(64);
        Verify::create([
            'user_id' => $createUser->id, 
            'token' => $token
        ]);
  
        Mail::send('verify', ['token' => $token], function($message) use($request){
              $message->to($request->email);
              $message->subject('Email Verification Mail');
        });

        Auth::login($createUser);
        $this->logout();
        return redirect(url('/login'))->with('verify','we send message to your mail , please verify it');
        
    }

    public function verifyAccount($token)
    {
        $verifyUser = Verify::where('token', $token)->first();
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){ 
            $user = $verifyUser->user;
              
            if(!$user->is_verify) {
                $verifyUser->user->is_verify = 1;
                $verifyUser->user->save();
                return redirect(url('login'))->with('message','your email was verified');
            } else {
                return redirect(url('login'))->with('message','Your e-mail is already verified. You can now login.');
            }
        }
  
      //return redirect(url('login'))->with('message','your email was verified');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:8|max:30',
        ]);

        $islogin = Auth::attempt(['email' => $data['email'] , 'password' => $data['password']]);

        if(! $islogin)
        {
            return back()->withErrors([
                'not correct'
            ]);
        }
        return redirect(url('/dashboard')); 
    }

    public function logout()
    {
        Auth::logout();
        return redirect(url('/index'));  
    }


    /* reset pass */

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status',__($status))
            :back()->withwithInput($request->only('email'))
                ->withErrors(['email' => ($status)]);
    }

    public function resetView()
    {
        return view('resetPass.resetView');
    }

    public function updatePass(Request $request)
    {
        $data=$request->validate([
            'email' =>'required',
            'password' => 'required|min:8|max:50|confirmed',
        ]);
        $pass = bcrypt($data['password']);
        User::where('email', $data['email'])->update(array('password' =>$pass));

        return redirect(url('/index'));
 
    }
    
    // ????
    public function resetAccount($token)
    {
        $verifyUser = Verify::where('token', $token)->first();
        $token = $verifyUser['token'];
  
        $message = 'Sorry your email cannot be identified.';
  
        if(!is_null($verifyUser) ){
            return redirect(url('formreset/'.$token))->with('message', $message); 
        }
      return redirect(url('login'))->with('message', $message);
    }
}
