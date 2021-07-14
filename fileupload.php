<?php

if(!isset($_POST['file_input'])){
    http_response_code(404);
    exit(0);
}

if(!isset($_POST['text_input'])){
    http_response_code(404);
    exit(0);
}

$file_input = $_FILES["file_input"]["tmp_name"];

$target_dir = __FILE__;
$dir = dirname($target_dir) . "/uploads/";

$target_file = $dir . $_FILES['file_input']['name'];

if(move_uploaded_file($file_input, $target_file)){
    echo 'File has been uploaded';
}else{
    echo 'not working';
}
