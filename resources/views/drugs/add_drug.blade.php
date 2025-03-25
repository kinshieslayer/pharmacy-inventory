@extends('layout.app')

@section('content')
<div class="max-w-3xl mx-auto bg-white rounded-lg shadow-md p-8 mt-10">
    <h1 class="text-2xl font-bold mb-6 text-blue-600">Add a Medication</h1>

    @if (session('msg'))
        <div class="bg-green-100 text-green-700 px-4 py-2 rounded mb-4">
            {{ session('msg') }}
        </div>
    @endif

    @if ($errors->any())
        <div class="bg-red-100 text-red-600 px-4 py-2 rounded mb-4">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('handleAddDrug') }}" class="space-y-4">
        @csrf

        <div>
            <label for="name" class="block font-semibold text-gray-700 mb-1">Drug Name:</label>
            <input type="text" name="name" id="name" required class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div>
            <label for="description" class="block font-semibold text-gray-700 mb-1">Description:</label>
            <input type="text" name="description" id="description" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="quantity" class="block font-semibold text-gray-700 mb-1">Quantity:</label>
                <input type="number" name="quantity" id="quantity" required class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="price" class="block font-semibold text-gray-700 mb-1">Price:</label>
                <input type="number" name="price" id="price" required class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label for="expiry_date" class="block font-semibold text-gray-700 mb-1">Expiry Date:</label>
                <input type="date" name="expiry_date" id="expiry_date" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <label for="prescription_required" class="block font-semibold text-gray-700 mb-1">Prescription Required:</label>
                <select name="prescription_required" id="prescription_required" class="w-full border-gray-300 rounded-md shadow-sm px-4 py-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
            </div>
        </div>

        <div class="flex justify-between mt-6">
            <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">
                Add Drug
            </button>
            <a href="{{ route('showAllDrugs') }}" class="bg-gray-300 text-gray-700 px-6 py-2 rounded hover:bg-gray-400">
                View All Drugs
            </a>
        </div>
    </form>
</div>
@endsection
