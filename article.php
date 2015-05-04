<?php 
    include_once('config.php');
    include_once(LOCAL_PATH.'/header.php');
    include_once(LOCAL_PATH.'/functions.php');
    spl_autoload_register(function($class){
    require preg_replace('{\\\\|_(?!.*\\\\)}', DIRECTORY_SEPARATOR, ltrim($class, '\\')).'.php';
});
    use \Michelf\Markdown;
?>
<div id="news">
<?php
    echo "<a class='title' href='".URL."'><div>Visualising Interface</div></a>";
    //$title = array();
    $title = $_GET['title'];
    $content_path = LOCAL_PATH.'/data'.'/'.$title;
    /*parse folder name*/
    $art_info = split_name($title);
    
    /* get the title of the image (split date-title)*/
    $art_info = split_name($title);
    $n = $art_info[1];
    /*retrieve real name*/
    $t = file_get_contents(LOCAL_PATH.'/data/'.$title.'/'.$n.'_info.json');
    $t = json_decode($t, true);
    $t = $t['titre'];
    /*display title and date*/ 
    echo "<p class='t_a'>".$t."</p>";
    echo "<p class='date'>".$art_info[0]."</p>";
    /*image and text*/
    if(false !== file_exists($content_path)){
        $image_array = array();
        /*allowed extension*/
        $image_ext = array("jpeg", "jpg", "png","gif");
        $text_ext = array("txt", "md");
        $text_content = "";
        $folder = opendir($content_path);
        while(false !== ($files = readdir($folder))){
            /*remove preview image*/
            $ext = explode('.', basename($files));
            $file_extension = end($ext);
            if(in_array($file_extension, $image_ext)){
                array_push($image_array, $files);
            }
            if(in_array($file_extension, $text_ext)){
                $text_md = file_get_contents($content_path.'/'.$files);
                $text_content =  Markdown::defaultTransform($text_md);                       
            }
        }
        foreach ($image_array as $name) {
            echo "<img src='data/".$title."/".$name."'>";
        }
        if( $text_content != false){
        //echo "<p class='text'>".$text_content."</p>";
        echo "<div class='text'>".$text_content."</div>";
        }
    }
    
?>
</div><!--end news-->
<div id="credits"></div>
<?php include_once(LOCAL_PATH.'/footer.php'); ?>