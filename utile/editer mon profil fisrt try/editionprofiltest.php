<?php
//pour que les variables de sessions soient utilisable
session_start();

    //variable qui nous connecte à notre base de donnée appellé tets_espace_membre
    $bdd = new PDO('mysql:host=127.0.0.1;dbname=membre', 'root', '');

    if(isset($_SESSION['id_utilisateur']))
    {
        $requser = $bdd ->prepare('SELECT * FROM membre WHERE id_utilisateur = ?');
        $requser -> execute(array($_SESSION['id_utilisateur']));
        $user = $requser -> fetch();
        //vérifier que l'utilisateur n'a pas saisit le même nom ajouter ** AND $_POST['newprenom'] != $user['pn_utilisateur']) **
        
        if (isset($_POST['newnom']) AND !empty($_POST['newnom']) AND ($_POST['newnom'] != $user['nom_utilisateur'])) 
        {
          //creer la variable new pseudo ce qui permet de sécuriser notre variable
          $newnom = htmlspecialchars($_POST[('newnom')]);
          // mettre à jour le nom dans la base
          $insertnom = $bdd ->prepare("UPDATE membre SET nom_utilisateur = ? WHERE id_utilisateur = ?");
          // exécuter la requette
          $insertnom -> execute(array($newnom, $_SESSION['id_utilisateur']));
          //rédériger l'utilisateur vers son profil 
          header('Location: profil.php?id='.$_SESSION['id_utilisateur']);
        }

         //vérifier que l'utilisateur n'a pas saisit le même prenom
        if (isset($_POST['newprenom']) AND !empty($_POST['newprenom']) AND ($_POST['newprenom'] != $user['pn_utilisateur'])) 
        {
         //creer la variable new pseudo ce qui permet de sécuriser notre variable
          $newprenom = htmlspecialchars($_POST[('newprenom')]);
          // mettre à jour le nom dans la base
          $insertprenom = $bdd ->prepare("UPDATE membre SET pn_utilisateur = ? WHERE id_utilisateur = ?");
          // exécuter la requette
          $insertprenom -> execute(array($newprenom, $_SESSION['id_utilisateur']));
          //rédériger l'utilisateur vers son profil 
          header('Location: profil.php?id='.$_SESSION['id_utilisateur']);
        }

        //vérifier que l'utilisateur n'a pas saisit le même mail
        if (isset($_POST['newmail']) AND !empty($_POST['newmail']) AND ($_POST['newmail'] != $user['mail'])) 
        {
         //creer la variable new pseudo ce qui permet de sécuriser notre variable
          $newmail = htmlspecialchars($_POST[('newmail')]);
          // mettre à jour le nom dans la base
          $insertmail = $bdd ->prepare("UPDATE membre SET mail = ? WHERE id_utilisateur = ?");
          // exécuter la requette
          $insertmail -> execute(array($newmail, $_SESSION['id_utilisateur']));
          //rédériger l'utilisateur vers son profil 
          header('Location: profil.php?id='.$_SESSION['id_utilisateur']);
        }

         //pour le mdp on en peut pas vérifier !  
        if (isset($_POST['newmdp1']) AND !empty($_POST['newmdp1']) AND isset($_POST['newmdp2']) AND !empty($_POST['newmdp2'])) 
        {
         
         $mdp1 = sha1($_POST['newmdp1']);
         $mdp2 = sha1($_POST['newmdp2']);

         // vérifier si le les deux mots de masse correspondent !
         if($mdp1 == $mdp2)
         {

          // mettre à jour le nom dans la base
          $insertmdp = $bdd ->prepare("UPDATE membre SET mot_de_passe = ? WHERE id_utilisateur = ?");
          // exécuter la requette
          $insertmdp -> execute(array($mdp1, $_SESSION['id_utilisateur']));
          //rédériger l'utilisateur vers son profil 
          header('Location: profil.php?id='.$_SESSION['id_utilisateur']);
        }
        else
        {
           $msg = " Vos deux mots de passe ne correspondent pas !" ;
        }
      }



      


       


?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <title>Edition de mon profil</title>
    <meta charset="utf-8">
   <link href="editionprofil.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="shortcut icon" href="images/favicone.jpg" type="image/jpg">
    <link rel="stylesheet" href="styleInscription.css/"/>
      <link rel="stylesheet" href="dist/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src ="dist/js/jquery-3.4.1.min.js"></script>
      <script src ="dist/js/bootstrap.js"></script>
      <script src ="dist/js/main.js"></script>
</head>
<body>
     
<!----LA PHOTO MAP ET LE NOM DU SITE TOUT EN HAUT DE LA PAGE
<div class="jumbotron text-center titlebackground" style=" margin-bottom: 0px";>
      <h1 style="font-family: cursive; color: white;"> WORLD NEWS</h1>
      <p style="font-family: cursive; color: white;">Forgez vous votre propre opinion ! </p>
   </div>
--->
   <!----LA PHOTO logo ET LE NOM DU SITE TOUT EN HAUT DE LA PAGE ---->
   <div class="jumbotron text-center titlebackground img-responsive" style=" margin-bottom: 0px;";>
      <br><br><br><br><br>
   </div> 

  <!---BARE DE MENU --->
  <nav class="navbar navbar-expand-sm  navbar-dark">
  <a class="navbar-brand" href="#" style="color: white; font-weight: bold;" >WORLD NEWS</a>
  <!-- bouton une fois responsif -->
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="collapsibleNavbar">
    <ul class="nav nav-pills col-6" role="tablist" >

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

      <!--- VIDEO 
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
      </li> --->

             <!--- VIDEOS --->
  <li class="nav-item active"> <a class="nav-link" href="#" style="color: navy; font-weight: bold;">VIDEOS <span class="sr-only">(current)</span></a> </li>

       <!--- BIBLIOTHEQUE --->
       <li class="nav-item active"> <a class="nav-link" href="#" style="color: navy; font-weight: bold;">BIBLIOTHEQUE <span class="sr-only">(current)</span></a> </li>




      <!--- CONTACT --->


       <li class="nav-item active"> <a class="nav-link" href="#" style="color: navy; font-weight: bold;">CONTACT <span class="sr-only">(current)</span></a> </li>




      
    
    </ul>
    <!---SEARCH---->
    <h1 class="col-3"></h1>
      <input class="form-control col-3" type="search" placeholder="Search" aria-label="Search" >
    
      <!---S'INSCRIRE---->
      
    
     
     
    

 
 <!---sE CONNECTE---->

  </div>
</nav>
<!---FIN NAVBAR ---->


<!---FIN NAVBAR ---->
<!-- form register -->
<form class="text-center border border-light p-5" method="POST"action="#!">

    <p class="h2 mb-4" style="font-weight: bold; color : navy ">Edition de mon profil </p>
    <br>

              <?php if(isset($msg)) { echo '<strong align="center">'.'<font color="red">'.$msg."</font>".'</strong>'; } ?>

            <!-- First name -->
                 <div class="form-row justify-content-center">
              <div class="input-group-append">
              <span class="input-group-text"><i class="fa fas fa-user"></i></span>
            


            <input type="text" class="form-control" style="width: 300px;height: 30px;" name="newnom" placeholder="Nom" value="<?php echo $user['nom_utilisateur']; ?>" />

        </div>
      </div>
    
        </br>

            <!-- Last name -->
             <div class="form-row justify-content-center">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fa fas fa-user"></i></span>

            <input type="text" class="form-control" style="width: 300px;height: 30px;" name="newprenom" placeholder="Prenom" value="<?php echo $user['pn_utilisateur']; ?>" />

        </div>
      </div>
    </div>

    </br>
    <!-- E-mail 1 -->
     <div class="form-row justify-content-center">
    <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-at"></i></span>
    

    <input type="mail" class="form-control" style="width: 300px;height: 30px;" name="newmail" placeholder="mail" value="<?php echo $user['mail']; ?>"/> 

   </div>
 </div>
 </br>


    <!-- Password -->
    <div class="form-row justify-content-center">
    <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-key"></i></span>

    <input type="password" class="form-control" style="width: 300px;height: 30px;" name="newmdp1" placeholder="Mot de passe"/>

    </div>
  </div>
    
    </br>

    <!-- Password2 -->
    <div class="form-row justify-content-center">
    <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-key"></i></span>
    <input type="password" class="form-control" style="width: 300px;height: 30px;" name="newmdp2" placeholder="Confirmation du mot de passe"/> 

    </div>
  </div>
    

    
<br>


    <!-- Sign up button -->
   <div class="form-row justify-content-center">
    <div class="row">
    <div class="col-md-4 col-lg-2">
    <button class="btn btn-warning my-4 btn-block" type="submit" name="submit" style=" color: navy ;border: navy;font-weight: bold; width:300px;">Mettre à jour mon profil ! </button>
  </div>
</div>
</div>


     

 <!-- Social register -->
            

    <hr>

    
</form>
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

else
{
  header("Location: seconnecter.php");
}

?>
