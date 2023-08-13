<div class="listing">
    <div class="model">
        <div class="model-name">{{$listing->listingModel->model_name}}</div>
        <span class="profit grey">
        {{$listing->listingModel->model_price - $listing->price}}
        </span>
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
