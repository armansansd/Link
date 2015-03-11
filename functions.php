<?php
/*
*function for rhlog.armansansd.net
*armansansd
*/


    /*delete recursively*/
    function deleteDir($dirPath) {
        if (! is_dir($dirPath)) {
            throw new InvalidArgumentException("$dirPath must be a directory");
        }
        if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
            $dirPath .= '/';
        }
        $files = glob($dirPath . '*', GLOB_MARK);
        foreach ($files as $file) {
            if (is_dir($file)) {
                self::deleteDir($file);
            } else {
                unlink($file);
            }
        }
        rmdir($dirPath);
    }

    /*separate date and title*/
    function split_name($fileName) {
        $title_array = explode('-', basename($fileName));
        $d = $title_array[0];
        $date =  $d[0].$d[1].$d[2].$d[3].' / '.$d[4].$d[5].' / '.$d[6].$d[7];
        $title_art = end($title_array);

        return array($date,$title_art);
    }

    /*title security*/
    function check_str($str){
    $patterns = array();
    $patterns[0] = '/é|è|ê|ë|€/';
    $patterns[1] = '/ù|ü/';
    $patterns[2] = '/à|ä/';
    $patterns[3] = '/ç/';
    $patterns[4] = '/ô|œ|ö/';
    $patterns[5] = '/@| |\"|\^|~|,|\.|\:|\!|\?|\;|\(|\)|\[|\]|\{|\}|°/';
    $patterns[6] = '/\'/';
    $replacements = array();
    $replacements[0] = "e";
    $replacements[1] = "u";
    $replacements[2] = "a";
    $replacements[3] = "c";
    $replacements[4] = "o";
    $replacements[5] = "_";
    $replacements[6] = "";
    $str = strtolower($str);
    $str = preg_replace($patterns,$replacements,$str);
    $str = preg_replace('/_\_+/','_',$str);
    return $str;

    }


?>