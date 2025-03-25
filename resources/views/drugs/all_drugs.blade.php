@extends('layout.app')

@section('content')
    <div class="container p-6 space-y-6 fade-in">
        <div class="flex flex-col space-y-1">
            <h2 class="text-3xl font-extrabold tracking-tight text-gray-900">Medications</h2>
            <p class="text-gray-600 font-medium">
                Manage your pharmacy's medication inventory
            </p>
        </div>

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <!-- Search Form - Restored Original Functionality with Modern Design -->
            <form action="{{ route('DrugsSearch') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                <div class="relative">
                    <svg class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input 
                        type="text" 
                        name="id" 
                        placeholder="medication ID" 
                        class="pl-8 w-full border border-gray-300 rounded-md h-10 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('id') }}"
                    >
                </div>
                <div class="relative">
                    <svg class="absolute left-2.5 top-2.5 h-4 w-4 text-gray-500" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="medication Name" 
                        class="pl-8 w-full border border-gray-300 rounded-md h-10 px-3 py-2 font-medium text-gray-800 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                        value="{{ request('name') }}"
                    >
                </div>
                <div class="flex items-center gap-2">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md font-semibold h-10">
                        Search
                    </button>
                    <a href="{{ route('showAllDrugs') }}" class="bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-md font-semibold h-10 flex items-center">
                        Clear
                    </a>
                </div>
            </form>

            <div class="flex items-center gap-2 w-full sm:w-auto">
                <a href="{{ route('showAddDrug') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-md inline-flex items-center gap-2 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                    </svg>
                    Add Medication
                </a>
                <a href="{{ route('exportDrugsCsv') }}" class="bg-white hover:bg-gray-100 text-gray-800 border border-gray-300 px-4 py-2 rounded-md inline-flex items-center gap-2 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1M12 12v8m0 0l-3-3m3 3l3-3M4 4h16v4H4V4z" />
                    </svg>
                    Export CSV
                </a>
            </div>
        </div>

        <div class="bg-white shadow-sm rounded-lg overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">ID</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Name</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">
                                Price
                                <a href="{{ route('showAllDrugs', ['sort' => 'price_asc']) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-sort-up"></i>
                                </a>
                                <a href="{{ route('showAllDrugs', ['sort' => 'price_desc']) }}" class="text-blue-500 hover:text-blue-700">
                                    <i class="fas fa-sort-down"></i>
                                </a>
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Expiry Date</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Prescription</th>
                            <th class="px-6 py-3 text-left text-xs font-bold text-gray-700 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($drugs as $drug)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $drug->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-800">{{ $drug->name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $drug->description }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $drug->quantity }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold text-gray-900">{{ $drug->price }} DH</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">{{ $drug->expiry_date }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold {{ $drug->prescription_required ? 'text-red-600' : 'text-green-600' }}">
                                    {{ $drug->prescription_required ? 'Yes' : 'No' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-700">
                                    <div class="flex items-center gap-3">
                                        <a href="{{ route('showUpdateDrug', $drug->id) }}" class="text-blue-600 hover:text-blue-900" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('deleteDrug', $drug->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900" title="Delete">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                                                                
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection