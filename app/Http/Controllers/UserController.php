<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function login(Request $req)
    {
        $username = $req->usern;
        $password = $req->pass;
    
        // Find the user by username
        $user = User::where('name', $username)->first();

        // Check if the user exists and the plain text password matches
        if ($user && $user->password === $password) {
            // Use Laravel's Auth facade to log the user in
            Auth::login($user);

            // Start a new session and store additional user data
            session()->regenerate();
            session([
                'userid' => $user->id,
                'user' => $user->name,
                'Name' => $user->name,
                'pfp' => $user->picture ?? null,
                'page_title' => $user->page_title,
                'role' => $user->role,
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
        $admins = DB::table('users')->where('role', 'admin')->get();
        $pharmacists = DB::table('users')->where('role', 'pharmacist')->get();

        return view('pharmacists.index', compact('admins', 'pharmacists'));
    }

    public function handleRegister(Request $req)
    {
        if ($req->password !== $req->cpassword) {
            return back()->with('msg', "Passwords don't match");
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
            'role' => 'pharmacist',
            'email' => $req->email ?? null,
            'created_at' => now(),
            'updated_at' => now(),
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
                ->where('role', 'pharmacist')
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
        return back()->with('success', 'User deleted successfully.');
    }

    /**
     * Show the form for editing the specified pharmacist.
     */
    public function editPharmacist($id)
    {
        $pharmacist = DB::table('users')->where('id', $id)->where('role', 'pharmacist')->first();

        if (!$pharmacist) {
            return back()->with('error', 'Pharmacist not found.');
        }

        return view('pharmacists.edit', compact('pharmacist'));
    }

    /**
     * Update the specified pharmacist in storage.
     */
    public function updatePharmacist(Request $req, $id)
    {
        $pharmacist = DB::table('users')->where('id', $id)->where('role', 'pharmacist')->first();

        if (!$pharmacist) {
            return back()->with('error', 'Pharmacist not found.');
        }

        $req->validate([
            'name' => 'required|string|max:255|unique:users,name,' . $id,
            'email' => 'nullable|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|min:8|confirmed',
            'page_title' => 'nullable|string|max:255',
        ]);

        $updateData = [
            'name' => $req->name,
            'email' => $req->email,
            'page_title' => $req->page_title,
            'updated_at' => now(),
        ];

        if ($req->filled('password')) {
            $updateData['password'] = $req->password;
        }

        DB::table('users')->where('id', $id)->update($updateData);

        return redirect()->route('admin.pharmacists.index')->with('success', 'Pharmacist updated successfully.');
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
