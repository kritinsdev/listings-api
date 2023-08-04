<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
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
        <div class="table-wrap">
            <div class="table">
                <div class="row header">
                    <div class="cell">
                        Model
                    </div>
                    <div class="cell">
                        Bought For
                    </div>
                    <div class="cell">
                        Date Bought
                    </div>
                    <div class="cell">
                        Sold For
                    </div>
                    <div class="cell">
                        Date Sold
                    </div>
                    <div class="cell">
                        Profit
                    </div>
                    <div class="cell">
                        IMEI
                    </div>
                </div>

                @foreach ($inventories as $inventory)
                <div class="row">
                    <div class="cell" data-title="Product">
                        {{ $inventory->model }}
                    </div>
                    <div class="cell" data-title="Bought For">
                        {{ $inventory->bought_for }}€
                    </div>
                    <div class="cell" data-title="Date Bought">
                        {{ $inventory->date_bought }}
                    </div>
                    <div class="cell" data-title="Sold For">
                        {{ $inventory->sold_for ? $inventory->sold_for.'€' : '-' }}
                    </div>
                    <div class="cell" data-title="Date Sold">
                        {{ $inventory->date_sold ?? '-' }}
                    </div>
                    <div class="cell" data-title="Profit">
                        {{ $inventory->profit ? $inventory->profit.'€' : '-' }}
                    </div>
                    <div class="cell" data-title="IMEI">
                        {{ $inventory->imei ?? '-' }}
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <div class="table-wrap">
            <div class="summary">
                <div>Total spent: {{ $totalSpent }}€</div>
                <div>Total sold: {{ $totalSold }}€</div>
                <div>Total profit: {{ $totalProfit }}€</div>
            </div>
        </div>

</body>

</html>

