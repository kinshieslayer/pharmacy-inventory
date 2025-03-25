@extends('layout.app')

@section('content')
<!-- Header -->
<div class="flex flex-col sm:flex-row sm:items-center sm:justify-between mb-6">
    <div>
        <h1 class="text-3xl font-bold text-gray-900">Welcome:</h1><h1 class="text-3xl font-bold text-blue-900">{{ session('Name') }}!</h1>
        <p class="text-lg text-gray-600 italic mt-3 bg-yellow-100 p-4 rounded-lg shadow-md">
            "{{ strip_tags($randomQuote ?? 'Stay healthy, stay strong.') }}"
        </p>

    </div>
    <div class="flex gap-2 mt-4 sm:mt-0">
        <a href="{{ route('showAddDrug') }}" class="inline-flex items-center gap-2 bg-blue-600 text-white px-4 py-2 rounded-md text-sm font-medium hover:bg-blue-700 shadow-sm transition">
            <i class="fas fa-plus"></i> Add Medications
        </a>
        <a href="{{ route('showPurchase') }}" class="inline-flex items-center gap-2 border border-gray-300 text-gray-700 px-4 py-2 rounded-md text-sm font-medium hover:bg-yellow-200 transition">
            <i class="fas fa-credit-card"></i> Make Purchase
        </a>
    </div>
</div>

<!-- Dashboard Metrics with Hover Effects -->
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 mb-6">
    <!-- Purchases -->
    <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 hover:-translate-y-1">
        <div class="p-3 bg-blue-100 rounded-full">
            <i class="fas fa-cash-register text-blue-600 text-lg"></i>
        </div>
        <div>
            <div class="text-sm text-gray-500">Recent Purchases</div>
            <div class="text-2xl font-bold text-gray-900">{{ $recentPurchases }}</div>
        </div>
    </div>

    <!-- Inventory -->
    <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 hover:-translate-y-1">
        <div class="p-3 bg-green-100 rounded-full">
            <i class="fas fa-boxes text-green-600 text-lg"></i>
        </div>
        <div>
            <div class="text-sm text-gray-500">Inventory Items</div>
            <div class="text-2xl font-bold text-gray-900">{{ $inventoryItems }}</div>
        </div>
    </div>

    <!-- Total Revenue -->
    <div class="bg-white rounded-lg shadow p-5 flex items-center gap-4 hover:shadow-md transition-all duration-200 hover:-translate-y-1">
        <div class="p-3 bg-yellow-100 rounded-full">
            <i class="fas fa-coins text-yellow-600 text-lg"></i>
        </div>
        <div>
            <div class="text-sm text-gray-500">Total Revenue</div>
            <div class="text-2xl font-bold text-gray-900">{{ number_format($totalRevenue, 2) }} DH</div>
        </div>
    </div>
</div>

<!-- Chart Section -->
<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
    <!-- Total per customer pie/bar chart -->
    <div class="bg-white p-6 rounded-md shadow">
        <h2 class="text-lg font-semibold mb-4">Top Customers by Spending</h2>
        <canvas id="customerSpendingChart" height="100"></canvas>
    </div>

    <!-- Top Drugs Chart -->
    <div class="bg-white p-6 rounded-md shadow">
        <h2 class="text-lg font-semibold mb-4">Top medications by Quantity</h2>
        <canvas id="topDrugsChart" height="100"></canvas>
    </div>
</div>

<!-- Chart.js Script -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Top Drugs Chart
    const topDrugsCtx = document.getElementById('topDrugsChart').getContext('2d');
    new Chart(topDrugsCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($topDrugs->pluck('name')) !!},
            datasets: [{
                label: 'Stock',
                data: {!! json_encode($topDrugs->pluck('quantity')) !!},
                backgroundColor: '#3B82F6',
                borderRadius: 8,
                barThickness: 40
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        color: '#6B7280'
                    },
                    grid: {
                        color: '#E5E7EB'
                    }
                },
                x: {
                    ticks: {
                        color: '#6B7280'
                    },
                    grid: {
                        display: false
                    }
                }
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: '#1F2937',
                    titleColor: '#fff',
                    bodyColor: '#E5E7EB',
                    padding: 10,
                    cornerRadius: 8
                }
            }
        }
    });

    // Customer Spending Chart
    const customerCtx = document.getElementById('customerSpendingChart').getContext('2d');
    new Chart(customerCtx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($totalPerCustomer->pluck('customer_name')) !!},
            datasets: [{
                label: 'Total Spent (DH)',
                data: {!! json_encode($totalPerCustomer->pluck('total_spent')) !!},
                backgroundColor: 'rgba(16, 185, 129, 0.6)', // greenish
                borderRadius: 6
            }]
        },
        options: {
            responsive: true,
            scales: {
                y: {
                    beginAtZero: true
                }
            },
            plugins: {
                legend: {
                    display: false
                }
            }
        }
    });
</script>
<!-- Recent Sales -->
<div class="bg-white p-6 rounded-md shadow mb-6">
    <h2 class="text-lg font-semibold mb-4">Recently Sold Medications</h2>
    <ul class="divide-y divide-gray-200">
        @forelse ($recentSales as $sale)
            <li class="py-3 flex justify-between items-center">
                <div>
                    <p class="font-medium text-gray-800">{{ $sale->drug_name }}</p>
                    <p class="text-sm text-gray-500">Sold to {{ $sale->customer_name }} — Quantity: {{ $sale->quantity }}</p>
                </div>
                <span class="text-sm text-gray-400">{{ \Carbon\Carbon::parse($sale->created_at)->diffForHumans() }}</span>
            </li>
        @empty
            <li class="text-gray-500">No recent sales found.</li>
        @endforelse
    </ul>
</div>

@endsection