<?php 
    include_once ("includes/functions.php"); 
    $page_name = "Portfolio";
    include "../view_count.php";
    $nombre_visiteurs = visiteur($page_name);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="icon" type="image/png" href="ressources/logo3.png">
    <link href="https://fonts.googleapis.com/css2?family=Palanquin+Dark:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="ressources/styles.css">
    

    <title>Portfolio</title>
</head>

<body>
    
          
          
    <header>
        <a href="../index.php" class="button">Retour à l'accueil</a>

        <h1>Portfolio</h1>
<!--        <h2>Catégories :</h2>-->
        <table>
            <?php $allCats = selectAllCategories();
                    echo "<tr>";
                    echo '<td><a href="portfolio.php?action= &idCat="Tous"">Tous</a></td>';

                foreach($allCats as $cat){
                    echo '<td><a href="categorie.php?action=C&idCat='.$cat["id_categorie"].'">'.$cat["nom_categorie"].'</a></td>';
                }
                    echo "</tr>"?>
        </table>
    </header>    
    <main>
        <div id="left">
        <table>
            <?php
            if(empty($_GET)|| $_GET['action']==' ' ){
                $allProjects = selectAllProjects();
            foreach ($allProjects as $oneProject) {
                $selectMedia = selectMediaByIdProject($oneProject["id_projet"]);
                echo '<td>';
                
                echo '<button class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg-'.$oneProject["id_projet"].'">';
//                if(!empty($selectMedia["id_media"])){
                    $imageFileType = strtolower(pathinfo($selectMedia["url"],PATHINFO_EXTENSION));
                if($imageFileType == "jpg" or $imageFileType == "png" or $imageFileType == "jpeg"){
                        echo "<img src='".$selectMedia["url"]."' alt='".$selectMedia['legende']."'/>";
                }
                        if(stristr($selectMedia["url"], 'youtube')){  
                        $video_id = explode("embed/", $selectMedia["url"]);
                        $video_id = $video_id[1];
                        $thumbnail="http://img.youtube.com/vi/".$video_id."/maxresdefault.jpg";
                        echo "<img src='".$thumbnail."' alt='".$selectMedia['legende']."'/>";
                    }
//                    }
                echo '<br/>';
                echo''.$oneProject['titre_projet'].'';
                echo '</button>';
                echo '</td>';
                
                
                    $selectProject = selectProjectById($oneProject["id_projet"]);
                    $selectCategorie = selectCategorieById($selectProject['id_categorie']);
                    $selectTag = selectTagsByIdProject($selectProject["id_projet"]);
                    //$selectMedia = selectMediaByIdProject($_GET['idProjet']);
//                    <!-- Large modal -->
                        echo '<div class="modal fade bd-example-modal-lg-'.$oneProject["id_projet"].'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <h2>'.$selectProject["titre_projet"].'</h2>
                            <h3>Catégorie :</h3><a href="categorie.php?action=C&idCat='.$selectCategorie["id_categorie"].'">'.$selectCategorie["nom_categorie"].'</a>
                            <h3>Description :</h3><p>'.$selectProject["description"].'</p>
                            <h3>Date de réalisation :</h3><p>'.$selectProject["date_realisation"].'</p>';
                
                //var_dump($selectTag);

                            if(!empty($selectTag)){
                                echo '<h3>Tags :</h3>';
                                echo '<div id="tag">';
                                $i = 0;
                                while($i<sizeof($selectTag)){
//                                foreach($selectTag[$i] as $tag){
                                    echo '<a href="tag.php?action=T&idTag='.$selectTag[$i]["id_tag"].'">'.$selectTag[$i]["tag"].'</a>';
//                                }
                                    $i++;
                                }
                                echo '</div>';
                            }
//                            if(!empty($selectMedia["id_media"])){
                                echo '<h3>Média :</h3>';
                                echo '<p>'.$selectMedia["legende"].'</p><br/>';
                                if($imageFileType == "jpg" or $imageFileType == "png" or $imageFileType == "jpeg"){
                                    echo "<img src='".$selectMedia["url"]."' alt='".$selectMedia['legende']."'/>";
                                }
                                if(stristr($selectMedia["url"], 'youtube')){
                                    echo '<iframe src="'.$selectMedia["url"].'" frameborder="0"></iframe></td></tr>';
                                }
                                
                       
//                            }
                        echo '</div>
                        </div>
                        </div>';

                
            }
            }
            ?>
        </table>
        </div>
        
        <div id="right">
        <h2>Nuage de tags :</h2>
        <?php $allTags = selectAllTags();
                    echo "<ul>";        
                foreach($allTags as $tag){
                    echo '<li><a href="tag.php?action=T&idTag='.$tag["id_tag"].'">'.$tag["tag"].'</a></li>';
                    //echo "<input type='submit' name='categorie' value='".$cat["nom_categorie"]."'></input>";
                }
                    echo "</ul>"?>
        </div>
        

        
    </main>
    
    <footer>
        <?php
            echo "Vous êtes ", $nombre_visiteurs, " à avoir découvert mes créations !";
            ?>
    </footer>
          
                
   
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
    
</html>
