@extends('layout.app') {{-- Assuming you have a main layout file --}}

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-semibold mb-6">Edit Pharmacist: {{ $pharmacist->name }}</h1>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Success!</strong>
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Error!</strong>
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    @if($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <strong class="font-bold">Validation Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white p-6 rounded-lg shadow-md w-full max-w-md mx-auto">
        <form action="{{ route('admin.pharmacists.update', $pharmacist->id) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT') {{-- Use PUT method for updates --}}

            <div>
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Username:</label>
                <input type="text" name="name" id="name" value="{{ old('name', $pharmacist->name) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" required>
            </div>
            <div>
                <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email (Optional):</label>
                <input type="email" name="email" id="email" value="{{ old('email', $pharmacist->email) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="page_title" class="block text-gray-700 text-sm font-bold mb-2">Page Title (Optional):</label>
                <input type="text" name="page_title" id="page_title" value="{{ old('page_title', $pharmacist->page_title) }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="password" class="block text-gray-700 text-sm font-bold mb-2">New Password (Leave blank to keep current):</label>
                <input type="password" name="password" id="password" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div>
                <label for="password_confirmation" class="block text-gray-700 text-sm font-bold mb-2">Confirm New Password:</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 mb-3 leading-tight focus:outline-none focus:shadow-outline">
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Update Pharmacist
                </button>
                <a href="{{ route('admin.pharmacists.index') }}" class="inline-block align-baseline font-bold text-sm text-blue-500 hover:text-blue-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection 