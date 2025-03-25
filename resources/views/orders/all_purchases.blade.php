@extends('layout.app')

@section('content')
<div class="container p-6 space-y-6 fade-in">
    <div class="flex flex-col space-y-2">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900">All Purchases</h2>
        <p class="text-gray-600 font-medium">
            Manage your pharmacy's purchase records
        </p>
    </div>

    <!-- Search & Export Form - Original functionality with new styling -->
    <div class="bg-white p-6 rounded-lg shadow mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <!-- Export Button -->
            <a href="{{ route('exportPurchasesCsv') }}"
               class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded shadow inline-flex items-center gap-2 w-full md:w-auto justify-center font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24"
                     stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                     d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v8m0 0l-3-3m3 3l3-3M4 4h16v4H4V4z"/>
                </svg>
                Export to CSV
            </a>
            <a href="{{ route('showPurchase') }}" class="inline-flex items-center gap-2 border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-100 transition">
                <i class="fas fa-credit-card"></i> Make Purchase
            </a>
    

            <!-- Search Inputs - Original fields with new styling -->
            <form method="GET" action="{{ route('PurchaseSearch') }}" class="flex flex-col md:flex-row gap-4 w-full">
                <div class="relative">
                    <input type="text" name="id" placeholder="ID" 
                           class="border border-gray-300 rounded-md h-10 px-4 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full">
                </div>
                <div class="relative">
                    <input type="text" name="customer_name" placeholder="Customer Name" 
                           class="border border-gray-300 rounded-md h-10 px-4 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full">
                </div>
                <div class="relative">
                    <input type="text" name="phone" placeholder="Phone Number" 
                           class="border border-gray-300 rounded-md h-10 px-4 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-full">
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold h-10">
                    Search
                </button>
                <a href="{{ route('showallPurchase') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-semibold h-10 flex items-center justify-center">
                    Clear
                </a>
            </form>
        </div>
    </div>

    <!-- Purchase Table - Original data with new styling -->
    <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
        <div class="p-4">
            <h2 class="text-lg font-semibold text-gray-800">Purchase List</h2>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Customer Name</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Phone</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">medications</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Quantity</th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                            Total Price
                            <!-- Sorting Icons -->
                            <a href="{{ route('showallPurchase', ['sort' => 'asc', 'order' => 'total_price']) }}" class="text-blue-500 hover:text-blue-700"">
                                <i class="fas fa-sort-up"></i>
                            </a>
                            <a href="{{ route('showallPurchase', ['sort' => 'desc', 'order' => 'total_price']) }}" class="text-blue-500 hover:text-blue-700"">
                                <i class="fas fa-sort-down"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach ($purchases as $purchase)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $purchase->id }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $purchase->customer_name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $purchase->phone_number }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $purchase->drug->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $purchase->quantity }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ number_format($purchase->total_price, 2) }} DH</td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                <form method="POST" action="{{ route('deletePurchase', ['purchaseId' => $purchase->id, 'prodId' => $purchase->product_id]) }}" class="inline">
                                    @csrf
                                    <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-md text-sm font-semibold">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection