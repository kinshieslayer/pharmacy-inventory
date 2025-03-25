<aside class="w-64 bg-white border-r min-h-screen flex flex-col justify-between fixed md:static z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0" 
       :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

    {{-- Sidebar Top --}}
    <div>
        <aside class="w-64 bg-white border-r min-h-screen flex flex-col justify-between fixed md:static z-50 transform transition-transform duration-300 ease-in-out md:translate-x-0" 
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
 
     {{-- Sidebar Top --}}
     <div>
         <!-- Brand / Title with custom font -->
         <div class="px-6 py-4">
            <h1 class="text-xl font-semibold">{{ session('page_title', 'Default Pharmacy Title') }}</h1>
        </div>
 
         <!-- Navigation Links -->
         <nav class="flex flex-col space-y-1 px-4">
             <a href="{{ route('home') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                 <i class="fas fa-home mr-2 w-5 text-center"></i> Home
                 
             </a>
             <a href="{{ route('showAllDrugs') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                 <i class="fas fa-capsules mr-2 w-5 text-center"></i> Drugs
             </a>
             <a href="{{ route('showallPurchase') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                 <i class="fas fa-file-invoice mr-2 w-5 text-center"></i> Orders
             </a>
             <a href="{{ route('showProfile') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                 <i class="fas fa-user mr-2 w-5 text-center"></i> Profile
             </a>
         </nav>
     </div>
 
     {{-- Logout at the Bottom --}}
     <div class="px-4 py-4">
         <a href="{{ route('logout') }}" class="font-medium text-red-500 hover:text-red-700 transition-colors duration-200 flex items-center">
             <i class="fas fa-sign-out-alt mr-2 w-5 text-center"></i> Logout
         </a>
     </div>
 </aside>
         <!-- Navigation Links with improved typography -->
        <nav class="flex flex-col space-y-1 px-4">
            <a href="{{ route('home') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                <i class="fas fa-home mr-2 w-5 text-center"></i> Home
            </a>
            <a href="{{ route('showAllDrugs') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                <i class="fas fa-capsules mr-2 w-5 text-center"></i> Drugs
            </a>
            <a href="{{ route('showallPurchase') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                <i class="fas fa-file-invoice mr-2 w-5 text-center"></i> Orders
            </a>
            <a href="{{ route('showProfile') }}" class="sidebar-link font-medium text-gray-700 hover:text-blue-600 transition-colors duration-200">
                <i class="fas fa-user mr-2 w-5 text-center"></i> Profile
            </a>
        </nav>
    </div>

    {{-- Logout at the Bottom --}}
    <div class="px-4 py-4">
        <a href="{{ route('logout') }}" class="font-medium text-red-500 hover:text-red-700 transition-colors duration-200 flex items-center">
            <i class="fas fa-sign-out-alt mr-2 w-5 text-center"></i> Logout
        </a>
    </div>
</aside>