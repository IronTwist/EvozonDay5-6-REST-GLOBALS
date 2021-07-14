<?php

require_once 'FileManager/FileRepository.php';

header('Access-Control-Allow-Methods: POST');
header("Content-type: application/json; charset=utf-8");

session_start();

if($_SERVER['REQUEST_METHOD'] !== 'POST') {
exit(0);
}

$token = "dsafdsfsdfw";

//$_SESSION['token'] = 'dsafdsfsdfw';

//Test using $_SESSION

if(!isset($_SESSION['user_role'])) {
    $_SESSION['user_role'] = 'anonymous';
    $_SESSION['token'] = null;
}

if(!isset($_SESSION['token'])){
    http_response_code(401);
    exit(0);
}

if($_SESSION['user_role'] !== 'admin') {
    http_response_code(401);
    exit(0);
}

if($_SESSION['token'] !== $token) {
    http_response_code(401);
    exit(0);
}

$translatorDb = new FileRepository('translatorDB.csv');
$translatorDb->readDB();

$word = $_POST['addWord'];
$explanation = $_POST['explanation'];


$previousWords = $translatorDb->getDictionary();
$previousWords[$word] = $explanation;

$translatorDb->addWord($previousWords);

http_response_code(200);

echo json_encode($previousWords, JSON_THROW_ON_ERROR);