<?php
//pour que les variables de sessions soient utilisable
session_start();

    //variable qui nous connecte à notre base de donnée appellé tets_espace_membre
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=test_espace_membre', 'root', '');

    if(isset($_GET['id'])AND $_GET['id'] > 0)
    {
        $getid = intval($_GET['id']);
        $requser = $bdd ->prepare('SELECT * FROM membre WHERE id = ?');
        $requser -> execute(array($getid));
        $userinfo = $requser -> fetch();

    
   
?>




<!DOCTYPE html>
<html>
    
<head>
    <title>My Awesome Login Page</title>
    <meta charset="utf-8">
      <!----LIEN FICHIER CSS---->
    <link href="profil.css" rel="stylesheet">
     <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>

<body>

   <!----LA PHOTO logo ET LE NOM DU SITE TOUT EN HAUT DE LA PAGE ---->
   <div class="jumbotron text-center titlebackground" style=" margin-bottom: 0px";>
      <br><br><br><br>
   </div> 

  <!---BARE DE MENU --->
  <nav class="navbar navbar-expand-sm  navbar-dark">
  <a class="navbar-brand" href="#" style="color: white; font-weight: bold;" >WORLD NEWS</a>
  <!-- bouton une fois responsif -->
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">

      <!---A LA UNE--->

      <li class="nav-item active"> <a class="nav-link" href="#" style="color: navy; font-weight: bold;">A LA UNE <span class="sr-only">(current)</span></a> </li>

      <!--- ARTICLE --->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: navy; font-weight: bold;"> ARTICLES  </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">International </a>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Politique</a>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Societé</a>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Sport</a>
          <a class="dropdown-item" href="#"style="color: navy; font-weight: bold;">Santé</a>
          <a class="dropdown-item" href="#"style="color: navy; font-weight: bold;">Développement personnel</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Autres</a>
        </div>
      </li>

      <!--- VIDEO --->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: navy; font-weight: bold;">
          VIDEOS
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Action</a>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Something else here</a>
        </div>
      </li>

       <!--- BIBLIOTHEQUE --->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: navy; font-weight: bold;">
          BIBLIOTHEQUE
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Action</a>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;" >Something else here</a>
        </div>
      </li>

      <!--- CONTACT --->
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="color: navy; font-weight: bold;" >
          CONTACT
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;" >Action</a>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#" style="color: navy; font-weight: bold;">Something else here</a>
        </div>
      </li>
    
    </ul>
    <!---SEARCH---->

    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search" style="width: 180px; height: 30px;">
      <!---S'INSCRIRE---->
      
     
    </form>



 
 <!---sE deCONNECTE---->
    <form method="POST" action="seconnecter.php">
        <input type="submit" name="sedeconnecter" value="Se déconnecter" style="color: navy; font-weight: bold; background-color: #EAB60A;" >
    </form>

  </div>
</nav>

<!---FIN NAVBAR ---->
   
   <br> 
    <div align ="center">
             <h2 style="color: navy; font-family: cursive; font-size: 20px; font-weight: bold;"> Bienvenu <?php echo $userinfo['pseudo']; ?> ! </h2>
             <h2 style="color: navy; font-family: cursive; font-size: 20px; font-weight: bold;"><?php echo $userinfo['mail']; ?> </h2>
            <br>

        <!---editer mon profil si c mon profil!---> 
         <?php
         if(isset($_SESSION['id']) AND $userinfo['id'] == $_SESSION['id'])
         {
          ?>
          <a href="#" > Editer mon profil </a>
          <a href="deconnexion.php" > Se déconnecter </a>
          <?php
         }
      ?>
    </div>

    <!---------------------------------------------------------------LE CORPS DE LA PAGE------------------------------------------------------------>

<div class="container" style="margin-top:30px;" >
  <div class="row">
              <!---------------------------------------------------------------LA PARTIE A GAUCHE-------------------------------------------------------------->
    <!------------------LA PARTIE INSCRIPTION----------------------->
    <div class="col-sm-5">
      <div id="inscri" class="row text-center">
      <div class="col-sm-12">
      <button type="submit" class="btn btn-primary">Inscription</button></br>
      <button type="submit" class="btn btn-primary">Connexion</button></br>
      </div>
      </div>

      <hr class="regle">

      <!------------------LA PARTIE ARTICLES LES PLUS LUS ----------------------->
      <div class="row">
        <div class="col-sm-12">
          <h3 class="lalpl">Les articles les plus lus</h3>
          <ol class="olart">
            <li class="liart"><a class="titreart" href="#">"Robert Mugabe: le héros de la libération nationale diabolisé pour avoir essayé de donner un sens à la libération"</a></li>
            <hr/>
            <li class="liart"><a class="titreart" href="#">"Robert Mugabe: le héros de la libération nationale diabolisé pour avoir essayé de donner un sens à la libération"</a></li>
            <hr/>
            <li class="liart"><a class="titreart" href="#">"Robert Mugabe: le héros de la libération nationale diabolisé pour avoir essayé de donner un sens à la libération"</a></li>
            <hr/>
          </ol>
        </div>
      </div>

      <hr class="regle">

      <!------------------LA PARTIE ARTICLES DU MOIS ----------------------->

      <div class="row">
        <div class="col-sm-12">
          <h3 class="ladm">Les articles du mois</h3>
          <ol class="olart">
            <li class="liart"><a class="titreart" href="#">"Robert Mugabe: le héros de la libération nationale diabolisé pour avoir essayé de donner un sens à la libération"</a></li>
            <hr/>
            <li class="liart"><a class="titreart" href="#">"Robert Mugabe: le héros de la libération nationale diabolisé pour avoir essayé de donner un sens à la libération"</a></li>
            <hr/>
            <li class="liart"><a class="titreart" href="#">"Robert Mugabe: le héros de la libération nationale diabolisé pour avoir essayé de donner un sens à la libération"</a></li>
            <hr/>
          </ol>
        </div>
      </div>
      <hr class="regle">

      <!------------------ATTENTION MEDIA ----------------------->

      <div id="cadre" class="row text-center">
      <div class="col-sm-12">
        <div class="fakeimgAM">
          <a href="#"><img class="imageAM" src="images/top.jpg"></a>
            <div id="banniere_descriptionH">
              ATTENTION MEDIAS
            </div>
          </div>
      </div>
      </div>
      <hr class="regle">


      <!------------------L'AUTRE HISTOIRE ----------------------->

      <div id="cadre" class="row text-center">
      <div class="col-sm-12">
        <div class="fakeimgAM">
          <a href="#"><img class="imageAM" src="images/autre-histoire-bannière.jpg"></a>
            <div id="banniere_descriptionH">
              L'AUTRE HISTOIRE
            </div>
          </div>
      </div>
      </div>
      <hr class="regle">

      <!------------------LA RUBRIQUE DU DIMANCHE----------------------->

      <div id="cadre" class="row text-center">
      <div class="col-sm-12">
        <div class="fakeimgAM">
          <a href="#"><img class="imageAM" src="images/autre-histoire-bannière.jpg"></a>
            <div id="banniere_descriptionH">
              LA RUBRIQUE DU DIMANCHE
            </div>
          </div>
      </div>
      </div>
      <hr class="regle">


       <!------------------LA RUBRIQUE DE SAÏD BOUAMAMA----------------------->

      <div id="cadre" class="row text-center">
      <div class="col-sm-12">
        <div class="fakeimgAM">
          <a href="#"><img class="imageAM" src="images/said-bannire.jpg"></a>
            <div id="banniere_descriptionH">
              LA RUBRIQUE DE SAÏD BOUAMAMA
            </div>
          </div>
      </div>
      </div>
      <hr class="regle">


      <!------------------LA RUBRIQUE DE SAÏD BOUAMAMA----------------------->

      <div id="cadre" class="row text-center">
      <div class="col-sm-12">
        <div class="fakeimgAM">
          <a href="#"><img class="imageAM" src="images/said-bannire.jpg"></a>
            <div id="banniere_descriptionH">
              LA RUBRIQUE DE SAÏD BOUAMAMA
            </div>
          </div>
      </div>
      </div>
      <hr>
    </div>

          <!---------------------------------------------------------------LA PATIE D'ARTICLES-------------------------------------------------------------->
    <div class="col-sm-7">
      <!---------------------------------------------------------------LA PREMIERE PATIE D'ARTICLES-------------------------------------------------------------->
    <div class="row">
    <div class="col-sm-12">
      <h2>AFRIQUE</h2>
      <h5>Dec 7, 2017</h5>
      <div class="row" >
        <div class="col-sm-6">
          <div class="fakeimg1">
            <div id="banniere_description">
              Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="fakeimg2">
            <div id="banniere_description">
              Retour sur mes vacances aux États-Unis...
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row" >
        <div class="col-sm-6">
          <div class="fakeimg1">
            <div id="banniere_description">
              Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="fakeimg2">
            <div id="banniere_description">
              Retour sur mes vacances aux États-Unis...
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <hr class="reglebis">

                  <!----------------------------------------------------------------------------------------------------------------------------->

    <!---------------------------------------------------------------LA DEUXIEME PATIE D'ARTICLES--------------------------------------------------------------><div class="col-sm-12">
      <h2>AMERIQUE</h2>
      <h5>Dec 7, 2017</h5>
      <div class="row" >
        <div class="col-sm-6">
          <div class="fakeimg1">
            <div id="banniere_description">
              Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="fakeimg2">
            <div id="banniere_description">
              Retour sur mes vacances aux États-Unis...
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row" >
        <div class="col-sm-6">
            <div class="fakeimg1">
              <div id="banniere_description">
                Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
                <span class="portfolio-icon-wraper">
                  <a href="#"><i class='fas fa-eye'></i></i></a>
                </span>
              </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="fakeimg2">
              <div id="banniere_description">
                Retour sur mes vacances aux États-Unis...
                <span class="portfolio-icon-wraper">
                  <a href="#"><i class='fas fa-eye'></i></i></a>
                </span>
              </div>
            </div>
        </div>
      </div>
    </div>
    <hr class="reglebis">

                <!----------------------------------------------------------------------------------------------------------------------------->

    <!--------------------------------------------------------------------------LASIE---------------------------------------------------------------------->
    <div class="col-sm-12">
      <h2>ASIE</h2>
      <h5>Dec 7, 2017</h5>
      <div class="row" >
        <div class="col-sm-6">
          <div class="fakeimg1">
            <div id="banniere_description">
              Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="fakeimg2">
            <div id="banniere_description">
              Retour sur mes vacances aux États-Unis...
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row" >
        <div class="col-sm-6">
            <div class="fakeimg1">
              <div id="banniere_description">
                Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
                <span class="portfolio-icon-wraper">
                  <a href="#"><i class='fas fa-eye'></i></i></a>
                </span>
              </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="fakeimg2">
              <div id="banniere_description">
                Retour sur mes vacances aux États-Unis...
                <span class="portfolio-icon-wraper">
                  <a href="#"><i class='fas fa-eye'></i></i></a>
                </span>
              </div>
            </div>
        </div>
      </div>
    </div>
    <hr class="reglebis">
                 <!----------------------------------------------------------------------------------------------------------------------------->


    <!---------------------------------------------------------------LA DEUXIEME PATIE D'ARTICLES-------------------------------------------------------------->
    <div class="col-sm-12">
      <h2>EUROP</h2>
      <h5>Dec 7, 2017</h5>
      <div class="row" >
        <div class="col-sm-6">
          <div class="fakeimg1">
            <div id="banniere_description">
              Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="fakeimg2">
            <div id="banniere_description">
              Retour sur mes vacances aux États-Unis...
              <span class="portfolio-icon-wraper">
                <a href="#"><i class='fas fa-eye'></i></i></a>
              </span>
            </div>
          </div>
        </div>
      </div>
      <div class="row" >
        <div class="col-sm-6">
            <div class="fakeimg1">
              <div id="banniere_description">
                Guerre en Ukraine : Paris accueillera le 9 décembre un sommet quadripartite
                <span class="portfolio-icon-wraper">
                  <a href="#"><i class='fas fa-eye'></i></i></a>
                </span>
              </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="fakeimg2">
              <div id="banniere_description">
                Retour sur mes vacances aux États-Unis...
                <span class="portfolio-icon-wraper">
                  <a href="#"><i class='fas fa-eye'></i></i></a>
                </span>
              </div>
            </div>
        </div>
      </div>
    </div>
    <hr class="reglebis">
              <!----------------------------------------------------------------------------------------------------------------------------->
    </div>
    </div>
  </div>
</div>
         <!----------------------------------------------------------------------------------------------------------------------------->


    <!----FOOTER---->
<footer id="footer class="page-footer font-small stylish-color-dark pt-4">
<hr>
  <!-- Footer Links -->
  <div class=" text-center text-md-left">

    <!-- Grid row -->
    <div class="row">

      <!-- Grid column -->
      <div class="col-md-4 mx-auto">

        <!-- Content -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4"> Nous contacter</h5>
        <ul class="list-unstyled">
          <li>
            <a href="#!"  style="color: navy; font-weight: bold;">Téléphone: 07 07 06 05 0</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Mail : news@gmail.com</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Adresse:Avenue Monge, 37200 Tours, France</a>
          </li>
        </ul>

      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- Rubriques du site -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Rubriques du site</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!"  style="color: navy; font-weight: bold;";">International</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Politique</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Société</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Sport</a>
          </li>
           <li>
            <a href="#!" style="color: navy; font-weight: bold;">Santé</a>
          </li>
           <li>
            <a href="#!" style="color: navy; font-weight: bold;">Développement personnel</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- 2-Mentions légales -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Mentions légales</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Charte du Groupe</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Politique de confidentialité</a>
          </li>
          <li>
            <a href="#!"s style="color: navy; font-weight: bold;">Gestion des cookies</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Aide (FAQ)</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->

      <hr class="clearfix w-100 d-md-none">

      <!-- Grid column -->
      <div class="col-md-2 mx-auto">

        <!-- 3-Nous contacter -->
        <h5 class="font-weight-bold text-uppercase mt-3 mb-4">Nous contacter</h5>

        <ul class="list-unstyled">
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Facebook</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Youtube</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Twitter</a>
          </li>
          <li>
            <a href="#!" style="color: navy; font-weight: bold;">Fil RSS</a>
          </li>
        </ul>
      </div>
      <!-- Grid column -->
    </div>
    <!-- Grid row -->
  </div>
  <!-- Copyright -->
  <hr color=white width="50%">
  <div class="footer-copyright text-center py-3">© 2020 Copyright: WorldNews
  </div>
  <!-- Fin Copyright -->
</footer>
<!----FOOTER---->
</body>
</html>

<?php

}


?>


