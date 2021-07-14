<?php
require_once 'FileManager/FileRepository.php';

header('Access-Control-Allow-Methods: GET');

$translatorDb = new FileRepository('translatorDB.csv');
$translatorDb->readDB();

if($_SERVER['REQUEST_METHOD'] !== 'GET'){

    exit(0);
}

if(!isset($_REQUEST['word'])) {

    exit(0);
}

$wordToSearch = $_REQUEST['word'];

$wordFound = $translatorDb->findTheWord($wordToSearch);

if(!empty($wordFound)){
    printf("Server response: The translation for the word %s is %s", $wordToSearch, $wordFound);
    header("Content-type: application/json; charset=utf-8");
    http_response_code(200);

    echo json_encode([ $wordToSearch,$wordFound]);

}else{
    echo "Server response: unknown word";
    http_response_code(404);
}




