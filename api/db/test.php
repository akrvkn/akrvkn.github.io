<?php

$ship_desc = json_decode(file_get_contents('data/38/description.json'));

$find = '«Созвездия»';
		    $clean_desc = str_replace($find, '', $ship_desc);
		    echo $clean_desc;
			file_put_contents('description.json', json_encode($clean_desc));
