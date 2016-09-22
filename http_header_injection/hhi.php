<?php

use Symfony\Component\HttpFoundation\Response;

require_once __DIR__ . '/../vendor/autoload.php';

$response = new Response();

$response->headers->set('X-My-Header', "my value\r\nX-My-Other: foo");
$response->headers->set("X-My-Other-Header: foo\r\nBar", 'my value');

$response->setContent('Not supported in PHP :(');

$response->send();
