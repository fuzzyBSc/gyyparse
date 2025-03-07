<?php
require_once dirname(__FILE__) ."/Dictionary.php";
require_once dirname(__FILE__) ."/Sentence.php";
require_once dirname(__FILE__) ."/SentenceMatch.php";
require_once dirname(__FILE__) ."/CompoundWordMatch.php";
require_once dirname(__FILE__) ."/AllMatchesForWord.php";

libxml_use_internal_errors(true);


$dictionary = Dictionary::readHtmlFile("Gaman guladha Gamilaraay, Yuwaalaraay, Yuwaalayaay.html");
$sentences = Sentence::readHtmlFile("Sentences.html");

// $sentence = $sentences[0];
// foreach ($sentence->split as $word) {
//     $allMatches = new AllMatchesForWord($word, $dictionary);
//     $allMatches->print();
// }
// var_dump($dictionary->suffixes);
// var_dump($dictionary->suffixes->strip("gaaybaraay"));

$match = new SentenceMatch("Waal ngiyama nguu dhaldanhi, garigari ngaama baadjindi.", $dictionary);
$match->print();

// $match = new CompoundWordMatch("dhaldanhi", $dictionary);
// $match->print();
