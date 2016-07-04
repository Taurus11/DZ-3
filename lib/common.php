<?php
//грузим шаблон страницы и свой шаблонизатор
include 'lib/templ.php';
//здесь проверяестя наличие переменной из сессии, если есть, то одно, если нет, то другое
//т.е. или ссылка войти или и имя пользователя и навбар
include 'lib/session.php';
//здесь 2 фукнции
include 'lib/func.php';


//из гет берём route, вырезаем слева справа слэши, затем разбиваем на массив с резделителем слэш
if (isset($_GET['route'])) $route = explode('/',trim($_GET['route'],'/\\'));

//$modul = или первый элемент $route или 'main'
$modul = ($route[0]==''?'main':$route[0]);
$tmp = explode('/',(isset($_GET['file'])?$_GET['file']:''));
//примерно так же получаем имя файла из get
$_file = trim($tmp[0]);

//ещё раз смотрим в сессии имя, то если его нет и в запросе нет нужного то подключаем страницу с ошибкой
if (!isset($_SESSION['name']) && in_array($modul,['new','edit','open','remove','download','upload'])) {
    include 'moduls/accessdenied.php';
} else {
    //если имя в сесси есть, то подключаем страницу, соответствующую $module
    include 'moduls/'.$modul.'.php';
}