<?php

//function for is post request
function isPostRequest() {
    return ( filter_input(INPUT_SERVER, 'REQUEST_METHOD') === 'POST');
}

// function - run a curl on posted site and save as $data
function curlUrl($url) {
    $ch = curl_init();
    $timeout = 5;
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
    $data = curl_exec($ch);
    curl_close($ch);
    return $data;
}

// function - run regex match all and remove dups and return remove dups 
function filterUrl($data) {
    $reg_exUrl = "/(https?:\/\/[\da-z\.-]+\.[a-z\.]{2,6}[\/\w \.-]+)/";
    preg_match_all($reg_exUrl, $data, $allLinks);
    $removeDuplicates = array_unique($allLinks[0]);
    return $removeDuplicates;
}
