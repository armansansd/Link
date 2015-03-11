<?php 
	include_once('../config.php');
	include_once(LOCAL_PATH.'/header.php');
	include_once(LOCAL_PATH.'/functions.php');
?>

	<div id="formulaire">
			<div id="avatar"></div>
			
		    <div class="addt"></div>
		    <form action="#" method="get" class="t_form"style="display:none;">
				<label for="title">Title</label><br />
				<input type="text" name="title" id="title" value=""/><br />
				<input  class="submit" type="submit" value="Envoyer" />
			</form>
			
<?php

if (!empty($_GET['title'])){
		$t = check_str($_GET['title']); //nettoyer le titre
		$dir = LOCAL_PATH.'/data/'.date('Ymd').'-'.$t; //créer le repertoire					
		mkdir($dir, 0777, true); //attribuer les droits
		//enregistrer le fichier info de l'article
		$file_json = LOCAL_PATH.'/data/'.date('Ymd').'-'.$t.'/'.$t.'_info.json';
		$arr_info = array(
			'titre' => $_GET['title'],
			'tag' => 'tag à prévoir'
			);

		file_put_contents($file_json,json_encode($arr_info));
		echo '<div class="drop"></div><div class="click"></div>';
}
if (isset($_FILES)) {
     /*chargement des fichiers*/
	$imageExtension = array("jpeg", "jpg", "png", "gif"); //extensions autorisées
	$textExtension = array("txt", "md"); //
	//recupérer les extensions des fichiers
	$ext = explode('.', basename($_FILES['file']['name']));
	$file_extension = end($ext); 
	//chemin d'enregistrement
	$file_path = LOCAL_PATH.'/data/'.date('Ymd').'-'.$t.'/'.$_FILES['file']['name'];
	//sauvegarder les images
	if (in_array($file_extension, $imageExtension)) {
		$tempFile = $_FILES['file']['tmp_name'];
		move_uploaded_file($tempFile,$file_path);
	  }else if(in_array($file_extension, $textExtension)){     
		//save the text
		move_uploaded_file($_FILES['file']['tmp_name'],$file_path);
	}
}
?>
</div>

<?php include_once(LOCAL_PATH.'/footer.php'); ?>
