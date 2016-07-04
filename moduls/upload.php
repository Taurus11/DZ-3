<?php

$content = '';

if (isset($_POST['uplsubmit'])) {

    $filename = $_FILES['filename']['name'];
    $tmp_name = $_FILES['filename']['tmp_name'];
    $type = $_FILES['filename']['type'];
    $size = $_FILES['filename']['size'];

    $_err = '';
    if (!is_uploaded_file($tmp_name)) {
        
        $_err = 'Ошибка загрузки!';

    } elseif ($type != 'text/plain' &&
              $type != 'image/gif' &&
              $type != 'image/png' &&
              $type != 'image/jpeg') {

        $_err = 'Загружать можно только текстовые файлы и картинки (txt, jpg, gif, png)!';

    } elseif ($size > 2097152) {

        $_err = 'Ошибка! Файл больше 2Мб!';

    } elseif (!move_uploaded_file($tmp_name, 'files/' . $filename)) {
        
        $_err = 'Ошибка загрузки!';

    } else {
        $content .= '<div class="alert alert-success">Файл <strong>'.$filename.'</strong> успешно загружен
            <p>Перейти <a href="/">на главную</a></p>
        </div>';
    }

    if (trim($_err)!='') {
        $content .= '<div class="alert alert-danger">'.$_err.'</div>';
        unset($_POST['uplsubmit']);
    }
}

if (!isset($_POST['uplsubmit'])) {

    $content .= '
        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
            <input type="hidden" name="uplsubmit" value="1">
            <div class="form-group">
                <label class="col-sm-2 control-label" for="exampleInputFile">Выберите файл:</label>
                <div class="col-sm-10">
                    <input type="file" name= "filename" id="exampleInputFile">
                </div>
            </div>

            <div class="form-group">
                <div class="col-sm-10 col-sm-offset-2">
                    <button type="submit" class="btn btn-success">Загрузить</button>
                    <a class="btn btn-default" href="/" role="button">Отменить</a>
                </div>
            </div>

        </form>
    ';

}

$cnt['title'] = 'Загрузить файл';
$cnt['content'] = $content;