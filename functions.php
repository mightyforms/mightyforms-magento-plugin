<?php

/**
 * @author DemonIa sanchoclo@gmail.com
 * @function RemotePageGet
 * @description This is wrapper for cURL. Needed for requesting data from server
 * (in our case, it's users forms list)
 * @param $url
 * @param $referer
 * @param int $POST
 * @param string $POSTFIELDS
 * @return bool|string
 */
function RemotePageGet($url, $referer, $POST = 0, $POSTFIELDS='') {
    global $agent, $cookie_file_path;
    $browser = curl_init();
    if ($POST == 1) {
        curl_setopt($browser, CURLOPT_POST, 1);
        if ($POSTFIELDS != '') {
            curl_setopt($browser, CURLOPT_POSTFIELDS, http_build_query( $POSTFIELDS));
        }
    }
    curl_setopt($browser, CURLOPT_URL, $url);
    curl_setopt($browser, CURLOPT_REFERER, $referer);
    curl_setopt($browser, CURLOPT_USERAGENT, $agent);
    curl_setopt($browser, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($browser, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($browser, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($browser, CURLOPT_CONNECTTIMEOUT, 10); //times out after 11s
    curl_setopt($browser, CURLOPT_TIMEOUT, 50); //times out after
    curl_setopt($browser, CURLOPT_COOKIEJAR, $cookie_file_path);
    curl_setopt($browser, CURLOPT_COOKIEFILE, $cookie_file_path);
    $retVal = curl_exec ($browser);

    curl_close ($browser);
    unset($browser);
    return $retVal;
}