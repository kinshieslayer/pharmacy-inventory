<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingsController extends Controller
{
    public function showProfile()
    {
        return view('user_settings.profile');
    }

    private function isPasswordValid($enteredPassword, $id)
    {
        $user = DB::table('users')->where('id', $id)->first();
        return $user && $user->password === $enteredPassword;  // Comparing plain text password
    }

    private function updateSessionData($user)
    {
        session()->regenerate();
        session([
            'userid' => $user->id,
            'user' => $user->name,
            'Name' => $user->name,
            'pfp' => $user->picture,
        ]);
    }

    public function deleteImg()
    {
        DB::table('users')->where('id', session('userid'))->update(['picture' => null]);
        $user = DB::table('users')->where('id', session('userid'))->first();
        $this->updateSessionData($user);
        return back()->with('msg', 'Image removed successfully!');
    }

    private function handleImage($userId, $image)
    {
        if (!$image) return;

        $ext = $image->getClientOriginalExtension();
        $allowed = ['jpg', 'jpeg', 'png', 'webp', 'bmp'];
        if (!in_array($ext, $allowed)) {
            return back()->with('error', 'Invalid image format');
        }

        $filename = "{$userId}_" . time() . "." . $ext;
        $path = public_path("imgs/AppData/staff");

        if (!file_exists($path)) mkdir($path, 0755, true);

        foreach (glob("$path/{$userId}_*") as $file) {
            unlink($file);
        }

        $image->move($path, $filename);
        DB::table('users')->where('id', $userId)->update(['picture' => $filename]);
        session(['pfp' => $filename]);
    }

    public function handleProfileUpdate(Request $request)
    {
        $userId = session('userid');
    
        if (!$this->isPasswordValid($request->password, $userId)) {
            return back()->with('error', 'Incorrect password');
        }
    
        $updateData = [];
    
        if ($request->filled('name')) {
            $updateData['name'] = $request->name;
            session(['Name' => $request->name, 'user' => $request->name]);
        }
    
        if ($request->hasFile('image')) {
            $this->handleImage($userId, $request->file('image'));
        }
    
        if (!empty($updateData)) {
            DB::table('users')
                ->where('id', $userId)
                ->update($updateData);
        }
    
        $user = DB::table('users')->where('id', $userId)->first();
        $this->updateSessionData($user);
    
        return back()->with('msg', 'Profile updated successfully');
    }    public function updateTitle(Request $request)
    {
        $userId = session('userid');  
        
        $request->validate([
            'page_title' => 'required|string|max:255',
        ]);
        
        DB::table('users')
            ->where('id', $userId)
            ->update(['page_title' => $request->input('page_title')]);
        
            session(['page_title' => $request->input('page_title')]);
        
        return redirect()->back()->with('msg', 'Pharmacy title updated successfully!');
        // ^^ Use redirect() instead of back() to force full page refresh
    }        
    public function handlePasswordUpdate(Request $request)
    {
        $userId = session('userid');
    
        // Check if the current password is valid
        if (!$this->isPasswordValid($request->password, $userId)) {
            return back()->with('error', 'Incorrect current password');
        }
    
        // Validate the new password and confirm password match
        if ($request->newpass !== $request->cpass) {
            return back()->with('error', 'Passwords do not match');
        }
    
        // Only update the password, without modifying other fields like name
        DB::table('users')->where('id', $userId)->update(['password' => $request->newpass]);
    
        return back()->with('msg', 'Password updated successfully');
        
    }
    public function handleUsernameUpdate(Request $request)
{
    $userId = session('userid');

    // 1. Verify current password
    if (!$this->isPasswordValid($request->password, $userId)) {
        return back()->with('error', 'Incorrect password');
    }

    // 2. Validate new username
    $request->validate([
        'username' => 'required|string|max:255|unique:users,name,'.$userId
    ]);

    $newUsername = $request->username;

    // 3. Update username
    DB::table('users')
        ->where('id', $userId)
        ->update(['name' => $newUsername]);

    // 4. Update session
    session([
        'user' => $newUsername,
        'Name' => $newUsername
    ]);

    return back()->with('msg', 'Username updated successfully');
}
                    }    