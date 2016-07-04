<?php

if (trim($_file)=='') header('location: /');
$filename = $_file;
$file = 'files/'.(mb_detect_encoding($filename) == 'UTF-8'?iconv('utf-8','windows-1251',$filename):$filename);

unlink($file);
header('location: /');