<?php
$base64encoded = isset($_POST['base64_encoded']) ? $_POST['base64_encoded'] : '';
$base64decoded = isset($_POST['base64_decoded']) ? $_POST['base64_decoded'] : '';

$result = array();
if ($base64encoded) {
    $result = array(
        'base64_decoded' => base64_decode($base64encoded),
    );
} elseif ($base64decoded) {
    $result = array(
        'base64_encoded' => base64_encode($base64decoded),
    );
} else {
    $result = array(
        'base64_decoded' => '',
        'base64_encoded' => '',
    );
}

echo json_encode($result);