<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Care Pharmacy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('style/General.css') }}">
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
    <link rel="stylesheet" href="{{ asset('style/table.css') }}">
</head>
<body>

<header>
    <nav class="navbar">
        <a href="{{ route('home') }}" class="logo">Care Pharmacy</a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>
            <li><a href="{{ route('showAllDrugs') }}">Drugs</a></li>
            <li><a href="{{ route('showallPurchase') }}">Orders</a></li>
            <li><a href="{{ route('showProfile') }}">Profile</a></li>
        </ul>
    </nav>
</header>

<main class="main-content">
    @yield('content')
</main>

</body>
</html>
