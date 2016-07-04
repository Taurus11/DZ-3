<?php

$content = '';

if (trim($_file)=='') header('location: /');
$filename = $_file;
$file = 'files/'.(mb_detect_encoding($filename) == 'UTF-8'?iconv('utf-8','windows-1251',$filename):$filename);

$cnt['title'] = $_file;

$mime = mime_content_type($file);

if ($mime == 'text/plain') {

    $content .= '<pre>'.str_replace('<','&lt;',file_get_contents($file)).'</pre>';

} elseif (in_array($mime,['image/gif','image/png','image/jpeg'])) { 

    header('Content-Type: '.$mime);
    readfile($file);
    exit;

} else {
    $content .= '<div class="alert alert-danger">Неизвестный формат</div>';
}

$cnt['content'] = $content;