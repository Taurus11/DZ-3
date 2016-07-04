<?php

if (trim($_file)=='') header('location: /');
$filename = $_file;
$file = 'files/'.(mb_detect_encoding($filename) == 'UTF-8'?iconv('utf-8','windows-1251',$filename):$filename);

if (file_exists($file)) {

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename=' . basename($file));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    readfile($file);
    exit;

}
