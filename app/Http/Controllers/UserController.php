<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $username = $req->usern;
        $password = $req->pass;
    
        // Check if the user exists with the provided credentials
        $user = DB::table('users')
            ->where('name', $username)
            ->where('password', $password)
            ->first();
    
        if ($user) {
            // Start a new session and store user data
            session()->regenerate();
            session([
                'userid' => $user->id,
                'user' => $user->name,
                'Name' => $user->name,
                'pfp' => $user->picture ?? null,
                'page_title' => $user->page_title,  // Store page_title in the session
            ]);
    
            // Redirect to the home page
            return redirect()->route('home');
        } else {
            // If credentials are wrong, redirect back with error
            return redirect()->route('slogin_param', ['param' => $username])
                ->with('error', 'Incorrect username or password.');
        }
    }
    
    public function showAllStaff()
    {
        $owners = DB::table('users')->where('type', 'owner')->get();
        $pharmacists = DB::table('users')->where('type', 'pharmacist')->get();

        return view('user_settings.staff', compact('owners', 'pharmacists'));
    }

    public function handleRegister(Request $req)
    {
        if ($req->password !== $req->cpassword) {
            return back()->with('msg', 'Passwords don’t match');
        }

        if (strlen($req->password) < 8) {
            return back()->with('msg', 'Password must be at least 8 characters');
        }

        $exists = DB::table('users')->where('name', $req->name)->exists();

        if ($exists) {
            return back()->with('msg', 'This name is already used. Please use a unique name.');
        }

        DB::table('users')->insert([
            'name' => $req->name,
            'password' => $req->password,
            'type' => 'pharmacist'
        ]);

        return redirect()->route('showAllStaff');
    }

    public function staffSearch(Request $req)
    {
        $name = $req->pharmacistName;

        if ($req->choice === 'name') {
            $pharmacists = DB::table('users')->where('name', $name)->get();
        } else {
            $pharmacists = DB::table('users')
                ->where('type', 'pharmacist')
                ->where('name', 'LIKE', "%$name%")
                ->get();
        }

        return back()->with('searchresult', 1)->with('pharmacists', $pharmacists);
    }
    public function showProfile()
{
    // Get the logged-in user from the session
    $user = DB::table('users')->where('id', session('userid'))->first();

    // Pass the user data to the view
    return view('user_settings.profile', ['user' => $user]);
}


    public function staffDelete(Request $req)
    {
        DB::table('users')->where('id', $req->id)->delete();
        return back();
    }
    public function updateTitle(Request $request)
    {
        // Get the logged-in user from session
        $user = DB::table('users')->where('id', session('userid'))->first();
    
        // Validate the input
        $request->validate([
            'page_title' => 'required|string|max:255',
        ]);
    
        // Update the page title
        DB::table('users')
            ->where('id', $user->id)
            ->update(['page_title' => $request->input('page_title')]);
    
        // Update the session variable (optional, for dynamic changes)
        session(['page_title' => $request->input('page_title')]);
    
        return back()->with('msg', 'Pharmacy title updated successfully!');
    }
    
}
