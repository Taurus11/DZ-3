<?php

$dir = 'files/';
$content = '';

if (trim($_file)=='') header('location: /');
$filename = $_file;
$file = 'files/'.(mb_detect_encoding($filename) == 'UTF-8'?iconv('utf-8', 'windows-1251', $filename):$filename);

$mime = mime_content_type($file);
if ($mime != 'text/plain') {

    $content .= '<div class="alert alert-danger">Редактирование возможното только текстовых файлов<p>Перейти <a href="/">на главную</a></p></div>';

} else {
    $form = file_get_contents('templ/editform.html');
    $text = file_get_contents($file);

    if (isset($_POST['editsubmit'])) {

        $filename = str_replace('.txt','',$_POST['filename']);
        $text = $_POST['text'];

        if (trim($filename) == '') {
            
            $content .= '<div class="alert alert-danger">Введите имя файла</div>';
            unset($_POST['editsubmit']);

        } elseif (trim($text) == '') {

            $content .= '<div class="alert alert-danger">Введите текст файла</div>';
            unset($_POST['editsubmit']);

        } else {

            file_put_contents($dir.(mb_detect_encoding($_file) == 'UTF-8'?iconv('utf-8','windows-1251',$_file):$_file), $text);

            $content .= '<div class="alert alert-success">Файл <strong>'.$filename.'.txt</strong> успешно обновлён
                <p>Перейти <a href="/">на главную</a></p>
            </div>';
        }

    }

    if (!isset($_POST['editsubmit'])) {
        $form = str_replace('{{filename}}', $filename, $form);
        $form = str_replace('{{text}}', $text, $form);

        $content .= $form;
    }
}

$cnt['title'] = 'Редактирование файла';
$cnt['content'] = $content;
