<?php

session_start();

if (isset($_SESSION['name'])) {
    $cnt['sign'] = '
        <p class="navbar-text">Вы вошли как '.$_SESSION['name']['login'].'</p>
        <a href="/logout/" type="button" class="btn btn-default navbar-btn">Выйти</a>
    ';
//если юзер вошел, показываем дополнительные возможности
    $cnt['navbars'] = '
    <li><a href="/new/">Создать файл</a></li>
    <li><a href="/upload/">Загрузить файл</a></li>
    ';

} else {
    $cnt['sign'] = '
        <li><a href="/login/">Войти</a></li>
    ';

    $cnt['navbars'] = ' ';
}

