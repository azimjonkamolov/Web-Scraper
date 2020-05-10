<?php

// 7-xpath-scraping.php

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

    $packtBook = array(); 
    
    function returnXPathObject($item) 
    {
        $xmlPageDom = new DomDocument(); 
        @$xmlPageDom->loadHTML($item);
        $xmlPageXPath = new DOMXPath($xmlPageDom); 
        return $xmlPageXPath; 
    }

    $packtPage = curlGet('https://daryo.uz/2020/05/10/bollivudning-30-dan-oshgan-boshi-ochiq-aktrisalari-foto/'); 
    $packtPageXpath = returnXPathObject($packtPage); 

    $urlimage = $packtPageXpath->query('//img/@src');
    if ($urlimage->length > 0)
    {

        for($i = 0; $i < $urlimage->length; $i++)
        {

           $links[] = $packtBook['urlimage'][] = $urlimage->item($i)->nodeValue ;
            
        }

    }

    $urllink = $packtPageXpath->query('//a');
    if ($urllink->length > 0)
    {

        for($i = 0; $i < $urllink->length; $i++)
        {

           $links[] = $packtBook['urllink'][] = $urllink->item($i)->nodeValue ;
            
        }

    }


    echo "<h1> IMAGE URLS ARE HERE </h1>";
    echo "<br>";

    for($n = 0; $n < $i; $n++)
    {
        if (1)
        {
            // $link = $links[$n] = "https://daryo.uz" . $links[$n];
            $link = $links[$n];
            echo "<a href='$link'>" . $link . "</a>";
        }
        else
        {
            $link =  $links[$n];

            // $link = substr($link, 2);

            // $link = "https://" . $link;

            echo "<a href='$link'>" . $link . "</a>";

        }
            echo "<br>";
    }

    echo "<h1> SITE URLS ARE HERE </h1>";
    echo "<br>";

    for($n = 0; $n < $i; $n++)
    {
        if ($links[$n][0] == '/' && $links[$n][1] != '/')
        {
            $link = $links[$n] = "https://daryo.uz" . $links[$n];
            echo "<a href='$link'>" . $link . "</a>";
        }
        else
        {
            $link =  $links[$n];

            // $link = substr($link, 2);

            // $link = "https://" . $link;

            echo "<a href='$link'>" . $link . "</a>";

        }
            echo "<br>";
    }

    // print_r($packtBook);

?>