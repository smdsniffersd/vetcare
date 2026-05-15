<?php


require_once __DIR__ . '/../config.php';


$subscribes = AllFetch('select * from subscribes');
$subscribes_options = AllFetch('select * from subscribes_options');

$optionsByPriceId = [];

foreach ($subscribes_options as $option) {
    $priceID = $option['price_id'];
    if (!isset($optionsByPriceId[$priceID])) {
        $optionsByPriceId[$priceID] = [];
    }
    $optionsByPriceId[$priceID][] = $option;
}
foreach ($subscribes as &$subscribe) {
    $subscribeID = $subscribe['id'];
    $subscribe['options'] = $optionsByPriceId[$subscribeID] ?? [];
}
unset($subscribe);
?>