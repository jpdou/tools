<?php
$mageencoded = isset($_POST['mage_encoded']) ? $_POST['mage_encoded'] : '';
$magedecoded = isset($_POST['mage_decoded']) ? $_POST['mage_decoded'] : '';

$result = array();
if ($mageencoded) {
    $result = array(
        'mage_decoded' => _urlDecode($mageencoded),
    );
} elseif ($magedecoded) {
    $result = array(
        'mage_encoded' => _urlEncode($magedecoded),
    );
} else {
    $result = array(
        'mage_decoded' => '',
        'mage_encoded' => '',
    );
}

echo json_encode($result);

function _urlEncode($url) 
{
    return strtr(base64_encode($url), '+/=', '-_,');
}

function _urlDecode($url)
{
    return base64_decode(strtr($url, '-_,', '+/='));
}