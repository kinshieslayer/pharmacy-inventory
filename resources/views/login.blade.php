<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Care Pharmacy Login</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- FontAwesome (Optional for icons) -->
    <script src="https://kit.fontawesome.com/07afcb6ca3.js" crossorigin="anonymous"></script>

    <!-- Custom styles (if needed) -->
    <link rel="stylesheet" href="{{ asset('style/login.css') }}">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">

    <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-blue-100 p-3 rounded-full mb-2">
                <i class="fas fa-lock text-blue-600 text-xl"></i>
            </div>
            <h2 class="text-xl font-semibold">Welcome Back</h2>
            <p class="text-gray-500 text-sm mt-1">Enter your credentials to sign in to your account</p>
        </div>

        @if(session('error'))
            <div class="text-red-600 text-sm mb-3">
                {!! session('error') !!}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}" class="space-y-4">
            @csrf

            <div>
                <label for="usern" class="sr-only">Username</label>
                <input type="text" name="usern" id="usern" value="{{ $username ?? '' }}" placeholder="Username"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div>
                <label for="pass" class="sr-only">Password</label>
                <input type="password" name="pass" id="pass" placeholder="Password"
                    class="w-full border border-gray-300 px-4 py-2 rounded-md focus:outline-none focus:ring focus:border-blue-400">
            </div>

            <div class="flex justify-end">
                <a href="{{ route('password.request') }}" class="text-sm text-blue-500 hover:underline">
                    Forgot your password?
                </a>                            </div>

            <button type="submit"
                class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition">
                Sign In
            </button>
        </form>

        <p class="text-center text-sm text-gray-600 mt-6">
            Don’t have an account?
            <a href="#" class="text-blue-600 hover:underline">Sign up</a>
        </p>
    </div>


</body>
</html>
