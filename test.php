<?php
require_once dirname(__FILE__) ."/word.php";
$sentences = require_once(dirname(__FILE__) ."/readsentences.php");
$words = Word::readHtml("Gaman guladha Gamilaraay, Yuwaalaraay, Yuwaalayaay.html");
foreach ($sentences as $sentence) {
    echo $sentence;
}
foreach ($words as $word) {
    echo $word;
}
?>