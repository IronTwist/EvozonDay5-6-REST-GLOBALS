<?php

require_once 'FileManager/FileRepository.php';

header('Access-Control-Allow-Methods: POST');
header("Content-type: application/json; charset=utf-8");

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<form action=\"http://www.myhost.com/PostWord.php\ " method=\"POST\">";

    echo "<label for=\"addWord\" id=\"addWord\">Add word</label>";
    echo "<input type=\"text\" id=\"addWord\" name=\"addWord\">";

    echo "<label for=\"explanation\" id=\"explanation\">Explanation</label>";
    echo "<input type=\"text\" id=\"explanation\" name=\"explanation\">";

    echo "<button type=\"submit\">ADD WORD</button>";
    echo "</form>";

    exit(0);
}

$translatorDb = new FileRepository('translatorDB.csv');
$translatorDb->readDB();


$word = $_POST['addWord'];
$explanation = $_POST['explanation'];

$arrayWord = [
    0 => $word,
    1 => $explanation
];

$previousWords = $translatorDb->getDictionar();
$previousWords[] = $arrayWord;

$newDictionarWords = $previousWords;

$translatorDb->addWord($newDictionarWords);

http_response_code(200);

echo json_encode($newDictionarWords);






