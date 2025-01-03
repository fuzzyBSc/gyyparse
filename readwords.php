<?php
$dictionarywords= file_get_contents('Gaman guladha Gamilaraay, Yuwaalaraay, Yuwaalayaay.html');
$DOM = new DOMDocument;
$DOM->loadHTML(source: $dictionarywords);

$finder = new DomXPath($DOM);
$entries = $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' entry ')]");

for ($ii = 0; $ii < $entries->length; $ii++) {
    $entry = $entries->item($ii);
    // echo $entry->nodeValue . "\r\n";
    echo $id . "\r\n";
    $id = $entry->getAttribute("id");   
    $gyy = $finder->query(
        "./div/*[contains(concat(' ', normalize-space(@class), ' '),
        ' hw ')]",
        $entry);
    echo $gyy->item(0)->nodeValue . "\r\n";
}
?>