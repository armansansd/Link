<?php 
	include_once('../config.php');
	include_once(LOCAL_PATH.'/header.php');
	include_once(LOCAL_PATH.'/functions.php');
?>

	<div id="formulaire">		
		<div id="rotate" class="">	
			<div class="addt"></div>
		</div>
		<form action="#" method="get" class="t_form" style="display:none;">
			<label for="title">Title</label><br />
			<input type="text" name="title" class="info" value=""/><br />
			<label for="tags">Tags</label><br />
			<input type="text" name="tag" class="info" value=""/><br />
			<input class="submit" type="submit" value="Envoyer">
		</form>
<?php

if (!empty($_GET['title'])){
		$index = LOCAL_PATH."/index.json";
		$array_index = [];
		//nettoyer le titre
		$t = check_str($_GET['title']);
		//traitement des tags
		$spl_tag = split(',',$_GET['tag']);
		//>>> elever les doublons <<<<//


		//créer le repertoire		
		$dir = LOCAL_PATH.'/data/'.date('Ymd').'-'.$t; 					
		mkdir($dir, 0777, true); //attribuer les droits
		//enregistrer le fichier info de l'article
		$file_json = LOCAL_PATH.'/data/'.date('Ymd').'-'.$t.'/'.$t.'_info.json';
		$arr_info = array(
			'titre' => $_GET['title'],
			'tag' => $spl_tag
			);
		file_put_contents($file_json,json_encode($arr_info));

		//>>> enregistre les tags dans index.json
		/*ouvrir le fichier recolter les informations dans un array
		ajouter les nouveaux tag et repusher l'array dans le fichier*/
		//affiche l'upload image
		echo "<p class='r_titre'><b>".$_GET['title']."</b></p>
			 <p class='help'>Please add your content by drag'n drop<br/>or click on the upload zone.</p>
			<div class='drop'></div>
			<div class='click' type='submit' value='EnvoyerImg'>↝</div>

		";
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
