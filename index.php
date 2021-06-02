<!DOCTYPE html>
<html lang="fr">

    <?php
        $page_name = "Accueil";
    
        include "view_count.php";
        $nombre_visiteurs = visiteur($page_name);
    ?>
    
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Ceci est le site vitrine de Aurore Lafaurie." />
    <meta name="author" content="Aurore Lafaurie" />
    <meta name="date-creation-ddmmyyyy" content="18052020" />

    <link href="Ressources/styles.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Source+Code+Pro:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Palanquin+Dark:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="Ressources/images/logo3.png" />
    <title>Aurore Lafaurie</title>
</head>

<body>
    <div class="container">
        <header id="header">
            <img src="Ressources/images/logo3.png" alt="Logo d'Aurore Lafaurie">
            <nav id="navbar">
                <ul id="menu">
                    <li><a href="#header">Intro</a></li>
                    <li><a href="#a_propos">A propos</a></li>
                    <li><a href="#portfolio">Portfolio</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
            <div id="intro">
                <h2>Salut !</h2>
                <h1>Mon prénom est <span>Aurore</span>.</h1>
                <h2>Couteau Suisse du Multimedia</h2>
                <p>Jeune de 18 ans motivée, j'aime venir en aide et apporter mes connaissances.<br />Je suis étudiante en MMI.</p>
                <a href="#a_propos" class="button">A PROPOS</a>
            </div>
        </header>
        <div id="a_propos">
            <div id="formation">
                <div id="myself">
                    <div id="left">
                    <h2>A propos de moi...mais pas que !</h2>
                    <p>Actuellement en DUT MMI, je suis en permanence à la recherche d’expérience professionnelle. <br/>En effet titulaire du diplôme du Brevet d'Aptitudes aux Fonctions d'Animateur, la volonté de participer est mon plus grand atout.
                        Travailler avec des enfants apprend la patience et développe des qualités comme la créativité ou la capacité à improviser.
                        <br/>Faire voyager enfant et adulte, c’est le défi que l’on m’a donné, je cherche donc un endroit où m’exercer !</p>
                    </div>
                    <div id="right">
                        <a href="Ressources/Documents/CV_web_Aurore_Lafaurie_AI.pdf" class="button">MON CV</a>
                        <br/>
                        <a href="Ressources/Documents/CV_Objet_Aurore_Lafaurie.pdf" class="button">MON CV OBJET</a>
                    </div>
                    </div>
                <div class="info">
                    <div class="examen">
                        <div class="diplome">
                            <a href="https://www.iut-tarbes.fr/DUT-Metiers-du-Multimedia-et-de-l">
                            <h3>DUT MMI</h3>
                            <p>
                                Métiers Multimédias et Internet<br />
                                Formation polyvalente<br />en audiovisuel et informatique<br />
                                En cours (2019 - )<br />
                                IUT de Tarbes
                            </p>
                                </a>
                        </div>
                        <div class="diplome">
                            <a>
                            <h3>Baccalauréat</h3>
                            <p>
                                Baccalauréat Scientifique SVT ISN<br />
                                Options Japonais LV3 et Section<br />européenne Anglais<br />
                                Mention très bien en 2019<br />
                                Lycée Ozenne, Toulouse
                            </p>
                            </a>
                        </div>
                        <div class="diplome">
                            <a href="https://bafa.ufcv.fr/Le-BAFA/Le-BAFA-c-est-quoi">
                            <h3>BAFA</h3>
                            <p>
                                Brevet d’Aptitudes aux Fonctions d’Animateur<br/>
                                Approfondissement spécialisé “Enfance en difficulté”<br/>
                                Validé en Juin 2020
                            </p>
                            </a>
                        </div>
                    </div>
                    <div id="rsn">
                        <p>Si vous aimez mes travaux suivez moi sur :</p>
                        <ul>
                            <li><a href="https://www.linkedin.com/in/aurore-lafaurie-68636b197/"><img src="Ressources/images/linkedin.png" alt="Accès vers mon compte Linkedin"></a></li>
                            <li><a href="https://www.instagram.com/_just_kiel_/"><img src="Ressources/images/instagram.png" alt="Accès vers mon compte Instagram"></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div id="portfolio">
            <h2>Portfolio...</h2>
            <p>De beaux projets, en cours ou finis...</p>
            <div id="images" class="opacity-color">
                <div id="ligne1">
                    <a href="Processing/casse_brique.html"><img src="Ressources/images/casse_brique.png" alt="Preview du Casse-briques"></a>
                    <a href="Processing/particulator.html"><img src="Ressources/images/particulator.png" alt="Photo de preview du Particulator"></a>
                </div>
                <div id="ligne2">
                    <a href="Ressources/Morpion/Accueil.php" target="_blank"><img src="Ressources/images/projet_morpion.jpg" alt="Mon morpion en PHP"></a>
                    <a href="illustrator_champignon.html"><img src="Ressources/images/charlotte_aux_fraises.jpg" alt="Travail sur Illustrator"></a>
                </div>
            </div>
            <a href="Portfolio/portfolio.php" class="button">Plus de projets ici !</a>
        </div>
        <div id="contact">
            <div id="contact_me">
                <div id="texte">
                    <h2>Me contacter...</h2>
                    <p>Pour m’envoyer mon billet d’avion c’est ici :<br /><br />
                        Et pour toute autre raison liée à une découverte le<br />formulaire est là pour cela.</p>
                    <div id="mrsn">
                        <p>Mes réseaux sociaux :</p>
                        <ul>
                            <li><a href="https://www.linkedin.com/in/aurore-lafaurie-68636b197/"><img src="Ressources/images/linkedin.png" alt="Accès vers mon compte Linkedin"></a></li>
                            <li><a href="https://www.instagram.com/_just_kiel_/"><img src="Ressources/images/instagram.png" alt="Accès vers mon compte Instagram"></a></li>
                        </ul>
                    </div>
                </div>

                <div class="form">
                    <?php 
                    if (isset($_POST['mailform'])){
                        if(!empty($_POST['nom']) AND !empty($_POST['mail']) AND !empty($_POST['message'])) {
                            $header="MIME-Version: 1.0\r\n";
		                    $header.='From:"Aurore-Lafaurie.fr"<aurore31140@gmail.com>'."\n";
		                    $header.='Content-Type:text/html; charset="uft-8"'."\n";
		                    $header.='Content-Transfer-Encoding: 8bit';

		                    $message='
		                          <html>
                                    <body>
                                        <div align="center">
                                                <br />
                                                    <u>Nom de l\'expéditeur :</u>'.$_POST['nom'].'<br />
                                                    <u>Mail de l\'expéditeur :</u>'.$_POST['mail'].'<br />
					                               <br />
					                               '.nl2br($_POST['message']).'
					                                   <br />
				                                    </div>
			                                         </body>
		                                              </html>
		                                              ';

		                                      mail("aurore31140@gmail.com", "CONTACT - aurore-lafaurie.fr", $message, $header);
		                                  $msg="<p>Votre message a bien été envoyé !</p>";
                        } else {
                            $msg="<p>Tous les champs doivent être remplis !</p>";
                        }
                    }

                ?>
                    <form method="post">
                        <p>
                            <input type="text" name="nom" class="name" placeholder="Ton nom" required>
                        </p>
                        <p>
                            <input type="email" name="mail" class="mail" placeholder="Ton adresse email" required>
                        </p>
                        <p>
                            <textarea name="message" class="message" placeholder="Ton message" required></textarea>
                        </p>
                        <p><input class="button" id="envoi" type="submit" name='mailform' value="ENVOYER"></p>
                        <?php
                        if(isset($msg)){
                            echo $msg ;
                        }
                    ?>
                    </form>

                </div>
            </div>
            <div id="copyright">
                <p><?php
                    echo "Vous êtes ", $nombre_visiteurs," à avoir découvert mon profil !";
                    ?><br/>
                © 2020 Aurore Lafaurie. Hébergé par IONOS - <a href="mentions_legales.html">Mentions légales</a></p>
            </div>
        </div>
    </div>
</body>

</html>
