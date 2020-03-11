<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\ProfileUpdated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Auth\RedirectsUsers;

class ProfileController extends Controller
{
    public function Profile(Request $req){

        $user = Auth::user();

        return view('user.profile', compact('user'));


    }

    public function UpdateProfile(Request $req) {

        $validatedData = request()->validate([
            'name' => 'required',
            'email' => 'required|email',
            'photo' => 'image',
            'password' => 'confirmed',
        ]);

        $user = Auth::user();

        $user->name = $req->name;
        $user->email = $req->email;

        if ($req->filled('password')){
        $user->password = \Hash::make($req->password);
      
        }

        
        if($req->has('photo')){

            $path = explode('/', $req->file('photo')->store('public/profile_directory'));
            unset($path[0]);
            $publicPath = "storage/" . implode('/',$path);
            $user->photo_path = $publicPath;
        }

        $user->save();

        Mail::to($user)->send(new ProfileUpdated());

        return redirect()->back()->with('status', 'Succesfully saved');
    }

}
