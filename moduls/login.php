<?php

$secretPassw = 'fe01ce2a7fbac8fafaed7c982a04e229'; //md5('demo');

$content = '';

if (isset($_SESSION['name'])) {



} else {

    if (isset($_POST['authsubmit'])) {

        $login = $_POST['login'];
        $passw = md5($_POST['password']);

        if ($login == 'demo' && $passw == $secretPassw) {
            $_SESSION['name'] = Array('login' => $login);
            header('location: /');
        } else {
            $content .= '
                <div class="alert alert-danger">Имя пользователя или пароль неверны</div>
            ';
        }

    }

    $content .= '
        <div class="row">
            <div class="col-md-6">

                <form action="" method="POST" class="form-horizontal">

                    <input type="hidden" name="authsubmit" value="1">

                    <div class="form-group">
                        <label for="inputEmail3" class="col-sm-2 control-label">Имя</label>
                        <div class="col-sm-10">
                            <input name ="login" type="text" class="form-control" id="inputEmail3" placeholder="Имя пользователя - demo">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputPassword3" class="col-sm-2 control-label">Пароль</label>
                        <div class="col-sm-10">
                            <input name = "password" type="password" class="form-control" id="inputPassword3" placeholder="Пароль пользователя - demo">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-default">Войти</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>
    ';
}

$cnt['title'] = 'Войти на сайт';
$cnt['content'] = $content;
