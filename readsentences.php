<?php
$testdata= file_get_contents('Sentences.html');
$DOM = new DOMDocument;
$DOM->loadHTML(source: $testdata);

$finder = new DomXPath($DOM);
$classname="orth";
$nodes = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");

for ($i = 0; $i < $nodes->length; $i++)
echo $nodes->item($i)->nodeValue . "\r\n";
?>