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
        $date =  $title_array[0];
        $title_art = end($title_array);

        return array($date,$title_art);
    }




?>