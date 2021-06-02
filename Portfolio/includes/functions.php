<?php

include_once("config.php");


//SELECT tps_total FROM `observations` WHERE id_commentaire<90 GROUP BY id_programme

function connectDB(){

	$con = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASS,DB_NAME);
// Check connection
	if (mysqli_connect_errno())
	  {
  			echo "Failed to connect to MySQL: " . mysqli_connect_error();
  	}
    //var_dump($con);
  	mysqli_set_charset($con,"utf8");
  	return $con;
}

/* fonction de déconnexion */
function disconnectDB($connexion){

	mysqli_close($connexion);
}

function displaySelected($idToSelect, $id){
    $result = '';
    if($id == $idToSelect){
        $result = 'selected';
    }
    return $result;
}

//catégories
function insertCategorie($catToInsert) {
	$myConnexion=connectDB();
	$sqlReq = "INSERT INTO categories(nom_categorie) VALUES ('$catToInsert')";
	$result = mysqli_query($myConnexion,$sqlReq);
	disconnectDB($myConnexion);
	//var_dump($result);
	return $result;
}

function selectAllCategories() {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_categorie,nom_categorie FROM categories";
	$result = mysqli_query($myConnexion,$sqlReq);	
	$i=0;
	/* on lit l'objet result*/
	$allCategories=[];
    while($oneCategorie=mysqli_fetch_array($result)){
		$allCategories[$i]=$oneCategorie;
		$i++;
	}
	/* on verifie */
	//var_dump($allCategories);
	return $allCategories;
}

function selectCategorieById($idCategorie) {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_categorie,nom_categorie FROM categories WHERE id_categorie=$idCategorie";
	$result = mysqli_query($myConnexion,$sqlReq);		
	/* on lit l'objet result*/
	$oneCategorie=mysqli_fetch_array($result);
	/* on verifie */
	//var_dump($oneCategorie);
	return $oneCategorie;
}

function modifyCategorieById($idCategorie,$newNameCategorie) {
	$myConnexion=connectDB();
	$sqlReq = "UPDATE categories SET nom_categorie='$newNameCategorie' WHERE id_categorie=$idCategorie";
	$result = mysqli_query($myConnexion,$sqlReq);		
	/* on lit l'objet result*/
	return $result;
}

function deleteCategorieById($idCategorie) {
	$myConnexion=connectDB();
	$sqlReq = "DELETE FROM categories WHERE id_categorie=$idCategorie";
	$result = mysqli_query($myConnexion,$sqlReq);		

	return $result;
}


//projets
function insertProject($projetToInsert, $idCat, $descToInsert, $dateToInsert) {
	$myConnexion=connectDB();
	$sqlReq = "INSERT INTO projets(titre_projet, id_categorie, description, date_realisation) VALUES ('$projetToInsert', $idCat, '$descToInsert', '$dateToInsert')";
	//var_dump($idCat);
    $result = mysqli_query($myConnexion,$sqlReq);
	disconnectDB($myConnexion);
	//var_dump($result);
	return $result;
}

function selectAllProjects() {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_projet,titre_projet, description FROM projets";
	$result = mysqli_query($myConnexion,$sqlReq);	
	$i=0;
	/* on lit l'objet result*/
	$allProjects=[];
	while($oneProject=mysqli_fetch_array($result)){
		$allProjects[$i]=$oneProject;
		$i++;
	}
	/* on verifie */
	//var_dump($allProjects);
	return $allProjects;
}

function deleteProjectById($idProjet) {
	$myConnexion=connectDB();
	$sqlReq = "DELETE FROM projets WHERE id_projet=$idProjet";
	$result = mysqli_query($myConnexion,$sqlReq);		
	
	return $result;
}

function selectProjectById($idProjet) {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_projet,titre_projet, id_categorie, description, date_realisation FROM projets WHERE id_projet=$idProjet";
	$result = mysqli_query($myConnexion,$sqlReq);		
	/* on lit l'objet result*/
	$oneProject=mysqli_fetch_array($result);		
	/* on verifie*/
	//var_dump($oneCategorie);
	return $oneProject;
}

function modifyProjectById($idProjet,$newNameProjet, $idNewCat, $newDescription, $newDate) {
	$myConnexion=connectDB();
	$sqlReq = "UPDATE projets SET titre_projet='$newNameProjet', id_categorie=$idNewCat, description='$newDescription', date_realisation='$newDate' WHERE id_projet=$idProjet";
	$result = mysqli_query($myConnexion,$sqlReq);	
	/* on lit l'objet result*/
	return $result;
}

function selectProjectsByIdCategorie($idCat) {
    $myConnexion=connectDB();
	$sqlReq = "SELECT id_projet, titre_projet, description FROM projets WHERE id_categorie=$idCat";
	$result = mysqli_query($myConnexion,$sqlReq);
    $i=0;
	/* on lit l'objet result*/
	$allProjets=[];
	while($oneProjet=mysqli_fetch_array($result)){
		$allProjets[$i]=$oneProjet;
		$i++;
	}	
	/* on verifie*/
	return $allProjets;
}

function selectProjectsByIdTag($idTag) {
    $myConnexion=connectDB();
	$sqlReq = "SELECT projets.id_projet, projets.titre_projet, projets.description FROM projets, projets_tags WHERE projets_tags.id_tag=$idTag AND projets_tags.id_projet=projets.id_projet";
	$result = mysqli_query($myConnexion,$sqlReq);
    $i=0;
	/* on lit l'objet result*/
	$allProjets=[];
	while($oneProjet=mysqli_fetch_array($result)){
		$allProjets[$i]=$oneProjet;
		$i++;
	}	
	/* on verifie*/
	return $allProjets;
}

//medias
function insertMedia($legendeToInsert, $urlToInsert) {
	$myConnexion=connectDB();
	$sqlReq = "INSERT INTO media(legende, id_projet, url) VALUES ('$legendeToInsert', 0, '$urlToInsert')";
    $result = mysqli_query($myConnexion,$sqlReq);
	disconnectDB($myConnexion);
	//var_dump($result);
	return $result;
}

function selectAllMedias() {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_media, url, legende FROM media";
	$result = mysqli_query($myConnexion,$sqlReq);	
	$i=0;
	/* on lit l'objet result*/
	$allMedias=[];
	while($oneMedia=mysqli_fetch_array($result)){
		$allMedias[$i]=$oneMedia;
		$i++;
	}
	/* on verifie */
	return $allMedias;
}

function deleteMediaById($idMedia) {
	$myConnexion=connectDB();
	$sqlReq = "DELETE FROM media WHERE id_media=$idMedia";
	$result = mysqli_query($myConnexion,$sqlReq);		
		
    return $result;
}

function selectMediaById($idMedia) {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_media,legende, id_projet, url FROM media WHERE id_media=$idMedia";
	$result = mysqli_query($myConnexion,$sqlReq);		
	/* on lit l'objet result*/
	$oneMedia=mysqli_fetch_array($result);	
	/* on verifie*/
	return $oneMedia;
}

function selectMediaByIdProject($idProjet){
    $myConnexion=connectDB();
	$sqlReq = "SELECT id_media, url, legende FROM media WHERE id_projet=$idProjet";
	$result = mysqli_query($myConnexion,$sqlReq);
	/* on lit l'objet result*/
    $oneMedia=mysqli_fetch_array($result);	
	/* on verifie*/
	return $oneMedia;
}
    
//tags
function insertTag($tagToInsert) {
	$myConnexion=connectDB();
	$sqlReq = "INSERT INTO tags(tag) VALUES ('$tagToInsert')";
	$result = mysqli_query($myConnexion,$sqlReq);
	disconnectDB($myConnexion);
	//var_dump($result);
	return $result;
}

function selectAllTags() {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_tag,tag FROM tags";
	$result = mysqli_query($myConnexion,$sqlReq);	
	$i=0;
	/* on lit l'objet result*/
	$allTags=[];
	while($oneTag=mysqli_fetch_array($result)){
		$allTags[$i]=$oneTag;
		$i++;
	}
	/* on verifie */
	return $allTags;
}

function selectTagById($idTag) {
	$myConnexion=connectDB();
	$sqlReq = "SELECT id_tag,tag FROM tags WHERE id_tag=$idTag";
	$result = mysqli_query($myConnexion,$sqlReq);		
	/* on lit l'objet result*/
	$oneTag=mysqli_fetch_array($result);
	/* on verifie */
	return $oneTag;
}

function modifyTagById($idTag,$newNameTag) {
	$myConnexion=connectDB();
	$sqlReq = "UPDATE tags SET tag='$newNameTag' WHERE id_tag=$idTag";
	$result = mysqli_query($myConnexion,$sqlReq);		
	/* on lit l'objet result*/
	return $result;
}

function deleteTagById($idTag) {
	$myConnexion=connectDB();
	$sqlReq = "DELETE FROM tags WHERE id_tag=$idTag";
	$result = mysqli_query($myConnexion,$sqlReq);		
	/* on verifie */
	return $result;
}

function selectTagsByIdProject($idProject) {
    $myConnexion=connectDB();
	$sqlReq = "SELECT tags.id_tag, tags.tag FROM tags, projets_tags WHERE tags.id_tag = projets_tags.id_tag AND projets_tags.id_projet = $idProject";
	$result = mysqli_query($myConnexion,$sqlReq);
	$i=0;
	/* on lit l'objet result*/
	$allTags=[];
	while($oneTag=mysqli_fetch_array($result)){
		$allTags[$i]=$oneTag;
		$i++;
	}	
	/* on verifie*/
	return $allTags;
}

//tags associés aux projets
function insertTagsToProject($idProjet,$idTag) {
	$myConnexion=connectDB();
	$sqlReq = "INSERT INTO projets_tags(id_projet, id_tag) VALUES ($idProjet, $idTag)";
	$result = mysqli_query($myConnexion,$sqlReq);
	disconnectDB($myConnexion);
	//var_dump($result);
	return $result;
}

function deleteTagsToProject($idProjet) {
	$myConnexion=connectDB();
	$sqlReq = "DELETE FROM projets_tags WHERE id_projet=$idProjet";
	$result = mysqli_query($myConnexion,$sqlReq);		
	return $result;
}




function deleteMediaToProject($idProjet){
    $myConnexion=connectDB();
	$sqlReq = "UPDATE media SET id_projet =0  WHERE id_projet=$idProjet";
	$result = mysqli_query($myConnexion,$sqlReq);		
	return $result;
}

function insertMediaToProject($idProjet, $idMedia){
    $myConnexion=connectDB();
	$sqlReq = "UPDATE media SET id_projet=$idProjet WHERE id_media=$idMedia";
	$result = mysqli_query($myConnexion,$sqlReq);
	disconnectDB($myConnexion);
	//var_dump($result);
	return $result;
}
?>
