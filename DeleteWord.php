<?php

require_once 'FileManager/FileRepository.php';

$translatorDb = new FileRepository('translatorDB.csv');
$translatorDb->readDB();

if($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    exit(0);
}

if(!isset($_COOKIE['user_role'])) {
    setcookie('user_role','anonymous');
}

if($_COOKIE['user_role'] !== 'admin') {
    http_response_code(401);
    exit(0);
}

if (isset($_REQUEST['word'])) {
    $wordToDelete = $_REQUEST['word'];

    $dictionar = $translatorDb->getDictionar();
//        var_dump($dictionar);
    $translatorDb->deleteWord($wordToDelete);
}

