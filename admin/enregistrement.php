<?php
$bdd = new PDO('mysql:host=127.0.0.1;dbname=membre', 'root', '');
if(isset($_POST['submit'])) {

if (!empty($_POST['nom_utilisateur']) AND !empty($_POST['pn_utilisateur']) AND !empty($_POST['mail']) AND!empty($_POST['mail2'])AND !empty($_POST['mot_de_passe']) ) {

    $nom_utilisateur = htmlspecialchars($_POST['nom_utilisateur']);
    $pn_utilisateur = htmlspecialchars($_POST['pn_utilisateur']);
    $mail = htmlspecialchars($_POST['mail']);
    $mail2 = htmlspecialchars($_POST['mail2']);
    $mot_de_passe = sha1($_POST['mot_de_passe']);
     $mdp2 = sha1($_POST['mdp2']);
     $mdplength = strlen($mot_de_passe);
      if($mdplength >= 8) {
      if($mail == $mail2) {
        if(filter_var($mail, FILTER_VALIDATE_EMAIL)) {
               $reqmail = $bdd->prepare("SELECT * FROM user WHERE mail = ?");
               $reqmail->execute(array($mail));
               $mailexist = $reqmail->rowCount();
               if($mailexist == 0) {
                  if($mot_de_passe == $mdp2) {
                    $insertmbr = $bdd->prepare("INSERT INTO user (nom_utilisateur,pn_utilisateur, mail, mot_de_passe) VALUES(?,?,?,?)");
                    $insertmbr->execute(array($nom_utilisateur, $pn_utilisateur,$mail, $mot_de_passe));
                      $erreur ="Votre compte a bien été créé ! <a href=\"connexion.php\">Me connecter</a>";
                    }
                    else 
                  {$erreur = "Vos mots de passes ne correspondent pas !" ;}
             } else {$erreur = "Adresse mail déjà utilisée !";}
                  
               
         } else { $erreur = "Votre adresse mail n'est pas valide !";}
                
            
         }else {  $erreur = "Vos adresses mail ne correspondent pas !";
}
   } else {
         $erreur = "Votre mot de passe doit comporter au minimum 8 caractères !";
      }              

}  
    else
       $erreur ="tous les champs indiqués par * doivent être remplis";

}
?>

<!DOCTYPE html>
<html lang="FR">
<head>
    <title>Inscription</title>
    <meta charset="utf-8">
   <link href="connexion.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="styleInscription.css/"/>
      <link rel="stylesheet" href="dist/css/bootstrap.min.css"/>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <script src ="dist/js/jquery-3.4.1.min.js"></script>
      <script src ="dist/js/bootstrap.js"></script>
      <script src ="dist/js/main.js"></script>
</head>
<body>
     <!--logo-->
            <div class="col-md-2 col-xs-12">
              <div class="logo">
                <img src="image/news.png" class="displayed"style="width: 200px;">
              </div>
           </div>

<!-- form register -->
<form class="text-center border border-light p-5" method="POST"action="#!">

    <p class="h2 mb-4" style="font-weight: bold; color : navy ">Inscription</p>

            <!-- First name -->
                 <div class="form-row justify-content-center">
              <div class="input-group-append">
              <span class="input-group-text"><i class="fa fas fa-user"></i></span>
            <input type="text" id="" class="form-control"name="nom_utilisateur" placeholder="Nom*" style="width: 300px;height: 30px;" value="<?php if(isset($nom_utilisateur)) { echo $nom_utilisateur; } ?>">
        </div>
      </div>
    
        </br>

            <!-- Last name -->
             <div class="form-row justify-content-center">
            <div class="input-group-append">
              <span class="input-group-text"><i class="fa fas fa-user"></i></span>
            <input type="text" id="" class="form-control" name="pn_utilisateur"placeholder="Prénom*"style="width: 300px;height: 30px;" value="<?php if(isset($pn_utilisateur)) { echo $pn_utilisateur; } ?>">
        </div>
      </div>
    </div>

    </br>
    <!-- E-mail 1 -->
     <div class="form-row justify-content-center">
    <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-at"></i></span>
    <input type="email" id="" class="form-control"name="mail" placeholder="E-mail*"style="width: 300px;height: 30px;" value="<?php if(isset($mail)) { echo $mail; } ?>">
   </div>
 </div>
 </br>
 <!-- E-mail 2 -->
  <div class="form-row justify-content-center">
    <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-at"></i></span>
    <input type="email" id="" class="form-control"name="mail2" placeholder="Confirmation E-mail*"style="width: 300px;height: 30px;" value="<?php if(isset($mail2)) { echo $mail2; } ?>">
   </div>
 </div>
 </br>

    <!-- Password -->
    <div class="form-row justify-content-center">
    <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-key"></i></span>
    <input type="password" id="" class="form-control" name="mot_de_passe" placeholder="Mot de passe*"style="width: 300px;height: 30px;"  value="<?php if(isset($mot_de_passe)) { echo $mot_de_passe; } ?>">
    </div>
  </div>
    <small id="" class="form-text text-muted mb-4">
        Au moins 8 caractéres et 1 symbole
    </small>

    <!-- Password2 -->
    <div class="form-row justify-content-center">
    <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-key"></i></span>
    <input type="password" id="" class="form-control" name="mdp2" placeholder="Confirmation de mot de passe*"style="width: 300px;height: 30px;"  value="<?php if(isset($mdp2)) { echo $mdp2; } ?>">
    </div>
  </div>
    <small id="" class="form-text text-muted mb-4">
        Au moins 8 caractéres et 1 symbole
    </small>

    <!-- Phone number -->
         <div class="form-row justify-content-center">

     <div class="input-group-append">
    <span class="input-group-text"><i class="fa fas fa-phone"></i></span>
    <input type="text" id="" class="form-control" placeholder="Numéro de téléphone"style="width: 300px;height: 30px;">
     </div>
   </div>
   

     <!-- adresse-->

            <!-- adresse: rue-->
            <div class="form-row justify-content-center">
             <div class="input-group-append">
            <span class="input-group-text"><i class="fa fas fa-map-marker"></i></span>
            <input type="text" id="" class="form-control" placeholder="adresse : rue"style="width: 300px;height: 30px;">
          </div>
        </div>
      </div>
      <br>
       
            <!-- Code postal -->
            <div class="form-row justify-content-center">
               <div class="input-group-append">
            <span class="input-group-text"><i class="fa fas fa-location-arrow"></i></span>
      <input type="text" class="form-control"placeholder="Code postal"style="width: 300px;height: 30px;">
    </div>
  </div>
<br>

   <!-- Anniversaire -->
  <div class="form-row justify-content-center">
   <div class="input-group-append">
  <span class="input-group-text"><i class="fa fas fa-birthday-cake"></i></span>
  <input type="date"class="form-control" name="anniversaire"style="width: 300px;height: 30px;">
</div>
  </div>

    <!-- Newsletter -->
    <div class="custom-control custom-checkbox">
        <input type="checkbox" class="custom-control-input" id="defaultRegisterFormNewsletter">
        <label class="custom-control-label" for="defaultRegisterFormNewsletter">S'inscrire au journal</label>
    </div>


    <!-- Sign up button -->
   <div class="form-row justify-content-center">
    <div class="row">
    <div class="col-md-4 col-lg-2">
    <button class="btn btn-warning my-4 btn-block" type="submit" name="submit" style=" color: navy ;border: navy;font-weight: bold; width:300px;">Inscription</button>
  </div>
</div>
</div>
     

 <!-- Social register -->
            <p>ou s'inscrire avec:</p>
            <button type="button" class="btn btn-warning"style="width: 50px";><span class="fa fa-facebook-f"> </span></button>
             <button type="button" class="btn btn-warning"style="width: 50px";><span class="fa fab fa-twitter"> </span></button>

    <hr>

    <!-- Terms of service -->
    <p>En appuyant sur  
        <em>Inscription</em> vous acceptez  nos
        <a href="" style="color:navy">Conditions générales</a>
    </p>

    <p style="color:grey; font-size:9pt;float: right;text-align: justify;">
        *Champs obligatoires.
        <br>
    Ces champs sont obligatoires et sont destinés à WorldNews, responsable du traitement, aux fins d’effectuer l’ensemble des opérations relatives à notre relation commerciale, à savoir la création de votre compte, les modalités de paiement, de livraison, de gestion des réclamations et du service après-vente.<br>
    Conformément à la Règlementation sur les Données Personnelles, nous vous informons de l’existence du droit de demander à WorldNews l’accès à vos données, la rectification, l’effacement de celles-ci, ou une limitation du traitement relatif à vos données, ou le droit de vous opposer au traitement, le droit à la portabilité de vos données et ainsi que l’exercice de vos directives post-mortems..Pour plus d’information sur l’existence de vos droits ainsi que les moyens pour les mettre en œuvre, nous vous invitons à consulter l’Article III – Vos Droits de notre politique de confidentialité et de Protection de la Vie Privée.
</p>
</form>
</body>

<!--  form register -->
<?php if(isset($erreur)) {

            echo '<font color="red" ;font-weight:"bold">'.$erreur."</font>";}
            ?>
</html>