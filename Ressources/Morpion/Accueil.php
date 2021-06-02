<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ceci est la page d'accueil d'un morpion réalisé en PHP par Aurore Lafaurie." />
    <meta name="author" content="Aurore Lafaurie" />
    <meta name="date-creation-ddmmyyyy" content="18052020"/>
    <link rel="stylesheet" type="text/css" href="Ressources/Morpion.css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Palanquin+Dark:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="Ressources/images/logo3.png" />
    <title>Mon Morpion MMI</title>
</head>

    <?php
        //initialisation de la session et des variables sessions
        $_SESSION=[];
        $_SESSION["current_player"]=2;
        $_SESSION["nombre_coups"]=0;
    ?>
    
<body>
    <div id="header">
        <h1>Mon Morpion MMI</h1>
        <p>Un vrai morpion en PHP !</p>
    </div>
    <div id="page">
        <h2>Définition</h2>
        <p>Le morpion est un jeu de réflexion se pratiquant à deux joueurs au tour par tour et dont le but est de créer le premier un alignement sur une grille.</p>

        <h2>Règles du jeu</h2>
        <ul>
            <li>Les joueurs inscrivent tour à tour leur symbole sur une grille de 3 par 3 cases.</li>
            <li>Le premier qui parvient à aligner 3 de ses symboles horizontalement, verticalement ou en diagonale gagne la partie.</li>
            <li>PS: Le morpion donne un avantage assez important à celui qui commence.</li>
        </ul>
        
        <!--bouton d'accès au morpion à la page Morpion.php-->
        <form method="post" action="Morpion.php">
            <input type="submit" id="commencer" name="debut" value="Commencer">
        </form>
    </div>
    <div id="footer">
        <p>MORPION@2020 - Lafaurie Aurore - MMI 1 - TP3</p>
    </div>
</body>

</html>
