@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
    <h1 class="text-xl font-semibold mb-4">Reset Password</h1>

    <form method="POST" action="{{ route('password.update') }}">
        @csrf

        <input type="hidden" name="token" value="{{ $token }}">

        <label class="block mb-2 text-sm">Email</label>
        <input type="email" name="email" class="w-full border px-3 py-2 rounded mb-4" required autofocus>

        <label class="block mb-2 text-sm">New Password</label>
        <input type="password" name="password" class="w-full border px-3 py-2 rounded mb-4" required>

        <label class="block mb-2 text-sm">Confirm Password</label>
        <input type="password" name="password_confirmation" class="w-full border px-3 py-2 rounded mb-4" required>

        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">
            Reset Password
        </button>
    </form>
</div>
@endsection
