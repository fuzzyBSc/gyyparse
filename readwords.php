<?php
$dictionarywords= file_get_contents('Gaman guladha Gamilaraay, Yuwaalaraay, Yuwaalayaay.html');
$DOM = new DOMDocument;
$DOM->loadHTML(source: $dictionarywords);

$finder = new DomXPath($DOM);
$entries = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' entry ')]");

for ($i = 0; $i < $entries->length; $i++)
echo $entries->item($i)->nodeValue . "\r\n";
?>