<?php
require_once dirname(__FILE__) ."/word.php";
require_once dirname(__FILE__) ."/sentence.php";

libxml_use_internal_errors(true);


$words = Word::readHtml("Gaman guladha Gamilaraay, Yuwaalaraay, Yuwaalayaay.html");
foreach ($words as $word) {
    echo $word;
}
$sentences = Sentence::readHtml("Sentences.html");
foreach ($sentences as $sentence) {
    echo $sentence;
}
?>