<aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'" class="fixed md:static z-50 w-64 bg-white border-r min-h-screen flex flex-col justify-between transform md:translate-x-0 transition-transform duration-300 ease-in-out shadow-sm">

    <!-- Sidebar Top -->
    <div>
        <!-- Brand -->
        <div class="text-2xl font-semibold px-6 py-4 text-gray-800">
            <h1 class="text-xl font-semibold">{{ session('page_title', 'Default Pharmacy Title') }}</h1>
        </div>

        <!-- Navigation Links -->
        <nav class="flex flex-col space-y-4 px-4">
            <a href="{{ route('home') }}" class="sidebar-link text-gray-600 flex items-center p-3 rounded-md hover:bg-gray-100">
                <i class="fas fa-home mr-3 text-xl"></i> Home
            </a>
            <a href="{{ route('showAllDrugs') }}" class="sidebar-link text-gray-600 flex items-center p-3 rounded-md hover:bg-gray-100">
                <i class="fas fa-capsules mr-3 text-xl"></i> Drugs
            </a>
            <a href="{{ route('showallPurchase') }}" class="sidebar-link text-gray-600 flex items-center p-3 rounded-md hover:bg-gray-100">
                <i class="fas fa-file-invoice mr-3 text-xl"></i> Orders
            </a>
            <a href="{{ route('showProfile') }}" class="sidebar-link text-gray-600 flex items-center p-3 rounded-md hover:bg-gray-100">
                <i class="fas fa-user mr-3 text-xl"></i> Profile
            </a>
        </nav>
    </div>

    <!-- Logout at the Bottom -->
    <div class="px-6 py-4 border-t border-gray-200 mt-auto">
        <a href="{{ route('logout') }}" class="text-red-500 hover:text-red-400 flex items-center p-3 rounded-md border-2 border-transparent hover:bg-gray-100">
            <i class="fas fa-sign-out-alt mr-3 text-xl"></i> Logout
        </a>
    </div>
</aside>
