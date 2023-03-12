<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Mockery\Generator\StringManipulation\Pass\Pass;

class UserController extends Controller
{
    //

    public function showProfile(User $user){

        return view('profile-posts',[
        'username'=>$user->username,
        'posts'=>$user->posts()->latest()->get(),
        'postsCount'=>$user->posts()->count()
        ]);
    }

    public function showCorrectHomepage(){
        if(auth()->check()){
            return view('homepage-feed');
        }else{
            return view('homepage');
        }
    }

    public function register(Request $request){
        $IncomingFiels=$request->validate([
            'username'=>['required','min:3','max:20', Rule::unique('users','username')],
            'email'=>['required','email',Rule::unique('users','email')],
            'password'=>['required','min:6','confirmed']
        ]);
        $IncomingFiels['password']=bcrypt($IncomingFiels['password']);
        $user=User::create($IncomingFiels);
        auth()->login($user);
        return redirect('/')->with('success','Account created successfully');
    }

    public function login(Request $request){
        $IncomingFiels=$request->validate([
            'loginusername'=>'required',
            'loginpassword'=>'required'
        ]);

        if(auth()->attempt(['username'=>$IncomingFiels['loginusername'],'password'=>$IncomingFiels['loginpassword']])){
             $request->session()->regenerate();
            return redirect('/')->with('success','You are now logged in');
        }else{
            return redirect('/')->with('danger','Invalid username or password');
        }
    }


    public function logout(){
        auth()->logout();
        return redirect('/')->with('success','You are now logged out');
    }



}
