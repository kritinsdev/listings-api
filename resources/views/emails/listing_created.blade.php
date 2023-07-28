<!DOCTYPE html>
<html>
    <body>
        <p style="font-weight:bold;font-size:18px;">New listing was added!</p>
        <p>Model: {{ $model_name }}</p>
        <p>Price: {{ $listing->price }}€</p>
        <a href={{$listing->url}}>LINK TO LISTING</a>
    </body>
</html>
