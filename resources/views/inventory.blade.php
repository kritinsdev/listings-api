<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Listings</title>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Yanone+Kaffeesatz:wght@300;400;700&display=swap"
    rel="stylesheet">
    @vite(['resources/css/main.css'])
</head>

<body>
  <header>
    <nav>
      <ul>
        <li>
          <a href="/">Listings</a>
        </li>
        <li>
          <a href="/inventory.html">Inventory</a>
        </li>
      </ul>
    </nav>
  </header>
  <main>
    <div class="table-wrap">
      <div class="table">

        <div class="row header">
          <div class="cell">
            Listing ID
          </div> 
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
            Date Sold
          </div>          
          <div class="cell">
            Sold For
          </div>
        </div>
  
        <div class="row">
          <div class="cell" data-title="Listing id">
            1
          </div>
          <div class="cell" data-title="Product">
            iPhone 11
          </div>
          <div class="cell" data-title="Bought For">
            150€
          </div>
          <div class="cell" data-title="Date Bought">
            24/07/2023
          </div>
          <div class="cell" data-title="Sold For">
            -
          </div>
          <div class="cell" data-title="Date Sold">
            -
          </div>
        </div>

        <div class="row">
          <div class="cell" data-title="Listing id">
            1
          </div>
          <div class="cell" data-title="Product">
            iPhone 11
          </div>
          <div class="cell" data-title="Bought For">
            180€
          </div>
          <div class="cell" data-title="Date Bought">
            27/07/2023
          </div>
          <div class="cell" data-title="Sold For">
            -
          </div>
          <div class="cell" data-title="Date Sold">
            -
          </div>
        </div>

        <div class="row">
          <div class="cell" data-title="Listing id">
            1
          </div>
          <div class="cell" data-title="Product">
            iPhone 12
          </div>
          <div class="cell" data-title="Bought For">
            250€
          </div>
          <div class="cell" data-title="Date Bought">
            28/07/2023
          </div>
          <div class="cell" data-title="Sold For">
            -
          </div>
          <div class="cell" data-title="Date Sold">
            -
          </div>
        </div>
      </div>
    </div>
    

    <!-- <div class="loader">
        <div class="loader-content">
            <div class="lds-ellipsis"><div></div><div></div><div></div><div></div></div>
        </div>
    </div> -->
</body>

</html>