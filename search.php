<?php

    $baseurl = "http://new.sunyconnect.suny.edu:4430/F";
    $uri = $_SERVER['REQUEST_URI'];
    $url = "$baseurl/$uri";
    
    function scrape_page($url)
    {
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_HEADER, true);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 120);
        curl_setopt ($ch, CURLOPT_TIMEOUT, 120);
        curl_setopt ($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt ($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt ($ch, CURLOPT_AUTOREFERER, true);
        $results = curl_exec($ch);
        curl_close($ch);
        return $results;
    }
    
    $searchresults = scrape_page($url);
    echo $searchresults;
?>
