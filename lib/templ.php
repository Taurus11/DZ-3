<?php

$cnt = Array();//переменная создаётся в самом начале
$buf = file_get_contents('templ/index.html');


//эта функция вызывается после всего-всего, массив $cnt к тому времени полностью набит
function showContent() {
    
    global $cnt, $buf;
//
    foreach ($cnt as $key => $value) {
        $buf = str_replace('{{'.$key.'}}', $value, $buf);
    }

    echo $buf;
}