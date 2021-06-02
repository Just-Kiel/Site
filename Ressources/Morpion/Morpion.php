<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="Ressources/Morpion.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Palanquin+Dark:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="Ressources/Images/logo3.png" />
    <title>Mon Morpion MMI</title>
</head>

<?php
    //démarrage de la session
    
    //fonction permettant l'alternance d'un joueur à un autre
    //donc si le numéro dans la variable session du joueur courant est 1 alors la variable session prend la valeur 2 et change de joueur et inversement
    function change_player(){
     if($_SESSION["current_player"]==1){
         $_SESSION["current_player"]=2;
     }else{
         $_SESSION["current_player"]=1;
     }
    };
    
    
    //4 fonctions permettant de déterminer si 3 motifs identiques sont alignés et s'il y a donc victoire
    function testAlignementHorizontal($ligne){
            //si les 3 cases d'une ligne ont un motif
               if(isset($_SESSION["case_".$ligne."0"])&&isset($_SESSION["case_".$ligne."1"])&&isset($_SESSION["case_".$ligne."1"])&&isset($_SESSION["case_".$ligne."2"])){
                   //si les motifs sont égaux
               if($_SESSION["case_".$ligne."0"]==$_SESSION["case_".$ligne."1"]&&$_SESSION["case_".$ligne."1"]==$_SESSION["case_".$ligne."2"]){
                   //variable utilisée plus tard pour afficher la victoire
                   $_SESSION['return']=true;
        }
               }
                 }
    
        function testAlignementVertical($colonne){
            //si les 3 cases d'une colonne ont un motif
               if(isset($_SESSION["case_0".$colonne])&&isset($_SESSION["case_1".$colonne])&&isset($_SESSION["case_1".$colonne])&&isset($_SESSION["case_2".$colonne])){
                   //si le motif est identique
               if($_SESSION["case_0".$colonne]==$_SESSION["case_1".$colonne]&&$_SESSION["case_1".$colonne]==$_SESSION["case_2".$colonne]){
                   //variable utilisée plus tard pour dire "victoire"
                   $_SESSION['return']=true;
        }
               }
                 }
    
            function testAlignementDiagonale1(){    
                //variable de vérification d'alignement en diagonale
                $return = true;
                for ($i=0;$i<3;$i++) {
                    //variable d'incrémentation pour vérifier alignement
                    $return = $return && (isset ($_SESSION["case_".$i.$i]) && $_SESSION["case_".$i.$i] == $_SESSION["current_player"]);
                                          }
                //si la variable d'alignement en diagonale est true
                if($return==true){
                    //toujours variable qui affiche la victoire
                    $_SESSION['return']=true;
                }
                
            }
                //bon bah c'est la même chose ici à peu près
            function testAlignementDiagonale2(){    
                $return = true;
                for ($i=0;$i<3;$i++) {
                    //le 2 en dessous correspond au nombre de cases sur une ligne - le $i -1 parce qu'on part de 0
                    $return = $return && (isset ($_SESSION["case_".(2-$i).$i]) && $_SESSION["case_".(2-$i).$i] == $_SESSION["current_player"]);
                                          }
                if($return==true){
                    $_SESSION['return']=true;
                }
                
            }

    //si un clic sur une case a été fait
    if(isset($_POST["case"])){
        //on enregistre en session que la case "appartient" à tel ou tel joueur
        $_SESSION[$_POST["case"]]=$_SESSION["current_player"];
    }
    
    //si on clic sur le bouton rejouer
    if(isset($_POST['recommencer'])){
        //toutes les variables sont réinitialisées pour recommencer la partie
        $_SESSION=[];
        $_SESSION["current_player"]=2;
        $_SESSION["nombre_coups"]=0;
    }
        
    ?>

<body>
    <div id="header">
        <h1>Mon Morpion MMI</h1>
        <p>Un vrai morpion en PHP !</p>
    </div>
    <div id="page">
        <div id="affichage">
        <?php
            //vérification d'une victoire ou non
        for($i=0; $i<3; $i++){
        testAlignementHorizontal($i);
        testAlignementVertical($i);
        }
        testAlignementDiagonale1();
        testAlignementDiagonale2();
        
        echo "<div id='plateau'>";
        echo "<form method='post' action='#'>";
        
        echo "<table>";
        echo "<tbody>";
        //fonction permettant d'afficher une table html 3x3
            //on passe 3 fois dans une boucle pour afficher 3 lignes
        for($i=0; $i<3; $i++){
          echo "<tr>";
            //on passe 3 fois dans cette boucle pour mettre 3 cases par ligne
            for($j=0; $j<3; $j++){
                echo "<td>";
                //cette variable permet d'avoir les coordonnées de la case
                $case="case_".$i.$j;
                //si les cases existent
                if(isset($_SESSION[$case])){
                    //si la case est au joueur 1
                if($_SESSION[$case]==1){
                    //on met un rond
                   echo "<img src='Ressources/Images/rond.png' alt='Rond'>";
                    //si la case est au joueur 2
                }else if($_SESSION[$case]==2){
                    //on met une croix
                   echo "<img src='Ressources/Images/croix.png' alt='Croix'>";
                }
                }
                //si c'est gagné {on affiche rien}
                else if (isset($_SESSION['return'])==true){
                    echo"<div id='vide'> </div>";
                }
                //sinon
                else {
                    //on laisse les boutons dans les cases pour continuer le jeu
                echo "<input type='submit' id='case' name='case' value='".$case."'>";
              }
                echo "</td>";
            };
          echo "</tr>";
        };
        echo "</tbody>";
        echo "</table>";
        echo "</form>";
        echo "</div>";
        ?>
        
        <div id="info">
            <?php
            //si c'est victoire
            if(isset($_SESSION['return'])==true){
                //on affiche le joueur gagnant
            echo "Le joueur ".$_SESSION["current_player"]." gagne !</br>";
        }
        
            //on change de joueur à chaque tour avec cette fonction
        change_player();
            //si il y a eu - de 9 coups et que personne ne gagne
        if($_SESSION["nombre_coups"]<9 && isset($_SESSION['return'])==false){
            //on affiche quel joueur doit jouer et combien de coups sont passés
        echo "C'est le tour du joueur ".$_SESSION["current_player"]." !</br>";
        echo "Nombre de coups joués : ".$_SESSION["nombre_coups"];
        }
            //si le nombre de coups joués vaut 9 et que personne ne gagne
        if($_SESSION["nombre_coups"]==9 && isset($_SESSION['return'])==false){
            //égalité, il faut réessayer
            echo "</br>EGALITE</br>Retentez votre chance !";
        }
        //1 coup en plus
        $_SESSION["nombre_coups"]++;
            ?>
        <!--bouton pour recommencer la partie-->
        <form method="post" action="#">
            <input type="submit" id="recommencer" name="recommencer" value="Rejouer">
        </form>
        <!--bouton pour retourner à l'accueil-->
        <form method="post" action="Accueil.php">
            <input type="submit" id="accueil" name="accueil" value="Retour à l'accueil">
        </form>
        </div>
        </div>
    </div>
    <div id="footer">
        <p>MORPION@2020 - Lafaurie Aurore - MMI 1 - TP3</p>
    </div>
</body>

</html>