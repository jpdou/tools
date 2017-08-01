<?php


define('BASE_DIR', __DIR__);

// S class
require_once realpath(BASE_DIR. DIRECTORY_SEPARATOR. '..'. DIRECTORY_SEPARATOR. '..'. DIRECTORY_SEPARATOR). DIRECTORY_SEPARATOR. 'S.php';
// Filter class
require_once BASE_DIR. DIRECTORY_SEPARATOR. 'code'. DIRECTORY_SEPARATOR. 'Filter.php';
$post = $_POST;

$filter = new Filter($post);
$filter->readTpl();
$filter->save();






