<?php include_once("../includes/functions.php") ?>

<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../ressources/styles.css">
        <link rel="icon" type="image/png" href="../ressources/logo3.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des projets</title>
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
            <h1>Gestion des projets</h1>
        </div>
        <div id="right">
        </div>
        </div>
    </header>
    
        <?php 
/* on gere le lien de suppression */
if($_GET) {
	if($_GET['action']=='D') {
		if(deleteProjectById($_GET['idProject'])) {
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
		
		if(insertProject($_POST["newProjet"], intval($_POST["categorie"]), $_POST["description"], $_POST["date"])){
			echo INSERT_OK;

		} else {

			echo INSERT_NOT_OK;
		}

	} 
	if($_POST["action"]=="update") {
		
		if(modifyProjectById($_POST["toUpdate"],$_POST["newProjet"], intval($_POST["categorie"]), $_POST["description"], $_POST["date"])){
			echo MODIFY_OK;

		} else {

			echo MODIFY_NOT_OK;
		}
	}
    if($_POST["action"]=="fetch"){
        
    if(!empty($_POST['tag_project'])){
        if(deleteTagsToProject(intval($_POST['project_tag']))){
            echo DELETE_OK."<br/>";
        foreach($_POST['tag_project'] as $checked){
            //echo $checked."<br/>";
     if(insertTagsToProject(intval($_POST['project_tag']),intval($checked))){
         echo INSERT_OK."<br/>";
        }else{
            echo INSERT_NOT_OK;
        }
    }
        }else{
            echo DELETE_NOT_OK;
        }
    }
    }
    if($_POST["action"]=="media_fetch"){
        echo "oui";
//        if(!empty($_POST['media_project'])){
//            echo "non";
        if(deleteMediaToProject(intval($_POST['project_media']))){
            echo DELETE_OK."<br/>";
                if(insertMediaToProject(intval($_POST['project_media']), intval($_POST['media_project']))){
                    echo INSERT_OK."<br/>";
                }else {
                    echo INSERT_NOT_OK;
                }
            
        } else {
            echo DELETE_NOT_OK;
        }
    }
//	}
}
?> 
    <main>
    <div id="left">
    <div id="add">
        <!-- formulaire en 2 parties soit on update soit on ajoute -->
        <form action="projectManag.php" method="POST">
            <?php if($_GET) {
		      if($_GET['action']=='U') { 
			     $projet=selectProjectById($_GET["idProject"]);
			?>
                <h2>Modifier un projet</h2>
                Nom du projet <input type="text" name="newProjet" value="<?php echo $projet['titre_projet'] ?>">
                <select name="categorie" id="categorie_select">
            
            <?php $allCats = selectAllCategories();           
                foreach($allCats as $cat){         
                    echo "<option value='".$cat["id_categorie"]."'".displaySelected($projet['id_categorie'], $cat['id_categorie']).">".$cat["nom_categorie"]."</option>";
                } 
            ?>
                </select>
                <br />
                Description : <textarea maxlength="1000" name='description'><?php echo $projet['description'] ?></textarea>
                <br />
                Date de réalisation : <input type="date" name="date" value="<?php echo $projet['date_realisation'] ?>">
                <br/>
                <input type="hidden" name="toUpdate" value="<?php echo $projet['id_projet'] ?>">
                <br/>
                <input type="hidden" name="action" value="update">
                <input type="submit" value="Modifier">
        <?php 
              } 
		  }
		?>


        <?php if(empty($_GET)|| $_GET['action']=='D'){	?>
        <h2>Ajouter un projet</h2>
        Nom du projet <input type="text" name="newProjet">
        <select name="categorie" id="categorie_select">
            <option value="Categories">Catégories</option>
            <?php $allCats = selectAllCategories();
                           
                           foreach($allCats as $cat){
                echo "<option value='".$cat["id_categorie"]."'>".$cat["nom_categorie"]."</option>";
} ?>
        </select>
        <br />
        Description : <textarea maxlength="1000" name='description'></textarea>
        <br />
        Date de réalisation (format AAAA-MM-JJ) : <input type="date" name="date">
        <br />

        <input type="hidden" name="action" value="add">
        <input type="submit" value="Ajouter">
        <?php } ?>
    </form>
    </div>
    
    <div id="tags">
        <h2>Associer des tags</h2>
    
        <form action="projectManag.php" method="POST">
            <label for="project_tag">Choisir un projet </label>
            <select name="project_tag" id="project_select">
            <?php $allProjects = selectAllProjects();
                           
                    foreach($allProjects as $oneProject){
                        echo "<option value='".$oneProject["id_projet"]."'>".$oneProject["titre_projet"]."</option>";
                    }
            ?>
            </select>
            
            <br/>
            
            <table>
                <tr>
                    <td><label for="tag_project">Choisir les tags correspondants </label></td>
            <?php $allTags = selectAllTags();
                           
                  foreach($allTags as $oneTag){
                    echo "<td><input type='checkbox' name='tag_project[]' value='".$oneTag["id_tag"]."'/><label for='".$oneTag["id_tag"]."'>".$oneTag["tag"]."</label></td>";
                  }
            ?>
                </tr>
            </table>
            
            <input type="hidden" name="action" value="fetch">
            <input type="submit" value="Associer">
        </form>
    </div>
    
    <div id="media">
        <h2>Associer des médias</h2>
        
        <form action="projectManag.php" method="POST">
            <label for="project_media">Choisir un projet </label>
            <select name="project_media" id="project_select">
            <?php $allProjects = selectAllProjects();
                           
                    foreach($allProjects as $oneProject){
                        echo "<option value='".$oneProject["id_projet"]."'>".$oneProject["titre_projet"]."</option>";
                    }
            ?>
            </select>
            <br/>
            <label for="media_project">Choisir un média </label>
            <br/>
<!--            <select name="media_project" id="project_select">-->
            <?php $allMedias = selectAllMedias();
                           
                    foreach($allMedias as $oneMedia){
                        $imageFileType = strtolower(pathinfo($oneMedia["url"],PATHINFO_EXTENSION));
                        echo "<label id='project_select'>";
                        echo "<input type='radio' value='".$oneMedia["id_media"]."' name='media_project'>";
                        if($imageFileType == "jpg" or $imageFileType == "png" or $imageFileType == "jpeg"){
                        echo "<img src='";
                        if(stristr($oneMedia["url"], 'uploaded')){
                            echo "../".$oneMedia["url"]."' alt='".$oneMedia['legende']."'/>";
                        }else{
                            echo "".$oneMedia["url"]."' alt='".$oneMedia['legende']."'/>";
                        }
                        }
                        if(stristr($oneMedia["url"], 'youtube')){  
                        $video_id = explode("embed/", $oneMedia["url"]);
                        $video_id = $video_id[1];
                        $thumbnail="http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
                        echo "<img src='".$thumbnail."' alt='".$oneMedia['legende']."'/>";
                    }
                        echo "</label>";
                    }
            ?>
<!--            </select>-->
            <br/>
            <input type="hidden" name="action" value="media_fetch">
            <input type="submit" value="Associer">
        </form>
    </div>
        </div>
    <div id="right">
    <div id="all">
        <h2>Liste des projets</h2>
        
        <ul>
            <?php     
            /* on gere l'affichage de tous les projets*/
                $allProjects = selectAllProjects();
                foreach ($allProjects as $oneProject) {
	               echo '<li><table>';
                   echo '<tr><td><p>'.$oneProject['titre_projet'].'</p></td></tr>';
                   echo '<tr>';
                   echo '<td><a href="projectManag.php?action=U&idProject='.$oneProject['id_projet'].'">Modifier</a></td>';
	               echo '<td><a href="projectManag.php?action=D&idProject='.$oneProject['id_projet'].'">Supprimer</a></td>';
                   echo '</tr>';
                   echo '</table></li>';
                }
            ?>
        </ul>
        </div>
    </div> 
    </main>
</body>

</html>
