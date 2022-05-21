<?php require_once "..\..\Html\home.php";?>
<div id="search">
        <button type="button" lclass="close">×</button>
        <form method="GET" action="salle.php?#about">
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
        $sale = $_GET['q'];
        $requete = "SELECT * FROM salle WHERE salle_numero = '$sale' OR salle_libellé = '$sale' ";
        $resultat = $mysqli -> query($requete);
    }                
    else
    {
    $requete = "SELECT * FROM salle";
    $resultat = $mysqli -> query($requete);
     }
    ?>

<!DOCTYPE html>

<html>
<head>
    
  <link rel="icon" type="image/png" href="..\..\Html\Tableau\images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================--><!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="..\..\Htmlvendor/animate/animate.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\vendor/select2/select2.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="..\..\Html\Tableau\vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
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
                        <a href="?#contact-us" class="main-stroked-button">Ajouter</a>
                        <a href="?#about" class="main-stroked-button"  >Afficher</a>
                    </ul>

                  

                                  
                  
                </div>
            </div>
          </div>
          
          <!-- // Item -->
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
                $statusMsg = 'Salle ajoutées avec succés.';
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
      <?php } ?>
                            
<div class="limiter">
        <div class="container-table100">
            <div class="wrap-table100">
                <div class="table100 ver1 m-b-110">
                    <div class="table100-head">
                        <table>
                            <thead>
                                <tr class="row100 head">
                                            <th class="cell100 column1">Numero</th>
                                            <th class="cell100 column3">Nom de la salle</th>
                                            <th class="cell100 column5">Modifer</th>
                                            <th class="cell100 column5">Supprimer</th>
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
                                                
                                              echo"
                                              <tr class='row100 body'> 
                                                <td class='cell100 column1'>$ligne[salle_numero] </td>
                                                <td class='cell100 column3'>$ligne[salle_libellé]</td>
                                                 <td class='cell100 column5'>
                                                   <a  href='?NS=$ligne[salle_numero]&nom=$ligne[salle_libellé]#contact-us' class='btn btn-primary'>Editer</a>
                                                </td>
                                                <td class='cell100 column5'><a href='listesallecontrooller.php?ID=$ligne[salle_numero]' class='btn btn-danger'>Supprimer</a></td>
                                                </tr>"; 
                                                 $i=$i+1;
                                             }
                                               
                                                                     
                                             ?>
                                



                            </tbody>
                        </table>
                    </div>
                </div>
                <?php echo"<h3>Total : $i</h3>"  ?>
            <div class="panel-heading">
            <a href="exporter.php" class="btn btn-success pull-right">Exporter fichier excel(CSV) </a>
          </div>
            
            </div>
        </div>
    </div>
        <?php    }
                else{echo" <h5>Résultat Recherche du : $sale !!!! Aucune salle n'existe  " ;   }       ?>

        </div>
    </section>

   
    <section class="section" id="contact-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="left-text-content">
                        <div class="section-heading">
                            
                        </div>
                    </div>
                </div>

                <div class="col-lg-8 col-md-8 col-xs-12">
                    <div class="contact-form">
                        <form method="POST" action="listesallecontrooller.php">
                          <div class="row">
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                <?php
                                   if(isset($_GET['NS'])){
                                    echo "<input type='text' name='NS' value=$_GET[NS]> ";
                                    }
                                    else{
                                    ?>
                                    <input name="id" type="number" id="subject" placeholder="Numero">
                                    <?php } ?>
                              </fieldset>
                            </div>
                            <?php
                                   
                            ?>
                            <div class="col-md-6 col-sm-12">
                              <fieldset>
                                 <?php
                                 if(isset($_GET['NS']))
                                   {
                                      echo "<input type='text' name='nom' value=$_GET[nom]> ";
                                  }
                                    else{
                                    ?>
                                    <input name="salle" type="text" id="subject" placeholder="Nom de la salle">
                                    <?php } ?>
                              </fieldset>
                            </div>
                            <div class="col-lg-12">
                              <fieldset>
                                <button type="submit" id="ajouter" class="main-button-icon" name="ajout">Ajouter<i class="fa fa-arrow-right"></i></button>
                                 <button type="submit" id="modifier" class="main-button-icon" name="modifier">Modifier<i class="fa fa-arrow-right"></i></button>
                                <?php
                                 if(isset($_GET['NS'])){
                                    ?>
                               <script type="text/javascript"> document.getElementById("modifier").style.display = "block"; document.getElementById("ajouter").style.display = "none"; </script>
                                <?php
                                 }
                                 else{
                                    ?>
                                <script type="text/javascript"> document.getElementById("modifier").style.display = "none"; document.getElementById("ajouter").style.display = "block";</script>
                                 <?php }   ?>
                              </fieldset>
                            </div>
                          </div>
                        </form>
                            <div class="row">
                              <div class="col-md-12 head">
                                <div class="float-right">
                                  <a href="javascript:void(0);" class="btn btn-success" onclick="formToggle('importFrm');"><i class="plus"></i> Importer fichier excel(CSV)</a>
                              </div>
                          </div>
                          <div class="col-md-12" id="importFrm" style="display: none;">
                            <form action="importer.php" method="post" enctype="multipart/form-data">
                              <input type="file" name="file" />
                              <button type="submit" id="ajouter" class="main-button-icon" name="importSubmit" value="IMPORT">Importer<i class="fa fa-arrow-right"></i></button>
                          </form>
                      </div>
                      <script>
                        function formToggle(ID){
                          var element = document.getElementById(ID);
                          if(element.style.display === "none"){
                            element.style.display = "block";
                        }else{
                            element.style.display = "none";
                        }
                    }
                    </script>
                    </div>
                </div>
            </div>
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