@extends('layout.app') {{-- Use the same layout as your purchases/profile pages --}}

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="bg-white shadow-md rounded-xl p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Update Drug</h1>

        <form method="POST" action="{{ route('handleUpdateDrug', ['id' => $drug->id]) }}" class="space-y-6">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700">Drug Name</label>
                <input type="text" name="name" id="name" value="{{ $drug->name }}" required
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-green-500 focus:border-green-500" />
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                <input type="text" name="description" id="description" value="{{ $drug->description }}"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-green-500 focus:border-green-500" />
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                    <input type="number" name="quantity" id="quantity" value="{{ $drug->quantity }}" required
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-green-500 focus:border-green-500" />
                </div>

                <div>
                    <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
                    <input type="number" name="price" id="price" value="{{ $drug->price }}" required
                           class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-green-500 focus:border-green-500" />
                </div>
            </div>

            <div>
                <label for="expiry_date" class="block text-sm font-medium text-gray-700">Expiry Date</label>
                <input type="date" name="expiry_date" id="expiry_date" value="{{ $drug->expiry_date }}"
                       class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-green-500 focus:border-green-500" />
            </div>

            <div>
                <label for="prescription_required" class="block text-sm font-medium text-gray-700">Prescription Required</label>
                <select name="prescription_required" id="prescription_required"
                        class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-green-500 focus:border-green-500">
                    <option value="1" {{ $drug->prescription_required ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ !$drug->prescription_required ? 'selected' : '' }}>No</option>
                </select>
            </div>

            <div class="pt-4">
                <button type="submit"
                        class="w-full bg-green-500 text-white font-semibold py-2 rounded-lg shadow hover:bg-green-600 transition duration-200">
                    Update Drug
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
