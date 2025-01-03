<?php
require_once dirname(__FILE__) ."/Dictionary.php";
require_once dirname(__FILE__) ."/Sentence.php";
require_once dirname(__FILE__) ."/AllMatchesForWord.php";

libxml_use_internal_errors(true);


$dictionary = Dictionary::readHtml("Gaman guladha Gamilaraay, Yuwaalaraay, Yuwaalayaay.html");
$sentences = Sentence::readHtml("Sentences.html");

$sentence = $sentences[0];
foreach ($sentence->split as $word) {
    $allMatches = new AllMatchesForWord($word, $dictionary);
    $allMatches->print();
}
