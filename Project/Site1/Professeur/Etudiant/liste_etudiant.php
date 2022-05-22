<?php require_once "..\..\Html\home_P.php";?>
<div id="search">
        <button type="button" class="close">×</button>
        <form method="GET" action="liste_etudiant.php?#about">
            <fieldset>
                <input type="search" name="q" placeholder="rechercher" aria-label="Search through site content">
            </fieldset>
            <fieldset>
                <button type="submit" class="main-button">Rechercher</button>
            </fieldset>
        </form>
    </div>
<?php require_once "..\..\Html\head/recherche.php";?>
<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'formation');
$mysqli -> set_charset("utf8");
if(isset($_GET['q']))
{
  $A= 10;
  $etud = $_GET['q'];
  $requete = "SELECT * FROM etudiants INNER JOIN groupe ON etudiants.groupe_id = groupe.groupe_id INNER JOIN filière ON groupe.filière_id = filière.filière_id WHERE  etudiant_CNE = '$etud' OR etudiant_nom = '$etud' OR etudiant_prenom = '$etud' OR etudiant_mail = '$etud' OR groupe_libellé = '$etud'  ";
  $resultat = $mysqli -> query($requete);
}                
else
{
  $A = $_GET['A'];
  $requete = "SELECT * FROM etudiants INNER JOIN groupe ON etudiants.groupe_id = groupe.groupe_id INNER JOIN filière ON groupe.filière_id = filière.filière_id  INNER JOIN affecter ON etudiants.groupe_id = affecter.groupe_id INNER JOIN enseigne ON enseigne.matière_id = affecter.matière_id WHERE etudiants.groupe_id > '$A' AND etudiants.groupe_id < '$A'+10 AND enseigne.professeur_id = '$professeur_CP' ";
  $resultat = $mysqli -> query($requete);
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="icon" type="image/png" href="..\..\Html\Tableau\images/icons/favicon.ico"/>
  <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\vendor/bootstrap/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="..\..\Htmlvendor/animate/animate.css">
  <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\vendor/select2/select2.min.css">
  <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\vendor/perfect-scrollbar/perfect-scrollbar.css">
  <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\css/util.css">
  <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\css/main7.css">
</head>
<body> 
  <div class="main-banner header-text" id="top">
    <div class="Modern-Slider">
      <div class="item">
        <div class="img-fill">
          <img src="../../Html/assets/images/slide.jpg" alt="">
          <div class="text-content">
            <ul>
              <?php echo"<a href='?A=$A#about' class='main-stroked-button'  >Afficher</a>" ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section class="section" id="about">
    <div class="container">
      <?php     
      if(mysqli_num_rows($resultat) > 0)
      {
        if(!empty($_GET['status'])){
          switch($_GET['status']){
             case 'succ':
                $statusType = 'alert-success';
                $statusMsg = 'Etudiants ajoutés avec succés.';
                break;
                case 'err':
                $statusType = 'alert-danger';
                $statusMsg = 'Un problème est survenu!!!.';
                break;
                case 'invalid_file':
                $statusType = 'alert-danger';
                $statusMsg = 'Charger le fichier !!!!.';
                break;
                default:
                $statusType = '';
                $statusMsg = '';
          }
        }
        if(!empty($statusMsg)){ ?>
          <div class="col-xs-12">
            <div class="alert <?php echo $statusType; ?>"><?php echo $statusMsg; ?></div>
          </div>
        <?php }?>                          
        <div class="limiter">
          <div class="container-table100">
            <div class="wrap-table100">
              <div class="table100 ver1 m-b-110">
                <div class="table100-head">
                  <table>
                    <thead>
                      <tr class="row100 head">
                        <th class="cell100 column1">CNE</th>
                        <th class="cell100 column2">Nom</th>
                        <th class="cell100 column3">Prénom</th>
                        <th class="cell100 column3">Email</th>
                        <th class="cell100 column5">Groupe</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <div class="table100-body js-pscroll">
                  <table>
                    <tbody>
                      <?php   
                      $i=0;   
                      while ($ligne = $resultat -> fetch_assoc()) 
                      {
                        $P=(int)($ligne['groupe_id']/10);
                        echo"
                        <tr class='row100 body'> 
                        <td class='cell100 column1'>$ligne[etudiant_CNE] </td>
                        <td class='cell100 column2'>$ligne[etudiant_nom]</td>
                        <td class='cell100 column3'>$ligne[etudiant_prenom]</td>
                        <td class='cell100 column4'>$ligne[etudiant_mail]</td>
                        <td class='cell100 column5'>$P-$ligne[groupe_libellé]-$ligne[filière_libellé]</td>
                        
                        </tr>";
                        $i=$i+1;                    
                      }                                            
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
             <?php echo"<h3>Total : $i</h3>"  ?>
            
            </div>
          </div>
        </div>
        <?php    
      }
      else if(isset($_GET['q'])){echo" <h5>Résultat Recherche du : $etud !!!! Aucun etudiant n'existe  " ;   }     
      else { $B = $A/10 ;echo" <h5>Vous n'enseigner aucun étudiant en $B année " ;}
      ?>
    </div>
  </section>
  
<footer>
  <div class="container">
    <div class="row">
      <div class="col-lg-6 col-xs-12">
        <div class="left-text-content">
          <p>Projet de Fin d'Année  (1ère Année)

            - Réaliser par: ZOBID Saad et EL FEKKAK hatim
          </div>
        </div>
        <div class="col-lg-6 col-xs-12">
          <div class="right-text-content">

            <li><p>Encadrer par : Mdm S.Aouad </p></li>

          </div>
        </div>
      </div>
    </div>
  </footer>
</body>
</html>