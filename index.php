<?php 
    include_once('config.php');
    include_once(LOCAL_PATH.'/header.php');
    include_once(LOCAL_PATH.'/functions.php');
?>
<div id="info">
<?php
    echo "<p class='title'>rhétorique logiciel</p>";
    echo "<p class='sbtitle'>titre provisoire</p>"; 
?>
</div> 
<?php
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
                $art_info = split_name($title);
                $t= preg_replace('/_/',' ', $art_info[1]);
                $t= preg_replace('/axc/','\'', $t);
                echo "<h2 class='titre'>".$t."</h2>";
                /*get and store the preview image*/ 
                $pfile = opendir($content_path.'/'.$title);
                while(false !== ($preview = readdir($pfile))){
                    //echo $preview;
                    $p = explode('_',$preview);
                    if($p[0] == 'p'){
                        echo "<img id='vignette' src='data/".$title."/".$preview."'>";
                    }
                }
        ?>
        </div></a>         
            
<?php
            }
        }              
    }
?>
<div id="credits"></div>
<?php include_once(LOCAL_PATH.'/footer.php'); ?>