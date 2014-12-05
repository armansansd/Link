<?php 
	include_once('../config.php');
	include_once(LOCAL_PATH.'/header.php');
	include_once(LOCAL_PATH.'/functions.php');
?>
<div id="admin_back">
</div>
	<div id="formulaire">
			<div id="avatar"></div>
		    <form action="" method="post" enctype="multipart/form-data">
		        <label for="title">Title</label><br />
		        <input type="text" name="title" id="tite" value=":-)"/><br />
		        <input type="file" name="file[]" multiple="multiple" id="upFile" /><br />
		        <input type="submit" value="Envoyer" />
		    </form>

	</div>
<?php
		    	include_once(LOCAL_PATH.'/SimpleImage.php');
			    if (isset($_POST['title'])){
			    	if(true !== opendir(LOCAL_PATH.'/data/'.$_POST['title']) && !empty($_POST['title']) ) {
						if( isset($_FILES['file']) && count($_FILES['file']['error']) == 1 && $_FILES['file']['error'][0] > 0 ){
							echo 'no file';
						}else if(isset($_FILES['file'])){
							$a = check_str($_POST['title']);
							/*creat folder for the article*/
						 	$dir = LOCAL_PATH.'/data/'.date('Ymd').'-'.$a;						
						 	mkdir($dir, 0777, true);
						 	/*upload file*/
						 	/*var index for each file*/
							$j = 0;
							$a = 0;
							/*path to file folder*/
							$target_path = '';
							for ($i = 0; $i < count($_FILES['file']['name']); $i++) {
						 	/*loop to get the uploaded files*/
							/*extension allowed*/
							 	$imageExtension = array("jpeg", "jpg", "png", "gif");
							 	$textExtension = array("txt", "md");
								/*get the file's extension*/
								$ext = explode('.', basename($_FILES['file']['name'][$i]));
								$file_extension = end($ext); 
								/*path to the image*/
								$target_path = $dir.'/'.$_FILES['file']['name'][$i];
								/*path to preview*/
								$target_path_preview = $dir.'/p_'.$_FILES['file']['name'][$i];
								/*count number of uploaded files*/
								$j = $j + 1;
								/*resize and save image(s)*/
								if (in_array($file_extension, $imageExtension)) {
									$image_upload = $_FILES['file']['tmp_name'][$i];
									$image = new SimpleImage();
	   								$image->load($image_upload);
	   								$image->resizeToWidth(950);
	  								$image->save($target_path);
									//echo 'image'.$j.'/ok';
										if($a==0){
											/*extract a vignette from the first image*/
											$image = new SimpleImage();
	   										$image->load($target_path);
	   										$image->crop(500,300,300);
	  										$image->save($target_path_preview);
	  										$a =+ 1;
										}
								}else if(in_array($file_extension, $textExtension)){     
									/*save the text*/
									move_uploaded_file($_FILES['file']['tmp_name'][$i],$target_path);
								}else{
									echo "invalid extension";
								}
							}
						header('Location: index.php');
						}
					}else{
						echo "please write a title";
					}
				}			
		    ?>
		
<?php include_once(LOCAL_PATH.'/footer.php'); ?>
