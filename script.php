<?php
$zip = 64078;
$data = get_data("http://weather.yahooapis.com/forecastrss?p=" . $zip ."&u=f");

$weather_class = format_result(get_match('/<yweather:condition  text="(.*)"/isU',$data));

echo '<pre style="background:#fff;font-size:12px;">['; print_r($weather_class); echo ']</pre>';

function format_result($input) {
	return strtolower(str_replace(array(' ', '(', ')'), array('-', '-', ''), $input));
}

function get_match($regex,$content) {
	preg_match($regex,$content,$matches);
	return $matches[1];
}

function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch,CURLOPT_URL,$url);
	curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
	curl_setopt($ch,CURLOPT_CONNECTTIMEOUT,$timeout);
	$xml = curl_exec($ch);
	curl_close($ch);
	return $xml;
}

?>