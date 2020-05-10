<?php

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

    function getImgUrl($url)
    {
        $packtPage = curlGet($url); 
        $packtPageXpath = returnXPathObject($packtPage); 

        $urlimage = $packtPageXpath->query('//img/@src');
        if ($urlimage->length > 0)
        {

            for($i = 0; $i < $urlimage->length; $i++)
            {

            $links[] = $packtBook['urlimage'][] = $urlimage->item($i)->nodeValue ;
                
            }

        }

        // echo "<h1> IMAGE URLS ARE HERE </h1>";
        // echo "<br>";

        echo  "<h1> " . $i . " image urls are found  </h1><br>";

        for($n = 0; $n < $i; $n++)
        {

            

            if ($links[$n][0] == '/' && $links[$n][1] != '/')
            {
                $link = $links[$n] = $url.$links[$n];
                echo "<a href='$link'>" . $link . "</a>";
            }
            else if ($links[$n][0] == 'h' && $links[$n][1] == 't')
            {
                $link =  $links[$n];

                echo "<a href='$link'>" . $link . "</a>";
            }
            else if ($links[$n][0] == '#')
            {
                continue;
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
    }

    

    // echo "<h1> SITE URLS ARE HERE </h1>";
    // echo "<br>";

    

    function getSiteUrl($url)
    {

        

        $packtPage = curlGet($url); 
        $packtPageXpath = returnXPathObject($packtPage);
        $urllink = $packtPageXpath->query('//a/@href');
        if ($urllink->length > 0)
        {
    
            for($t = 0; $t < $urllink->length; $t++)
            {
    
               $sitelinks[] = $packtBook['urllink'][] = $urllink->item($t)->nodeValue ;
                
            }
    
        }
    
        echo  "<h1> " . $t . " site urls are found  </h1><br>";

        for($n = 0; $n < $t; $n++)
        {
    
            if ($sitelinks[$n][0] == '/')
            {
                $link = $sitelinks[$n] = $url.$sitelinks[$n];
                echo "<a href='$link'>" . $link . "</a>";
            }
            else if ($sitelinks[$n][0] == 'h' && $sitelinks[$n][1] == 't')
            {
                $link =  $sitelinks[$n];
    
                echo "<a href='$link'>" . $link . "</a>";
            }
            else if ($sitelinks[$n][0] == '#')
            {
                continue;
            }
            else
            {
                $link =  $sitelinks[$n];
    
                // $link = substr($link, 2);
    
                // $link = "https://" . $link;
    
                echo "<a href='$link'>" . $link . "</a>";
    
            }
            echo "<br>";
        }
    }

    // echo getImgUrl('https://daryo.uz/');
    // echo getSiteUrl('https://daryo.uz/');

    

    // print_r($packtBook);

?>