<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
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
                <li>
                    <a href="{{ route('logout') }}">Logout</a>
                </li>

                <div id="statistics">Stats</div>
            </ul>

        </nav>
    </header>
    <main>
        <section class="filters">
            <select name="category" id="category">
                <option value="1">Phones</option>
                <option value="2">Game Consoles</option>
                <option value="0">All Listings</option>
            </select>
            <select name="models" id="models"></select>
            <div class="filter-btn" id="best-profit">Potential profit</div>
        </section>

        <!-- <section class="stats">
            <div id="current-model">Current model: <span>Not Selected</span></div>
            <div id="current-model-avg-price"></div>
            <div id="current-model-lowest-price"></div>
        </section> -->

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
