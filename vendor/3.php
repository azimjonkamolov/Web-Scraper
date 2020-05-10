<?php

// 3-xpath-scraping.php

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

    $packtPage = curlGet('https://daryo.uz/'); 
    $packtPageXpath = returnXPathObject($packtPage); 
    
    $title = $packtPageXpath->query('//title');
    if ($title->length > 0) 
    {
        $packtBook['title'] = $title->item(0)->nodeValue;
    }

    $release = $packtPageXpath->query('//a');
    if ($release->length > 0)
    {

        for($i = 0; $i < $release->length; $i++)
        {
            $packtBook['release'][] = $release->item($i)->nodeValue . "<br>";
        }

        // $packtBook['release'] = $links;
    }

    $overview = $packtPageXpath->query('//div[@class="overview_left"]');
    if ($overview->length > 0) 
    {
        $packtBook['overview'] = trim($overview->item(0)->nodeValue);
    }

    $author = $packtPageXpath->query('//div[@class="bpright"]/div[@class="author"]/a');
    if ($author->length > 0) 
    {
        for ($i = 0; $i < $author->length; $i++) 
        {
        $packtBook['author-name'][] = $author->item($i)->nodeValue;
        }
    }

    print_r($packtBook);

?>