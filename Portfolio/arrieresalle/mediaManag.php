<?php include_once("../includes/functions.php") ?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../ressources/styles.css">
        <link rel="icon" type="image/png" href="../ressources/logo3.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des médias</title>
    </head>
<body>
    <header id="gestion">
        <table>
            <tr>
                <td><a href="projectManag.php">Gestion des projets</a></td>
                <td><a href="categoryManag.php" >Gestion des categories</a></td>
                <td><a href="tagManag.php">Gestion des tags</a></td>
                <td><a href="mediaManag.php" >Gestion des médias</a></td>
            </tr>
        </table>
        <div id="top">
        <div id="left">
            <h1>Gestion des médias</h1>
        </div>
            <div id="right">
            </div>
        </div>
    </header>
    
    <div id="add">
        <form action="mediaManag.php" method="POST" enctype="multipart/form-data">
            <?php if(empty($_GET)|| $_GET['action']=='D'){	?>
                <h2>Ajouter un média</h2>
                Légende du média <input type="text" name="newLegendeMedia">
                <br/>
                <input type="file" name="fileToUpload">
                OU
                <input type="url" name='url'placeholder="Entrez l'URL du média"/>
                <br />
                <input type="hidden" name="action" value="add">
                <input type="submit" value="Ajouter">
            <?php }
            ?>
        </form>
    </div>
    
    <?php 
/* on gere le lien de suppression */
if($_GET) {
	if($_GET['action']=='D') {
		if(deleteMediaById($_GET['idMedia'])) {
			echo DELETE_OK;
		} else {
			echo DELETE_NOT_OK;
		}
	}
}
?>

    <?php
/*traitement du formulaire*/
if($_POST && !empty($_POST)) {
	if($_POST["action"]=="add") {
        var_dump($_FILES["fileToUpload"]["tmp_name"]);
        
        $target_dir = "../uploaded/";
        $target_bdd_dir = "uploaded/";
        $target_file = $target_dir.basename($_FILES["fileToUpload"]["name"]);
        $target_bdd_file = $target_bdd_dir.basename($_FILES["fileToUpload"]["name"]);
        $uploadOk=1;
        $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
        
        // Check if file already exists
//        if (file_exists($target_file)) {
//            echo "Sorry, file already exists.";
//            $uploadOk = 0;
//        }
        
        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
            // if everything is ok, try to upload file
        } else {
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file) && insertMedia($_POST["newLegendeMedia"], $target_bdd_file)) {
                echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
        
        
		if(!empty($_POST['url']) && insertMedia($_POST["newLegendeMedia"], $_POST['url'])){
			echo INSERT_OK;

		} else {

			echo INSERT_NOT_OK;
		}

	} 
	}

?>
    <div id="all">
        <h2>Liste des médias</h2>
        
        <ul id="media">
            <?php 
                $allMedias = selectAllMedias();
                foreach ($allMedias as $oneMedia) {
                   $imageFileType = strtolower(pathinfo($oneMedia["url"],PATHINFO_EXTENSION));
                   echo '<li><table>';
	               echo '<tr><td>';
                    if($imageFileType == "jpg" or $imageFileType == "png" or $imageFileType == "jpeg"){
                   echo '<img src="';
                    
                if(stristr($oneMedia["url"], 'uploaded')){
                    echo '../'.$oneMedia["url"].'" alt="'.$oneMedia['legende'].'"/></td></tr>';
                }else{
                   echo ''.$oneMedia["url"].'" alt="'.$oneMedia['legende'].'"/></td></tr>';
                }
                    }
                    if(stristr($oneMedia["url"], 'youtube')){
                        echo '<iframe src="'.$oneMedia["url"].'" frameborder="0"></iframe></td></tr>';
                    }
                   echo '<tr>';
                   echo '<td>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp</td>';
	               echo '<td><a href="mediaManag.php?action=D&idMedia='.$oneMedia['id_media'].'">Supprimer</a></td>';
	               echo '</tr>';
	               echo '</table></li>';
                }
            ?>
        </ul>
    </div> 
</body>

</html>
