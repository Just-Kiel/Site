/* @pjs preload="fond_choix_niveau.jpg","fond_win_colore.png","fond-instructions-papier.jpg", "mur_colore_rougeetnoir_fond.jpg", "point-interrogation_fond-instructions.jpg"; */

int numeroScene;
float ballX ; // abscisse du centre de la balle
float ballY ; // ordonnée du centre de la balle
float move;//déplacement barre
boolean terminer;//quand plus de briques

void setup() {
  size(500, 800);
  ballX=250;//coord init x balle
  ballY=690;//coord init y balle
  move=215;//coord init barre
  numeroScene=0;
  init();
  init_niv2();
  init_niv3();
}
void lostgame() {
  if (ballY>=800)
  {
    noLoop();
    setup();
    loop();
    Home();
  }
}

void draw() {

  if (numeroScene==0) {
    loop(); //permet de faire fonctionner le void
    Home();
  } else if (numeroScene==1) {
    loop();
    Niveau1();
  } else   if (numeroScene==2) {
    loop();
    Regles();
  } else if (numeroScene==3) {
    loop();
    Niveau2();
  } else if (numeroScene==4) {
    loop();
    Choix();
  } else if (numeroScene==5) {
    loop();
    NiveauAl();
  } else if (numeroScene==6){
   win();
  }
}

void Choix() {

  int x=mouseX;
  int y=mouseY;
  background(0);
  PImage fondChoix ; 
  fondChoix = loadImage("fond_choix_niveau.jpg") ; 
  image(fondChoix, 0,0, 900, 800);


  if (x<=400 && x>=120 && y>=200 && y<=270) {
    textSize(50);
    text("Niveau 1", 150, 250);
  } else {
    textSize(40);
    text("Niveau 1", 170, 250);
  }
  if (x<=400 && x>=120 && y>=350 && y<=420) {
    textSize(50);
    text("Niveau 2", 150, 400);
  } else {
    textSize(40);
    text("Niveau 2", 170, 400);
  }
  if (x<=400 && x>=120 && y>=500 && y<=570) {
    textSize(50);
    text("Niveau Aléatoire", 60, 550);
  } else {
    textSize(40);
    text("Niveau Aléatoire", 90, 550);
  }




  if (mousePressed==true) {


    if (x<=400 && x>=120 && y>=200 && y<=270) {
      numeroScene=1;
    }
    if (x<=400 && x>=120 && y>=350 && y<=420) {
      numeroScene=3;
    }
    if (x<=400 && x>=120 && y>=500 && y<=570) {
      numeroScene=5;
    }
  }
} 

void Home() {

  int x=mouseX;
  int y=mouseY;
  //construction de la scene 0
  background(0);
  PImage fondAccueil;
  fondAccueil=loadImage("mur_colore_rougeetnoir_fond.jpg");
  image(fondAccueil, 0, 0, 900, 800);
  textSize(50);
  text("Casse-briques", width/6, 60);

  if (x<=120 && y>=560 && y<=710) {
    textSize(50);
    fill(30,30,40);
    text("Jouer", 30, 600);
  } else {
    textSize(40);
    fill(30,30,40);
    text("Jouer", 40, 600);
  }
  if (x>=90 && x<=310 && (abs(y+30)>700)) {
    textSize(40);
    fill(144,83,92);
    text("Instructions", 130, 700);
  } else {
    textSize(30);
    fill(144,83,92);
    text("Instructions", 160, 700);
  }
    fill(240,247,246);



  if (mousePressed==true) {
// conditions pour que lorsque le clic de la souris est compris dans l'espace de chaque mot
// la scène attrbuée se lance 
    if (x<=120 && y>=560 && y<=710) {
      numeroScene=4; // vers la scène choix 
    }
    if (x>=130 && x<=310 && y>=660 && y<=740) {
      numeroScene=2; // vers les instructions
    }
  }

}

float deplacementX=-3.5 ; // vitesse du déplacement horizontal de la balle
float deplacementY=-2; // vitesse du déplacement vertical de la balle 
int nb_brique=7;
int nb_ligne=7;
int coord_x=2;
int coord_y=50;
int largeur_x=69;
int hauteur_y=60;
int i;
int l;


boolean[][] mur_affichage = new boolean[nb_ligne][nb_brique];
int[][][] mur_coord = new int[nb_ligne][nb_brique][4];

void init() {
  for (l=0; l<nb_ligne; l++) {
    for (i=0; i<nb_brique; i++) {
      mur_affichage[l][i]=true;
      if (i==0) {
        mur_coord[l][i][0]=coord_x;
      } else {
        mur_coord[l][i][0]=mur_coord[0][i-1][0]+mur_coord[0][i-1][2]+2;
      }
      mur_coord[l][i][1]=coord_y+l*(hauteur_y+2);
      mur_coord[l][i][2]=largeur_x;
      mur_coord[l][i][3]=hauteur_y;
    }
  }
}

void Niveau1() {
  ballX=ballX+deplacementX;
  ballY=ballY+deplacementY;  
  background (0);
  fill(220,37,63);
  ellipse (ballX, ballY, 10, 10);
  rect(move, 700, 70, 10);
  fill(30,30,40);
  stroke(220,37,63);
  strokeWeight(2);
  if (keyPressed==true) {
    if (keyCode==LEFT) {
      move=move-3;
    }
    if (keyCode==RIGHT) {
      move=move+3;
    }
  }
  if (ballX>=move && ballX<= move+70 && ballY==700 ) // si x est dans l'intervalle de la barre quand la balle atteint le niveau de la barre
  {
    deplacementY=-deplacementY;
  }

  if (ballX<=2 || ballX>=498) // x peut aller de 5 à 995 sinon il y a rebond 
  {
    deplacementX=-deplacementX;
  }
  if (ballY<=5) // y rebondit à 5 
  {
    deplacementY=-deplacementY ;
  }

  //a partir d'ici c'est le mouvement de la barre
  if (move>470) {
    move=0;
    rect(move, 700, 70, 10);
  }
  if (move<0) {
    move=470;
    rect(move, 700, 70, 10);
  }


  for (l=0; l<nb_ligne; l++) {
    for (i=0; i<nb_brique; i++) {
      if (mur_affichage[l][i]) {
        rect(mur_coord[l][i][0], mur_coord[l][i][1], mur_coord[l][i][2], mur_coord[l][i][3]);

        if ((ballX>mur_coord[l][i][0] && ballX<mur_coord[l][i][0]+mur_coord[l][i][2] && ballY>=mur_coord[l][i][1] && ballY<=mur_coord[l][i][1]+mur_coord[l][i][3])) {
          mur_affichage[l][i]=false; 
          deplacementX=-deplacementX;

        }
        if ((ballX>mur_coord[l][i][0] && ballX<mur_coord[l][i][0]+mur_coord[l][i][2] && (ballY==mur_coord[l][i][1] || ballY==mur_coord[l][i][1]+mur_coord[l][i][3]))) {
          mur_affichage[l][i]=false; 
          deplacementY=-deplacementY;
          deplacementX=-deplacementX;

        }
      }
    }
  }
  terminer = true;
  for (l=0; l<nb_ligne; l++) {
    for (i=0; i<nb_brique && terminer; i++) {
      if (mur_affichage[l][i]) {
        terminer=false;
      }
    }
  }
  if (terminer) {
    noLoop();
    setup();
    numeroScene=6;
    loop();
  }

  fill(123, 183, 175); 
  lostgame();
}

int nb_ligne_niv2=5;

boolean[][] mur_affichage_niv2 = new boolean[nb_ligne_niv2][nb_brique];

void init_niv2() {
  for (l=0; l<nb_ligne_niv2; l++) {
    for (i=0; i<nb_brique; i++) {
      mur_affichage_niv2[l][i] = false;
      if (i==0) {
        mur_coord[l][i][0]=coord_x;
      } else {
        mur_coord[l][i][0]=mur_coord[0][i-1][0]+mur_coord[0][i-1][2]+2;
      }
      mur_coord[l][i][1]=coord_y+l*(hauteur_y+2);
      mur_coord[l][i][2]=largeur_x;
      mur_coord[l][i][3]=hauteur_y;
    }
  }
  mur_affichage_niv2[0][2] = true;
  mur_affichage_niv2[0][4] = true;
  mur_affichage_niv2[1][0] = true;
  mur_affichage_niv2[1][3] = true;
  mur_affichage_niv2[1][6] = true;
  mur_affichage_niv2[2][1] = true;
  mur_affichage_niv2[2][5] = true;
  mur_affichage_niv2[3][2] = true;
  mur_affichage_niv2[3][4] = true;
  mur_affichage_niv2[4][3] = true;
}

void Niveau2() {
  ballX=ballX+deplacementX;
  ballY=ballY+deplacementY;  
  background(0);
  fill(70,106,117);
  ellipse (ballX, ballY, 10, 10);
  rect(move, 700, 70, 10);
  fill(30,30,40);
  stroke(255);
  strokeWeight(2);

  if (keyPressed==true) {
    if (keyCode==LEFT) {
      move=move-3;
    }
    if (keyCode==RIGHT) {
      move=move+3;
    }
  }
  if (ballX>=move && ballX<= move+70 && ballY==700 ) // si x est dans l'intervalle de la barre quand la balle atteint le niveau de la barre
  {
    deplacementY=-deplacementY;
  }

  if (ballX<=2 || ballX>=498) // x peut aller de 5 à 995 sinon il y a rebond 
  {
    deplacementX=-deplacementX;
  }
  if (ballY<=5) // y rebondit à 5 
  {
    deplacementY=-deplacementY ;
  }

  //a partir d'ici c'est le mouvement de la barre
  if (move>470) {
    move=0;
    rect(move, 700, 70, 10);
  }
  if (move<0) {
    move=470;
    rect(move, 700, 70, 10);
  }

  for (l=0; l<nb_ligne_niv2; l++) {
    for (i=0; i<nb_brique; i++) {
      if (mur_affichage_niv2[l][i]) {
        rect(mur_coord[l][i][0], mur_coord[l][i][1], mur_coord[l][i][2], mur_coord[l][i][3]);

        if ((ballX>mur_coord[l][i][0] && ballX<mur_coord[l][i][0]+mur_coord[l][i][2] && ballY>=mur_coord[l][i][1] && ballY<=mur_coord[l][i][1]+mur_coord[l][i][3])) {
          mur_affichage_niv2[l][i]=false; 
          deplacementX=-deplacementX;
        }
        if ((ballX>mur_coord[l][i][0] && ballX<mur_coord[l][i][0]+mur_coord[l][i][2] && (ballY==mur_coord[l][i][1] || ballY==mur_coord[l][i][1]+mur_coord[l][i][3]))) {
          mur_affichage_niv2[l][i]=false; 
          deplacementY=-deplacementY;
          deplacementX=-deplacementX;
        }
      }
    }
  }
  terminer = true;
  for (l=0; l<nb_ligne_niv2; l++) {
    for (i=0; i<nb_brique && terminer; i++) {
      if (mur_affichage_niv2[l][i]) {
        terminer=false;
      }
    }
  }
  if (terminer) {
    noLoop();
    setup();
    numeroScene=6;
    loop();
  }


  fill(123, 183, 175); 
  lostgame();
}

int nb_ligne_niv3=5;
boolean[][] mur_affichage_niv3 = new boolean[nb_ligne_niv3][nb_brique];


void init_niv3() {
  for (l=0; l<nb_ligne_niv3; l++) {
    for (i=0; i<nb_brique; i++) {
      mur_affichage_niv3[l][i] = random(0, 1) < 0.5;//création d'une inéquation à vérifier afin de faire une sorte de boolean
      if (i==0) {
        mur_coord[l][i][0]=coord_x;
      } else {
        mur_coord[l][i][0]=mur_coord[0][i-1][0]+mur_coord[0][i-1][2]+2;
      }
      mur_coord[l][i][1]=coord_y+l*(hauteur_y+2);
      mur_coord[l][i][2]=largeur_x;
      mur_coord[l][i][3]=hauteur_y;
    }
  }
 }

void NiveauAl() {
  ballX=ballX+deplacementX;
  ballY=ballY+deplacementY;  
  background(0);
  fill(228, 144, 113);
  ellipse (ballX, ballY, 10, 10);
  rect(move, 700, 70, 10);
  fill(158,239,228) ; 



  
  if (keyPressed==true) {
    if (keyCode==LEFT) {
      move=move-3;
    }
    if (keyCode==RIGHT) {
      move=move+3;
    }
  }
  if (ballX>=move && ballX<= move+70 && ballY==700 ) // si x est dans l'intervalle de la barre quand la balle atteint le niveau de la barre
  {
    deplacementY=-deplacementY;
  }

  if (ballX<=2 || ballX>=498) // x peut aller de 5 à 995 sinon il y a rebond 
  {
    deplacementX=-deplacementX;
  }
  if (ballY<=5) // y rebondit à 5 
  {
    deplacementY=-deplacementY ;
  }

  //a partir d'ici c'est le mouvement de la barre
  if (move>470) {
    move=0;
    rect(move, 700, 70, 10);
  }
  if (move<0) {
    move=470;
    rect(move, 700, 70, 10);
  }

  for (l=0; l<nb_ligne_niv3; l++) {
    for (i=0; i<nb_brique; i++) {
      if (mur_affichage_niv3[l][i]) {
        rect(mur_coord[l][i][0], mur_coord[l][i][1], mur_coord[l][i][2], mur_coord[l][i][3]);

        if ((ballX>mur_coord[l][i][0] && ballX<mur_coord[l][i][0]+mur_coord[l][i][2] && ballY>=mur_coord[l][i][1] && ballY<=mur_coord[l][i][1]+mur_coord[l][i][3])) {
          mur_affichage_niv3[l][i]=false; 
          deplacementX=-deplacementX;

        }
        if ((ballX>mur_coord[l][i][0] && ballX<mur_coord[l][i][0]+mur_coord[l][i][2] && (ballY==mur_coord[l][i][1] || ballY==mur_coord[l][i][1]+mur_coord[l][i][3]))) {
          mur_affichage_niv3[l][i]=false; 
          deplacementY=-deplacementY;
          deplacementX=-deplacementX;

        }
      }
    }
  }
  terminer = true;
  for (l=0; l<nb_ligne_niv3; l++) {
    for (i=0; i<nb_brique && terminer; i++) {
      if (mur_affichage_niv3[l][i]) {
        terminer=false;
      }
    }
  }
  if (terminer) {
    noLoop();
    setup();
    numeroScene=6;
    loop();
  }


  fill(123, 183, 175); 
  lostgame();
}

void Regles() {

  int x=mouseX;
  int y=mouseY;
  background(0);
  PImage fondInstructions ; 
  fondInstructions = loadImage("point-interrogation_fond-instructions.jpg");
  image(fondInstructions, -200,0,900,800);
  textSize(18);
  fill(57,125,164); 
  text("Bienvenue dans ce vieux jeu d'arcade cher joueur !", 30, 100);
  text("Voici les règles :", 30, 150);
  text("- Pour aller à gauche appuie sur la flèche gauche", 20, 200);
  text("- Pour aller à droite appuie sur la flèche droite.", 20, 250);
  text("- Si vous maintenez appuyée la touche droite ou", 20, 300);
  text(" gauche, la barre réapparaitra de l'autre côté.", 20, 320);
  textSize(70);
  text("BON JEU !", 100, 400);

  if (x<=150 && y>=730 && y<=770) {
    textSize(50);
    text("Menu", 20, 750);
  } else {
    textSize(40);
    text("Menu", 20, 750);
  }
  if (mousePressed==true) {
    if (x<=150 && y>=720 && y<=770) {
      numeroScene=0;
    }
  }
}

void win() {
  background(0);
  PImage fondWin ; 
  fondWin = loadImage ("fond_win_colore.png") ; 
  image(fondWin , -100, 0, 600, 800) ; 
  fill(255) ; 
  textSize(50);
  text("TU AS GAGNÉ !", 70, 400);
  textSize(20);
  text("Clique pour revenir au menu", 100, 600);
  


  if (mousePressed==true) {
      numeroScene=0;
  }
}