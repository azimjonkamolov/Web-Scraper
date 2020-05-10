<?php
// Create a cURL handle
$ch = curl_init('https://daryo.uz/2020/05/10/bollivudning-30-dan-oshgan-boshi-ochiq-aktrisalari-foto/');

// Execute
curl_exec($ch);

// Check HTTP status code
if (!curl_errno($ch)) {
  switch ($http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE)) {
    case 200:  # OK
      break;
    default:
      echo 'Unexpected HTTP code: ', $http_code, "\n";
  }
}

// Close handle
curl_close($ch);
?>