@extends('layout.app')

@section('content')
<div class="max-w-md mx-auto bg-white p-6 rounded shadow mt-10">
    <h1 class="text-xl font-semibold mb-4">Forgot Password</h1>

    @if (session('status'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <label class="block mb-2 text-sm">Email address</label>
        <input type="email" name="email" class="w-full border px-3 py-2 rounded mb-4" required autofocus>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Send Reset Link
        </button>
    </form>
</div>
@endsection
