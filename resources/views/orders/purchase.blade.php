@extends('layout.app')

@section('content')
<div class="p-6 bg-gray-100 min-h-screen">
    <div class="bg-white shadow-md rounded-xl p-6 max-w-3xl mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">New Purchase</h1>

        @if (session('error'))
            <div class="mb-4 p-3 bg-red-100 text-red-800 rounded-md">
                {{ session('error') }}
            </div>
        @endif

        <form method="POST" action="{{ route('handlePurchase') }}" class="space-y-6">
            @csrf

            <div>
                <label for="costumer_name" class="block text-sm font-medium text-gray-700">Customer Name</label>
                <input type="text" name="costumer_name" id="costumer_name" value="{{ old('costumer_name') }}"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                <input type="text" name="phone" id="phone" value="{{ old('phone') }}"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div>
                <label for="product" class="block text-sm font-medium text-gray-700">Drug</label>
                <select name="product" id="product"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                    <option value="">Select a drug</option>
                    @foreach ($products as $prod)
                        <option value="{{ $prod->id }}" {{ old('product') == $prod->id ? 'selected' : '' }}>
                            {{ $prod->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="quantity" class="block text-sm font-medium text-gray-700">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="{{ old('quantity') }}"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
            </div>

            <div class="pt-4 flex gap-4">
                <button type="submit"
                    class="w-full bg-blue-600 text-white font-semibold py-2 rounded-lg shadow hover:bg-blue-700 transition duration-200">
                    Make Purchase
                </button>

                <a href="{{ route('showallPurchase') }}"
                   class="w-full text-center bg-gray-300 text-gray-800 font-semibold py-2 rounded-lg shadow hover:bg-gray-400 transition duration-200">
                    All Purchases
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
