/* @pjs preload="bombe.png","logo_ptut.png","logo_mmi_modif"; */

Particle[] particles; //tableau d'objets de classe Particle avec pour nom particles

Ball balls; //objet de classe Ball avec pour nom balls

String scene;  // Variable qui aura 3 valeurs différentes pour lancer les différentes fonctions : Home, Help et Game                      
PImage img;  // Variable des images
boolean particle = true;  // Permet de vérifier si on est dans le mode particle ou ball
boolean ball = false;  
boolean image = false;  // Permet de vérifier si il y a une image affichée ou non
boolean begins = true;  // Permet de vérifier si le jeu a commencé ou non
int numImage = 0;  // Variable de numérotation des images
PFont police; // Variable de la police 

String[]selected_image = new String[3];  // Tableau d'images
{
  selected_image[0] = "bombe.png";
  selected_image[1] = "logo_ptut.png";
  selected_image[2] = "logo_mmi_modif.png";
}

void setup() {  // Fonction lancée en début d'exécution du programme, exécutée une seule fois
  background(#09021e);  // Initialisation de la couleur du fond d'écran
  frameRate(1000); // Nombre d'images par seconde
  size(800, 800); // Taille de la fenêtre
  imageMode(CENTER);  // Permet de travailler l'image depuis son centre
  scene="Home";  // Initialisation de la scène

  police = loadFont("SourceCodePro-Regular-48.vlw");  // Appel de la police

  rectMode(CENTER);// Permet de travailler les rectangles depuis leur centre

  particles = new Particle[300];  // Initialisation du tableau d'objet des particules
  for (int i=0; i < particles.length; i++) {  // Création de toutes les particules, ici il y en a 300
    particles[i] = new Particle();
  }
}

void draw() {  // Fonction lancée en début d'exécution du programme, exécutée 60 fois par seconde
  switch(scene) {  // Permet de lancer les différentes fonctions selon la valeur de la variable scene 
  case "Home":
    Home();
    break;
  case "Help":
    Help();
    break;
  case "Game":
    Game();
    break;
  }
}

void Home() {
  background(#09021e);
  textAlign(CENTER);
  textSize(70);
  textFont(police, 48);
  fill(#4cc9f0);
  text("Le Particulator", width/2, 200); 
  
  if (mouseX>650 && mouseY<100) {  // Bouton pour le void Help
    fill(#0d052d);
    stroke(255);
    rectMode(CORNER);
    rect(650, 0, 150, 100, 30);
    fill(#f72585);
    text("?", 725, 60);
  } else {
    fill(#09021e);
    stroke(255);
    rectMode(CORNER);
    rect(650, 0, 150, 100, 30);
    fill(#f72585);
    text("?", 725, 60);
  }


  if (mouseX>225 && mouseX<575 && mouseY>340 && mouseY<460) {  // Bouton que pour le void Game
    fill(#0d052d);
    rectMode(CENTER);
    rect(400, 400, 350, 120, 30);
    textSize(25);
    fill(#f72585);
    text("Lancer l'expérience", 400, 410);
  } else {
    fill(#09021e);
    rectMode(CENTER);
    rect(400, 400, 350, 120, 30);
    textSize(25);
    fill(#f72585);
    text("Lancer l'expérience", 400, 410);
  }
}

class Ellipse{
  float x;
  float y;
  color c;
  float tailleX;
  float tailleY;
  
  Ellipse(){  // Initialisation des valeurs de l'objet Ellipse
    x = random(width);
    y = random(height);
  }
  
  void display(){
    noStroke();
    color c = img.get(int(x), int(y));   // Récupère la couleur du pixel de l'image de coordonnées (x, y)
    fill(c);  // Donne la couleur du pixel récupéré juste pou l'ellipse 
    ellipse(x,y,tailleX,tailleY);
  }
}

class Ball extends Ellipse {
  Ball() {  // Initialisation des valeurs de l'objet Ball
    tailleX=10;
    tailleY=10;
  }
}

class Particle extends Ellipse {
  float vx;  //  Variables incréments de la position de la particule
  float vy;
  
  Particle() {  // Initialisation des valeurs de l'objet Particle
    float a = random(TWO_PI);  // Variable définissant l'angle dans lequel part la particule, entre 0 et 2pi
    float speed = random(0.1,0.5);  // Variable de l'accélération 
    vx = cos(a)*speed;  // Calcul des incréments
    vy = sin(a)*speed;
    tailleX=6;
    tailleY=6;
  }
  
  void move(){  // Fonction de mouvement de l'objet
  
      // Mouvement
      
   x = x +vx;  
   y = y +vy;
   
      // Quand les particules arrivent sur un bord, elles "ressortent" de l'autre côté de l'écran 
      
   if(y<0){
     y=height;
   }
   if(y>height){
     y=0;
   }
   if(x<0){
     x=width;
   }
   if(x>width){
     x=0;
   }
  }
}



void Help() {
  background(#09021e);  // "Nettoyage" de l'écran en réinitialisant le fond d'écran
  fill(#4cc9f0);  // Couleur du texte
  textAlign(CENTER);  // Aligne les textes au centre
  textFont(police, 48);  // Epaisseur de la police
  textSize(25);  // Taille de la police
  text("Bienvenue dans l'expérience du Particulator !", width/2, 80);
  textSize(20);
  fill(255);
  text("Une fois l'expérience lancée, tu pourras interagir", width/2, 150);
  text("avec de différentes façon :", width/2, 200);
  text("En appuyant sur B tu pourras changer les particules en", width/2, 250);
  text("petites billes puis revenir aux particules en mouvement avec", width/2, 300);
  text("P et pour changer d'image à découvrir, tu peux appuyer sur I.", width/2, 350);
  text("En un clic, l'expérience se redémarre.", width/2, 400);
  text("Tu peux quitter l'expérience en appuyant sur la touche Echap.", width/2, 450);
  text("Viens vite tester notre nouvelle machine !", width/2, 550);


  // Design du bouton "Retour au menu"

  if (mouseX>250 && mouseX<550 && mouseY>600 && mouseY<700) {  // Si la souris passe sur la zone du rectangle, il s'éclaircit
    fill(#0d052d);
    rectMode(CENTER);  // Permet de tracer le rectangle depuis le centre de celui-ci
    stroke(255);
    rect(400, 650, 300, 100, 30);
    fill(#f72585);
    textSize(25);
    text("Retour au menu", width/2, 660);
  } else {  
    fill(#09021e);
    rectMode(CENTER);
    stroke(255);
    rect(400, 650, 300, 100, 30);
    fill(#f72585);
    textSize(25);
    text("Retour au menu", width/2, 660);
  }
}

void Game() {
  textSize(15);
  fill(#4cc9f0);
  textAlign(LEFT);
  text("I : Changer d'image", 10, 20);
  text("P : Mode particule", 10, 35);
  text("B : Mode balle", 10, 50);
  
  if (begins == true || image == true) {  // Vérifie si le joueur a appuyé sur I
    img = loadImage(selected_image[numImage]);  // Charge l'image actuelle
    img.resize(800, 800);  // Redimensionne l'image à la taille de l'espace de jeu choisie dans le setup
    begins = false;  // Réinitialise les variables begins et image 
    image = false;
  }

  if (ball == true) {  // Vérifie si le joueur a appuyé sur B
    balls = new Ball();  //  Construit un nouvel objet Ball
    balls.display();  // Lance la méthode display de l'objet Ellipse dont l'objet Ball est l'enfant
  }

  if (particle == true) {  // Vérifie si le joueur a appuyé sur P
    for (int i=0; i<particles.length; i++) {  // Parcourt le tableau de particules
      particles[i].display();  // Lance la méthode display de Ellipse dont Particle est l'enfant
      particles[i].move();  // Lance la méthode move de Particle
    }
  }
}

void keyPressed() {
  if (key == 'm' || key == 'M') {  // La touche Echap sert à quitter le programme
    scene = "Home";
  }


  // La Touche P sert à lancer le mode particule

  if (scene=="Game") {  
    if (key == 'P' || key == 'p' && ball == true) { // pour lancer le mode particule il faut que le mode balle soit actif
      background(255);  // Nettoie l'écran en réinitialisant le fond 
      ball = false;  // On switche de mode donc les booléens changent aussi
      particle = true;
    }

    // La touche B sert à lancer le mode balle

    if (key == 'b' || key == 'B' && particle == true) {  // pour lancer le mode balle il faut que le mode particule soit actif
      background(255);  // Nettoie l'écran en réinitialisant le fond 
      particle = false;  // On switche de mode donc les booléens changent aussi
      ball = true;
    }

    // La touche I sert à changer d'image

    if (key == 'I' || key == 'i') {
      image = true;  
      if (numImage == (selected_image.length-1)) {  // vérifie si l'image actuelle est la dernière du tableau
        background(255);  // Nettoie l'écran
        numImage = 0;  // L'incrément revient à 0 pour afficher la première image
      } else {  // Sinon l'incrément augmente de 1 pour afficher l'image d'après
        background(255);  // Nettoie l'écran
        numImage ++;
      }
    }
  }
}

void mouseClicked() {
  if (scene=="Home") {  // Vérifie si on est sur le menu
    if (mouseX>225 && mouseX<575 && mouseY>340 && mouseY<460) {  // Vérifie si on appuie sur la zone du rectangle  
      scene="Game";  // Permet de lancer la fonction "Game"
    }
    if (mouseX>650 && mouseY<100) {  // Vérifie si on appuie sur la zone du rectangle
      scene="Help";  // Permet de lancer la fonction "Help"
    }
  }
  if (scene=="Help") {  // Vérifie si on est sur la page d'aide
    if (mouseX>250 && mouseX<550 && mouseY>550 && mouseY<650) {  // Vérifie si on appuie sur la zone du rectangle
      scene="Home";  // Permet de lancer la fonction "Home"
    }
  }
  if(scene=="Game"){  // Vérifie si on est sur le jeu
   background(255);   // Nettoie l'écran en réinitialisant le fond
  }
}