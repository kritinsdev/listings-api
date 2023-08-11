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
    @vite(['resources/css/main.css'])
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
        <h1>Latest listings</h1>
        <section class="listings">
            @foreach($listings as $listing)
            <div class="listing">
                <div class="model">
                    <div class="model-name">{{$listing->listingModel->model_name}}</div><span class="profit grey">+123E</span>
                </div>
                <p class="site detail-{{$listing->site}}">{{$listing->site}}.LV</p>
                <div class="detail">
                    @php
                    $date = \Carbon\Carbon::parse($listing->added);
                    $now = \Carbon\Carbon::now();

                    $diffInDays = $date->diffInDays($now);
                    $time = $date->format('H:i');

                    if ($diffInDays == 0) {
                    echo "Today at {$time}";
                    } elseif ($diffInDays == 1) {
                    echo "Yesterday at {$time}";
                    } else {
                    echo "{$diffInDays} days ago at {$time}";
                    }
                    @endphp
                </div>
                <a class="price" href="{{$listing->url}}" target="_blank">
                    {{$listing->price}}€
                </a>
            </div>
            @endforeach
        </section>
    </main>

</body>

</html>

