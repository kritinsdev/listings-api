<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@300;400;700&display=swap" rel="stylesheet">
    @vite(['resources/css/main.css', 'resources/css/app.css'])
</head>

<body>
    <header>
        <nav>
            <ul>
                <li>
                    <a href="{{ route('home') }}">Listings</a>
                </li>
                <li>
                    <a href="{{ route('statistics') }}">Statistics</a>
                </li>
                <li>
                    <a href="{{ route('inventory') }}">Inventory</a>
                </li>
            </ul>
        </nav>
        <div>
            <form method="POST" action="{{ route('logout') }}" style="display:flex; height:100%;">
                @csrf
                <button class="text-blue-950 bg-white py-1 px-2" type="submit">Logout</button>
            </form>
        </div>
    </header>
    <main class="flex flex-col md:flex-row md:gap-8 justify-center text-lg">
        <table class="my-4 md:my-0 w-full md:w-60">
            <caption class="font-bold text-xl">iPhone Battery Change Prices</caption>
            <tr>
                <th class="text-left">Model Name</th>
                <th class="text-left">Price (€)</th>
            </tr>
            <tr>
                <td>iPhone 7</td>
                <td>46.70</td>
            </tr>
            <tr>
                <td>iPhone 7 Plus</td>
                <td>48.00</td>
            </tr>
            <tr>
                <td>iPhone 8</td>
                <td>47.00</td>
            </tr>

            <tr>
                <td>iPhone 8 Plus</td>
                <td>47.50</td>
            </tr>
            <tr>
                <td>iPhone X</td>
                <td>53.00</td>
            </tr>
            <tr>
                <td>iPhone XR</td>
                <td>51.00</td>
            </tr>
            <tr>
                <td>iPhone XS</td>
                <td>55.15</td>
            </tr>
            <tr>
                <td>iPhone XS Max</td>
                <td>53.15</td>
            </tr>
            <tr>
                <td>iPhone 11</td>
                <td>52.50</td>
            </tr>
            <tr>
                <td>iPhone 11 Pro</td>
                <td>57.00</td>
            </tr>
            <tr>
                <td>iPhone 11 Pro Max</td>
                <td>56.80</td>
            </tr>
            <tr>
                <td>iPhone 12</td>
                <td>55.80</td>
            </tr>
            <tr>
                <td>iPhone 12 Mini</td>
                <td>54.00</td>
            </tr>
            <tr>
                <td>iPhone 12 Pro</td>
                <td>53.30</td>
            </tr>

            <tr>
                <td>iPhone 12 Pro Max</td>
                <td>54.00</td>
            </tr>

            <tr>
                <td>iPhone 13</td>
                <td>56.00</td>
            </tr>
            <tr>
                <td>iPhone 13 Mini</td>
                <td>54.20</td>
            </tr>
            <tr>
                <td>iPhone 13 Pro</td>
                <td>57.00</td>
            </tr>
            <tr>
                <td>iPhone 13 Pro Max</td>
                <td>57.00</td>
            </tr>
        </table>
        <table class="my-4 md:my-0 w-full md:w-60">
            <caption class="font-bold text-xl">iPhone Screen Change Prices</caption>
            <tr>
                <th class="text-left">Model Name</th>
                <th class="text-left">Price (€)</th>
            </tr>
            <tr>
                <td>iPhone 7</td>
                <td>57.50</td>
            </tr>
            <tr>
                <td>iPhone 7 Plus</td>
                <td>63.50</td>
            </tr>
            <tr>
                <td>iPhone 8</td>
                <td>58.30</td>
            </tr>

            <tr>
                <td>iPhone 8 Plus</td>
                <td>64.00</td>
            </tr>
            <tr>
                <td>iPhone X</td>
                <td>73.00</td>
            </tr>
            <tr>
                <td>iPhone XR</td>
                <td>75.95</td>
            </tr>
            <tr>
                <td>iPhone XS</td>
                <td>72.80</td>
            </tr>
            <tr>
                <td>iPhone XS Max</td>
                <td>92.10</td>
            </tr>
            <tr>
                <td>iPhone 11</td>
                <td>73.00</td>
            </tr>
            <tr>
                <td>iPhone 11 Pro</td>
                <td>85.00</td>
            </tr>
            <tr>
                <td>iPhone 11 Pro Max</td>
                <td>90.00</td>
            </tr>
            <tr>
                <td>iPhone 12</td>
                <td>89.45</td>
            </tr>
            <tr>
                <td>iPhone 12 Mini</td>
                <td>109.45</td>
            </tr>
            <tr>
                <td>iPhone 12 Pro</td>
                <td>91.95</td>
            </tr>

            <tr>
                <td>iPhone 12 Pro Max</td>
                <td>132.90</td>
            </tr>
            <tr>
                <td>iPhone 13</td>
                <td>136.00</td>
            </tr>
            <tr>
                <td>iPhone 13 Mini</td>
                <td>209.85</td>
            </tr>
            <tr>
                <td>iPhone 13 Pro</td>
                <td>423.50</td>
            </tr>
            <tr>
                <td>iPhone 13 Pro Max</td>
                <td>405</td>
            </tr>
        </table>
</body>

</html>

