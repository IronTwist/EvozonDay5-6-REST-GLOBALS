<?php

require_once 'FileManager/FileRepository.php';

header('Access-Control-Allow-Methods: GET');

$translatorDb = new FileRepository('translatorDB.csv');
$translatorDb->readDB();

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    if(isset($_REQUEST['word'])) {
        $wordToSearch = $_REQUEST['word'];
        var_dump($wordToSearch);
        $wordFound = $translatorDb->findTheWord($wordToSearch);

        if(!empty($wordFound)){
            printf("Server response: The translation for the word %s is %s", $wordToSearch, $wordFound);
        }else{
            echo "Server response: unknown word";
        }
    }
}

//var_dump($_SERVER);
//var_dump($_REQUEST);
//
//echo "<form action=\"API.php\" method=\"get\">";
//echo "<label for=\"searchWord\" id=\"searchWord\">Search Word</label>";
//echo "<input type=\"text\" id=\"searchWord\" name=\"searchWord\">";
//echo "<button type=\"submit\">Search</button>";
//echo "</form>";
//
