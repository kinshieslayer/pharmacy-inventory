@include('config.functions')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon" href="{{ asset('imgs/logo.png') }}" type="image/x-icon">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Dynamic Page Title --}}
    <h1 class="text-xl font-semibold">{{ session('page_title', 'Default Pharmacy Title') }}</h1>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="{{ asset('style/all.min.css') }}">

    {{-- CSS --}}
    <link rel="stylesheet" href="{{ asset('style/General.css') }}">
    <link rel="stylesheet" href="{{ asset('style/style.css') }}">
</head>
<body>

  <header>
    <div class="container">
        <div class="header-box">
            <a href="{{ route('logout') }}">
                <button type="button">Log out</button>
            </a>

            <section class="logo">
                <a href="{{ route('home') }}" class="sys">
                    <div class="sys-logo"></div>
                    <div class="sys-name"><span>Care</span> Pharmacy</div>
                </a>
            </section>

            <section class="search">
                <form action="{{ route('DrugsSearch') }}">
                    <input placeholder="Enter a drug name" type="search" name="headSearch" value="{{ request('headSearch') }}">
                </form>
            </section>

            <!-- Add Profile Picture here -->
            <section class="profile">
                <div class="pfp-box">
                    <img 
                        src="{{ session('pfp') ? asset('imgs/AppData/staff/' . session('pfp')) : asset('imgs/user-default.png') }}" 
                        alt="Profile Picture" 
                        class="pfp-img"
                    >
                </div>
                <span class="username">{{ session('Name') }}</span>  <!-- Show user name -->
            </section>

        </div>
    </div>
</header>

@include('subviews.navbar')
