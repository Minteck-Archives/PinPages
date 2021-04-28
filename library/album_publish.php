<?php

$request = curl_init("http://pinpages-cdn.unaux.com/upload.php?i=3");
// $request = curl_init("http://www.google.com");

// curl_setopt($request, CURLOPT_POST, true);
curl_setopt($request, CURLOPT_HEADER, 1);
curl_setopt($request, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($request, CURLOPT_STDERR, fopen('php://stdout'));
curl_setopt($request, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
curl_setopt($request, CURLOPT_COOKIEJAR, "album_ext_cookies.tmp");
curl_setopt($request, CURLOPT_COOKIEFILE, "album_ext_cookies.tmp");
curl_setopt($request, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
// curl_setopt(
//     $request,
//     CURLOPT_POSTFIELDS,
//     array(
//         'upload' => '@' . realpath($_FILES['upload']['tmp_name'])
//     ));

curl_setopt($request, CURLOPT_RETURNTRANSFER, true);
echo curl_exec($request);

curl_close($request);
exit;