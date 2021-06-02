<?php include_once("../includes/functions.php") ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../ressources/styles.css">
        <link rel="icon" type="image/png" href="../ressources/logo3.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des tags</title>
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
            <h1>Gestion des tags</h1>
        </div>
        <div id="right">
        </div>
        </div>
    </header>
    <main>
        <div id="left">
    <div id="add">
        <form action="tagManag.php" method="POST">
	       <?php if($_GET) {
		      if($_GET['action']=='U') { 
			     $tag=selectTagById($_GET["idTag"]);
			?>
            <h2>Modifier un tag</h2>
			Nom du tag <input type="text" name="newTag" value="<?php echo $tag['tag'] ?>">
			<input type="hidden" name="toUpdate" value="<?php echo $tag['id_tag'] ?>">
            <br/>
			<input type="hidden" name="action" value="update">
			<input type="submit" value="Modifier">
		  <?php } 
		          }
		  ?>
	

	       <?php if(empty($_GET) || $_GET['action']=='D'){	?>
                  <h2>Ajouter un tag</h2>
		          Nom du tag <input type="text" name="newTag">
                 <br/>
			     <input type="hidden" name="action" value="add">
			     <input type="submit" value="Ajouter">
	<?php } ?>

        </form>
    </div>
        </div>
    
            <?php 
/* on gere le lien de suppression */
if($_GET) {
	if($_GET['action']=='D') {
		if(deleteTagById($_GET['idTag'])) {
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
		
		if(insertTag($_POST["newTag"])){
			echo INSERT_OK;

		} else {

			echo INSERT_NOT_OK;
		}

	} 
	if($_POST["action"]=="update") {
		
		if(modifyTagById($_POST["toUpdate"],$_POST["newTag"])){
			echo MODIFY_OK;

		} else {

			echo MODIFY_NOT_OK;
		}
	} 
	}

?>
    <div id="right">
    <div id="all">
        <h2>Liste des tags</h2>
        
        <ul>
            <?php 
            $allTags = selectAllTags();
            foreach ($allTags as $oneTag) {
	           echo '<li><table>';
	           echo '<tr><td><p>'.$oneTag['tag'].'</p></td></tr>';
               echo '<tr>';
	           echo '<td><a href="tagManag.php?action=U&idTag='.$oneTag['id_tag'].'">Modifier</a></td>';
	           echo '<td><a href="tagManag.php?action=D&idTag='.$oneTag['id_tag'].'">Supprimer</a></td>';
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