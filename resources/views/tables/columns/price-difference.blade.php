@php
$style = '';
$modelPrice = $getRecord()->listingModel->model_price;
$listingPrice = $getRecord()->price;
$difference = $modelPrice - $listingPrice;

if(!empty($modelPrice)) {
    if($difference >= 0) {
        $style = 'padding:4px;border-radius:4px;color:#fff;background-color:#299840;font-weight:bold';
    } else if($difference < 0 && $difference > -25)  { 
        $style='padding:4px;border-radius:4px;color:#333;background-color:#c1ffbf;font-weight:bold' ; 
    } else if($difference <= -25 && $difference > -50) {
        $style = 'padding:4px;border-radius:4px;color:#fff;background-color:#777;font-weight:bold';
    } else {
        $style = 'padding:4px;border-radius:4px;color:#fff;background-color:#d0342c;font-weight:bold';
    }
}
@endphp

<div style="{{$style}}";>
    {{ $modelPrice ? $difference . '€' : '-' }}
</div>
