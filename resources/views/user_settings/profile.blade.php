@extends('layout.app')

@section('content')
<div class="max-w-6xl mx-auto px-6 py-8">
    <!-- Flash messages -->
    @if (session('msg'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('msg') }}
        </div>
    @endif
    @if (session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- Profile Card -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden mb-8">
        <div class="bg-blue-100 p-6 flex justify-between items-start">
            <div class="flex items-center space-x-4">
                @php
                    $pfpPath = public_path('imgs/AppData/staff/' . session('pfp'));
                    $hasCustomPfp = session('pfp') && file_exists($pfpPath);
                @endphp
                
                <img src="{{ $hasCustomPfp ? asset('imgs/AppData/staff/' . session('pfp')) : asset('imgs/AppData/staff/user-default.png') }}"
                    alt="Profile Picture" class="w-20 h-20 rounded-full object-cover border">
                <div>
                    <h2 class="text-xl font-semibold">{{ session('Name') }}</h2>
                    <p class="text-sm text-gray-600">{{ session('user') }}</p>
                </div>
            </div>
            <form action="{{ route('deleteImg') }}" method="POST">
                @csrf
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white text-sm px-4 py-2 rounded shadow">
                    Remove Picture
                </button>
            </form>
        </div>
        <div class="p-6 grid md:grid-cols-2 gap-6">
            <!-- About Me -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">About Me</h3>
                <p class="text-sm text-gray-600">
                    Experienced pharmacist committed to ensuring quality service and reliable medication assistance.
                </p>
            </div>
            <!-- Account Settings -->
            <div>
                <h3 class="font-semibold text-gray-700 mb-2">Account Settings</h3>
                <div class="flex space-x-3">
                    <a href="#updatePassword" class="bg-gray-200 text-sm px-4 py-2 rounded hover:bg-gray-300">Change Password</a>
                    <a href="#updateUsername" class="bg-gray-200 text-sm px-4 py-2 rounded hover:bg-gray-300">Change Username</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Forms Section -->
    <div class="grid md:grid-cols-3 gap-8">
        <!-- Update Profile -->
        <form method="POST" action="{{ route('updateProfile') }}" enctype="multipart/form-data" class="bg-white p-6 shadow rounded-md">
            @csrf
            <input type="hidden" name="type" value="personal">
            <h3 class="text-lg font-semibold mb-4">Update Profile</h3>
            <label class="block text-sm mb-1">Full Name:</label>
            <input type="text" name="name" value="{{ session('Name') }}" required class="w-full mb-3 px-4 py-2 border rounded">

            <label class="block text-sm mb-1">Profile Image:</label>
            <input type="file" name="image" class="w-full mb-3 text-sm">

            <label class="block text-sm mb-1">Your Password:</label>
            <input type="password" name="password" required class="w-full mb-4 px-4 py-2 border rounded">

            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Save</button>
        </form>

        <form method="POST" action="{{ route('updateUsername') }}" class="bg-white p-6 shadow rounded-md" id="updateUsername">
            @csrf
            <h3 class="text-lg font-semibold mb-4">Change Username</h3>
            <label class="block text-sm mb-1">New Username:</label>
            <input type="text" name="username" value="{{ session('user') }}" required class="w-full mb-3 px-4 py-2 border rounded">
        
            <label class="block text-sm mb-1">Current Password:</label>
            <input type="password" name="password" required class="w-full mb-4 px-4 py-2 border rounded">
        
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Username</button>
        </form>

        <!-- Change Password -->
        <form method="POST" action="{{ route('updatePassword') }}" class="bg-white p-6 shadow rounded-md" id="updatePassword">
            @csrf
            <input type="hidden" name="type" value="password"> <!-- This keeps track of the password update -->
            <h3 class="text-lg font-semibold mb-4">Change Password</h3>
        
            <label class="block text-sm mb-1">New Password:</label>
            <input type="password" name="newpass" required class="w-full mb-3 px-4 py-2 border rounded">
        
            <label class="block text-sm mb-1">Confirm Password:</label>
            <input type="password" name="cpass" required class="w-full mb-3 px-4 py-2 border rounded">
        
            <label class="block text-sm mb-1">Current Password:</label>
            <input type="password" name="password" required class="w-full mb-4 px-4 py-2 border rounded">
        
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Change Password</button>
        </form>
                            
    <!-- Change Pharmacy Title Form -->
    <form method="POST" action="{{ route('updateTitle') }}" class="bg-white p-6 shadow rounded-md">
        @csrf
        <input type="hidden" name="type" value="title">
        <h3 class="text-lg font-semibold mb-4">Change Pharmacy Title</h3>
        
        <label class="block text-sm mb-1">New Pharmacy Title:</label>
        <input type="text" name="page_title" value="{{ session('page_title') }}" required class="w-full mb-3 px-4 py-2 border rounded">
        
        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update Title</button>
    </form>

</div>
<p class="text-center text-xs text-gray-400 mt-10">&copy; 2025 Care Pharmacy. All rights reserved.</p>

@endsection
