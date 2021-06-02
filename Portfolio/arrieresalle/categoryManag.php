<?php include_once("../includes/functions.php") ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="../ressources/styles.css">
        <link rel="icon" type="image/png" href="../ressources/logo3.png">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Gestion des catégories</title>
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
            <h1>Gestion des catégories</h1>
        </div>
            <div id="right">
            </div>
        </div>
    </header>

<main>
    <div id="left">
    <div id="add">
        <form action="categoryManag.php" method="POST">
	       <?php if($_GET) {
		      if($_GET['action']=='U') { 
			     $categorie=selectCategorieById($_GET["idCat"]);
            ?>
            <h2>Modifier une catégorie</h2>
			Nom de la catégorie <input type="text" name="newCategorie" value="<?php echo $categorie['nom_categorie'] ?>">
			<input type="hidden" name="toUpdate" value="<?php echo $categorie['id_categorie'] ?>">
            <br/>
			<input type="hidden" name="action" value="update">
			<input type="submit" value="Modifier">
		<?php } 
		}
		?>
	

	<?php if(empty($_GET) || $_GET['action']=='D'){	?>
            <h2>Ajouter une catégorie</h2>
		Nom de la catégorie <input type="text" name="newCategorie">
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
		if(deleteCategorieById($_GET['idCat'])) {
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
		
		if(insertCategorie($_POST["newCategorie"])){
			echo INSERT_OK;

		} else {

			echo INSERT_NOT_OK;
		}

	} 
	if($_POST["action"]=="update") {
		
		if(modifyCategorieById($_POST["toUpdate"],$_POST["newCategorie"])){
			echo MODIFY_OK;

		} else {

			echo MODIFY_NOT_OK;
		}
	} 
	}

?>
    <div id="right">
    <div id="all">
        <h2>Liste des catégories</h2>
        
        <ul>
            <?php 
            /* on gere l'affichage de toutes les categories*/
            $allCats = selectAllCategories();
            foreach ($allCats as $oneCat) {
	           echo '<li><table>';
	           echo '<tr><td><p>'.$oneCat['nom_categorie'].'</p></td></tr>';
               echo '<tr>';
	           echo '<td><a href="categoryManag.php?action=U&idCat='.$oneCat['id_categorie'].'">Modifier</a></td>';
	           echo '<td><a href="categoryManag.php?action=D&idCat='.$oneCat['id_categorie'].'">Supprimer</a></td>';
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