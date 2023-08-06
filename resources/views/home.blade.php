<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@300;400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/main.css', 'resources/js/app.js'])
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Listings</a>
                </li>
                <li>
                    <a href="{{ route('inventory') }}">Inventory</a>
                </li>
            </ul>
        </nav>
        <div>
            <form method="POST" action="{{ route('logout') }}" style="display:flex; height:100%;">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>
    <main>
        <section class="filters">
            <div class="avg-prices" id="avg-prices">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M14.25 7.756a4.5 4.5 0 100 8.488M7.5 10.5h5.25m-5.25 3h5.25M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <select name="site" id="site">
                <option value>All Sites</option>
                <option value="andelemandele">Andelemandele.lv</option>
                <option value="ss">SS.LV</option>
            </select>
            {{-- <select name="category" id="category">
                <option value="0">All Listings</option>
                <option value="1">Phones</option>
                <option value="2">Game Consoles</option>
            </select> --}}
            <select name="models" id="models"></select>
            
            <div data-filter="profit" data-direction="asc">Potential profit <span data-direction-arrow></span></div>
        </section>
        <div id="statistics"></div>
        
        <section class="listings"></section>
    </main>

    <div class="loader">
        <div class="loader-content">
            <div class="lds-ellipsis">
                <div></div>
                <div></div>
                <div></div>
                <div></div>
            </div>
        </div>
    </div>
</body>

</html>

