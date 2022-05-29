<?php

function scrape($list, $output){
    $splitlist = explode("\n", $list);
    foreach($splitlist as $proxy){
        $string = $proxy;
        $pattern = '/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\b:\d{2,5}/';
        if (preg_match($pattern, $string, $match) ) {
            file_put_contents($output, $match[0] . "\n", FILE_APPEND | LOCK_EX);
        }
    }
}

?>