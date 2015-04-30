<?php 
    include_once('config.php');
    include_once(LOCAL_PATH.'/header.php');
    include_once(LOCAL_PATH.'/functions.php');
?>
<div id="info">
<?php
    echo "<p class='title'>Visualising Interface</p>"; 
?>
</div> 
<?php
    $thumb = "";
    //echo crypt("admin");
    $content_path = LOCAL_PATH.'/data';
    /*open file*/
    if(false !== file_exists($content_path)){
        $folder = opendir($content_path);
    /*read title*/                 
        while(false !== ($title = readdir($folder))){
            if($title != '.' && $title != '..'){
?>
        <a href="<?php echo 'article.php?title='.$title ?>"><div id="vignette_content">
        <?php 
                /* get the title of the image (split date-title)*/
                $art_info = split_name($title);
                $n = $art_info[1];
                /*retrieve real name*/
                $t = file_get_contents(LOCAL_PATH.'/data/'.$title.'/'.$n.'_info.json');
                $t = json_decode($t, true);
                $t = $t['titre'];
                /*display title*/
                echo "<h2 class='titre'>".$t."</h2>";
                /*get and store the preview image*/
                $imageExt = array("jpeg", "jpg", "png", "gif"); 
                /*create the preview image*/
                $p_folder = opendir($content_path.'/'.$title);
                while(false !== ($preview = readdir($p_folder))){
                    $ext = explode('.', basename($preview));
                    $f_ext = end($ext);
                    if (in_array($f_ext, $imageExt)) {
                        $thumb = $preview ;
                    }                   
                }
                echo "<img id='vignette' src='data/".$title."/".$thumb."'>";

        ?>
        </div></a>         
            
<?php
            }
        }              
    }
?>
<div id="credits"></div>
<?php include_once(LOCAL_PATH.'/footer.php'); ?>