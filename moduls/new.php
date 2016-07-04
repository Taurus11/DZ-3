<?php

$dir = 'files/';
$content = '';
$filename = '';
$text = '';

$form = file_get_contents('templ/editform.html');

if (isset($_POST['editsubmit'])) {

    $filename = str_replace('.txt','',$_POST['filename']);
    $text = $_POST['text'];

    if (file_exists($dir.$filename.'.txt')) {
        
        $content .= '<div class="alert alert-danger">Файл с именем <strong>'.$filename.'.txt</strong> существует</div>';
        $filename = '';
        unset($_POST['editsubmit']);

    } elseif (trim($filename) == '') {
        
        $content .= '<div class="alert alert-danger">Введите имя файла</div>';
        unset($_POST['editsubmit']);

    } elseif (trim($text) == '') {
        
        $content .= '<div class="alert alert-danger">Введите текст файла</div>';
        unset($_POST['editsubmit']);

    } else {

        file_put_contents($dir.$filename.'.txt', $text);

        $content .= '<div class="alert alert-success">Файл <strong>'.$filename.'.txt</strong> успешно сохранён
            <p>Перейти <a href="/">на главную</a></p>
        </div>';
    }

}

if (!isset($_POST['editsubmit'])) {

    $form = str_replace('{{filename}}',$filename, $form);
    $form = str_replace('{{text}}',$text, $form);

    $content .= $form;
}

$cnt['title'] = 'Создание файла';
$cnt['content'] = $content;

