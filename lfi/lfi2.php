<?php

header('Content-type: text/plain');

$file = $_GET['file'];
$data = file_get_contents($file);
var_dump($data);
var_dump(base64_decode($data));
