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
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit">Logout</button>
            </form>
        </div>
    </header>
    <main>
        {{-- <section class="listings">
            @foreach($listings as $listing)  
                <x-listing-item :listing="$listing" />
            @endforeach
        </section> --}}

     <div class="table-wrap">
            <div class="table">
                <div class="row header">
                    <div class="cell">
                        Model
                    </div>
                    {{-- <div class="cell">
                        Site
                    </div> --}}
                    <div class="cell">
                        Added
                    </div>
                    <div class="cell">
                        Price
                    </div>
                    <div class="cell">
                        Profit Margin
                    </div>
                    <div class="cell">
                        Options
                    </div>
                </div>

                @foreach ($listings as $listing)
                     <x-listing-item :listing="$listing" />
                @endforeach
            </div>
        </div>
    </main>
</body>

</html>

