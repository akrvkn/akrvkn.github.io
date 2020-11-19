<?php
$mtf_ships_url = 'https://api.mosturflot.ru/v3/rivercruises/ships?filter[is-own]=1';

$mtf_ships_list = json_decode(file_get_contents($mtf_ships_url));

$mtf_names = [];
$table = [];


foreach($mtf_ships_list->data as $key=>$mtf_ship){
$mtf_names[$mtf_ship->id] = $mtf_ship->attributes->name;
}


$filterMtf = '&filter[ship-id][in][]=5&filter[ship-id][in][]=14&filter[ship-id][in][]=19&filter[ship-id][in][]=36&filter[ship-id][in][]=72&filter[ship-id][in][]=91&filter[ship-id][in][]=92&filter[ship-id][in][]=139&filter[ship-id][in][]=150&filter[ship-id][in][]=198&filter[ship-id][in][]=200&filter[ship-id][in][]=206&filter[ship-id][in][]=207&filter[ship-id][in][]=247';

$mtf_cruises = json_decode(file_get_contents('https://api.mosturflot.ru/v3/rivercruises/tours?filter[start][gte]='.date("Y-m-d").'T00:00:00Z'.$filterMtf.'&per-page=1000'), true);
//echo 'https://api.mosturflot.ru/v3/rivercruises/tours?filter[start][gte]='.date("Y-m-d").'T00:00:00Z'.$filterMtf.'&per-page=1000';
$counter = 0;

foreach($mtf_cruises['data'] as $key=>$val){
    $table[$counter]['company'] = 'mtf';
    $table[$counter]['shipid'] = $val['attributes']['ship-id'];
    $table[$counter]['shipname'] = $mtf_names[$val['attributes']['ship-id']];
    $table[$counter]['tourid'] = $val['id'];
    $table[$counter]['tourstart'] = $val['attributes']['start'];
    $table[$counter]['tourfinish'] = $val['attributes']['finish'];
    $table[$counter]['tourroute'] = $val['attributes']['route'];
    $table[$counter]['tourdays'] = $val['attributes']['days'];
    $table[$counter]['tourminprice'] = $val['attributes']['price-from'];
    $table[$counter]['tourcabinsfree'] = rand( 17, 76);

    $counter++;
}

var_dump($table);
