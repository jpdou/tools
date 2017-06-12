<?php
$urlencoded = isset($_POST['url_encoded']) ? $_POST['url_encoded'] : '';
$urldecoded = isset($_POST['url_decoded']) ? $_POST['url_decoded'] : '';

$result = array();
if ($urlencoded) {
    $result = array(
        'url_decoded' => urldecode($urlencoded),
    );
} elseif ($urldecoded) {
    $result = array(
        'url_encoded' => urlencode($urldecoded),
    );
} else {
    $result = array(
        'url_decoded' => '',
        'url_encoded' => '',
    );
}

echo json_encode($result);