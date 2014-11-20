<?php 
    include_once('config.php');
    include_once(LOCAL_PATH.'/header.php');
    include_once(LOCAL_PATH.'/functions.php');
?>
<div id="news">
<?php
    echo "<a class='title' href='".URL."'><div>rhétorique logiciel</div></a>";
    //$title = array();
    $title = $_GET['title'];
    $content_path = LOCAL_PATH.'/data'.'/'.$title;
    /*parse folder name*/
    $art_info = split_name($title);
    //echo $date;

    echo "<h3>".$art_info[1]."</h3>";
    echo "<p class='date'>".$art_info[0]."</p>";

    if(false !== file_exists($content_path)){
        $image_array = array();
        $image_ext = array("jpeg", "jpg", "png");
        $text_ext = array("txt", "md");
        $preview = "p";
        $text_content = "";
        $folder = opendir($content_path);
        while(false !== ($files = readdir($folder))){
            /*remove preview image*/
            $ext = explode('.', basename($files));
            $p = explode('_',$ext[0]);
            $file_extension = end($ext);
            if(in_array($file_extension, $image_ext) && false == ($p[0] == $preview)){
                array_push($image_array, $files);
            }
            if(in_array($file_extension, $text_ext)){
                //require_once('/var/www/html/rhlog/Markdown.php');
                $text = file_get_contents($content_path.'/'.$files);
                //$Markdown_Parser = new Markdown_Parser;
                //$Markdown_Parser->transform($text); 
                //unset($Markdown_Parser);
                $text_content = str_replace("\n", "<br />", $text);                        
            }
        }
        foreach ($image_array as $name) {
            echo "<img src='/rhlog/data/".$title."/".$name."'>";
        }
        echo "<p class='text'>".$text_content."</p>";
    }
    
?>
</div><!--end news-->
<div id="credits"></div>
<?php include_once(LOCAL_PATH.'/footer.php'); ?>