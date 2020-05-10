<?php
// Create a cURL handle
$ch = curl_init('https://daryoasdasd.uz/');

// Execute
curl_exec($ch);

// Check if any error occurred
if (curl_errno($ch)) {
  $info = curl_getinfo($ch, CURLINFO_HTTP_CODE);
  $detail = curl_getinfo($ch);
  echo "The HTTP response code: " . $info;
  echo "<br>";
  echo 'Took ', $detail['total_time'], ' seconds to send a request to ', $detail['url'], "\n";
}

// Close handle
curl_close($ch);
?>