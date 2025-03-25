<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: false }" class="h-full bg-gray-100">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Care Pharmacy</title>
        <!-- FontFabric - Be Vietnam Font (or another FontFabric font) -->
        <link href="https://fonts.googleapis.com/css2?family=Be+Vietnam:wght@400;600&display=swap" rel="stylesheet">
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Alpine.js for toggle logic -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- FontAwesome Icons -->
    <script src="https://kit.fontawesome.com/07afcb6ca3.js" crossorigin="anonymous"></script>

    <!-- Tailwind Custom Styles -->
    <style>
        .sidebar-link:hover {
            background-color: #bfdbfe; /* Blue hover background */
            transform: translateX(5px); /* Small animation */
            transition: 0.3s;
        }
    </style>
</head>

<body class="min-h-screen flex flex-col md:flex-row" x-data="{ sidebarOpen: false }">

    <!-- Mobile Top Navbar -->
    <header class="md:hidden bg-white shadow p-4 flex items-center justify-between">
        <span class="font-bold text-lg text-gray-800">Care Pharmacy</span>
        <button @click="sidebarOpen = !sidebarOpen">
            <i class="fas fa-bars text-xl"></i>
        </button>
    </header>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed md:static z-50 w-64 bg-white border-r min-h-screen flex flex-col justify-between transform md:translate-x-0 transition-transform duration-300 ease-in-out shadow-sm">
        
        <!-- Sidebar Top -->
        <div>
            <div class="px-6 py-4 flex items-center space-x-4">
                <!-- FontAwesome Icon (Logo) -->
                <i class="fas fa-pills text-green-500 text-3xl"></i>
            
                <!-- Title with FontFabric Font -->
                <h1 class="text-3xl font-semibold text-green-700 hover:text-green-600 transition-all duration-300" style="font-family: 'Be Vietnam', sans-serif;">
                    {{ session('page_title', 'Default Pharmacy Title') }}
                </h1>
            </div>
                                    <!-- Navigation Links -->
            <nav class="flex flex-col space-y-4 px-4">
                <a href="{{ route('home') }}" class="sidebar-link text-gray-800 flex items-center p-3 rounded-md hover:bg-blue-100">
                    <i class="fas fa-home mr-3 text-xl"></i> Home
                </a>
                <a href="{{ route('showAllDrugs') }}" class="sidebar-link text-gray-800 flex items-center p-3 rounded-md hover:bg-blue-100">
                    <i class="fas fa-capsules mr-3 text-xl"></i> Medication
                </a>
                <a href="{{ route('showallPurchase') }}" class="sidebar-link text-gray-800 flex items-center p-3 rounded-md hover:bg-blue-100">
                    <i class="fas fa-file-invoice mr-3 text-xl"></i> Orders
                </a>
                <a href="{{ route('showProfile') }}" class="sidebar-link text-gray-800 flex items-center p-3 rounded-md hover:bg-blue-100">
                    <i class="fas fa-user mr-3 text-xl"></i> Profile
                </a>
            </nav>
        </div>

        <!-- Logout at the Bottom -->
        <div class="px-6 py-4 border-t border-gray-200 mt-auto">
            <a href="{{ route('logout') }}" class="text-red-500 hover:text-red-400 flex items-center p-3 rounded-md border-2 border-transparent hover:bg-blue-100">
                <i class="fas fa-sign-out-alt mr-3 text-xl"></i> Logout
            </a>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6 transition-all duration-300">
        @yield('content')
    </main>

</body>
</html>
