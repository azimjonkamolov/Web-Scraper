<?php

// 5-custom-scraping-functions.php

    function curlGet($url) 
    {
        $ch = curl_init(); 

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
        curl_setopt($ch, CURLOPT_URL, $url);

        $results = curl_exec($ch);
        curl_close($ch); 

        return $results; 
    }

    function scrapeBetween($item, $start, $end)
    {
        if(($startPos = stripos($item, $start)) === false)
        {
            return false;
        }
        else if (($startPos + stripos($item, $end)) === false )
        {
            return false;
        }
        else
        {
            $substrStart = $startPos + strlen($start);

            return substr($item, $substrStart, $endPos - $substrStart);
        }
    }

    $page = curlGet('https://daryo.uz/');

    $analyticsId = scrapeBetween($page, '(["_setAccount", "',  '"])');

    echo $analyticsId;

?>
