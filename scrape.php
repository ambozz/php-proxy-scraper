<?php

$filename = "proxies-" . date('Y-m-d-H-i-s', time()) . ".txt";
$sources = file_get_contents("sources.txt");

// Credit: https://stackoverflow.com/questions/1483497/how-can-i-put-strings-in-an-array-split-by-new-line
$sources_array = preg_split("/\r\n|\n|\r/", $sources);

foreach($sources_array as $source){
    scrape(file_get_contents($source), $filename);
}

function scrape($list, $output){
    $splitlist = explode("\n", $list);
    foreach($splitlist as $proxy){
        $string = $proxy;
        // Credit: https://stackoverflow.com/questions/11637555/regular-expressions-for-proxy-pattern
        $pattern = '/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b:\d{2,5}/';
        if (preg_match($pattern, $string, $match) ) {
            file_put_contents($output, $match[0] . "\n", FILE_APPEND | LOCK_EX);
        }
    }
}

?>