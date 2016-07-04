<?php

function showfile($path) {

    $result = '';

    $result .= '
    <table class="table table-hover table-striped">
        <tr>
            <th style="width:100%;">Имя файла</th>
            '.(isset($_SESSION['name'])?'
                    <th><div class="glyphicon glyphicon-eye-open"></div></th>
                    <th><div class="glyphicon glyphicon-pencil"></div></th>
                    <th><div class="glyphicon glyphicon-download"></div></th>
                    <th><div class="glyphicon glyphicon-trash"></div></th>
                ':'').'
        </tr>
        <tbody>
    ';

    $dir = opendir($path);
    while ($file = readdir($dir)) {
        
        if ($file != '..' && $file != '.') {
            $result .= '<tr>';

            $filename = (mb_detect_encoding($file) == 'UTF-8'?iconv('windows-1251','utf-8',$file):$file);
            $result .= '<td>'.$filename.'</td>';

            if (isset($_SESSION['name'])) {
                $result .= '
                    <td><a href="/open/?file='.$filename.'"><div class="glyphicon glyphicon-eye-open"></div></a></td>
                    <td><a href="/edit/?file='.$filename.'"><div class="glyphicon glyphicon-pencil"></div></a></td>
                    <td><a href="/download/?file='.$filename.'"><div class="glyphicon glyphicon-download"></div></a></td>
                    <td><a href="/remove/?file='.$filename.'" onClick="return confirm(\'Удалить '.$filename.'?\');"><div class="glyphicon glyphicon-remove"></div></a></td>
                ';
            }

            $result .= '</tr>';
        }
    }
    
    $result .= '
        </tbody>
    </table>
    ';

    return $result;
}

if (!function_exists('mime_content_type')) {

    function mime_content_type($filename) {
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimetype = finfo_file($finfo, $filename);
        finfo_close($finfo);
        return $mimetype;
    }
    
}