<?php require_once "..\..\Html\home_P.php"; ?>
<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'formation');
$mysqli -> set_charset("utf8");
$cours=$_GET['ID'];
$requete = "SELECT * FROM cours INNER JOIN matière ON cours.matière_id = matière.matière_id  WHERE cours.matière_id = '$cours' ";
$resultat = $mysqli -> query($requete);
 

?>
<!DOCTYPE html>

<html>
</html>
<head>
   
  <link rel="stylesheet" href="css\style240000.css">


</head>
<body> 

    <!-- ***** Main Banner Area Start ***** -->
    <div class="main-banner header-text" id="top">
        <div class="Modern-Slider">
          <!-- Item -->
          <div class="item">
            <div class="img-fill">
                <img src="../../Html/assets/images/slide.jpg" alt="">

                <div class="text-content">
                  
                    <?php echo"<a href='?ID=$cours#projects' class='main-stroked-button'  >Télécharger</a> "; ?>
                    <?php echo"<a href='?ID=$cours#contact-us' class='main-stroked-button'  >Charger</a> "; ?>
              </div>
          </div>
      </div>

  </div>
</div>

<section class="section" id="projects">
    <section class="section" id="testimonials">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-heading">
                        <h2>Cours</h2>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 mobile-bottom-fix-big" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                    <div class="owl-carousel owl-theme">
                        <?php 
                        while ($ligne = $resultat -> fetch_assoc() ) 
                        {
                          ?>
                          <div class="item author-item">
                            <div class="member-thumb">
                             <div class="hover-content">
                                        <ul>
                                            <li><a href="#"><i class="download"></i></a></li>
                                        </ul>
                                    </div> 
                            </div>
                            <h4> <?php echo"<a href='exporter.php?file=$ligne[cours_chemin]'><h4>$ligne[cours_libellé]</h4></a>"; ?></h4>
                            <?php echo " <a href='importer.php?IDc=$ligne[cours_id]&IDm=$ligne[matière_id]&ch=$ligne[cours_chemin]' class='btn btn-danger'>Supprimer</a> " ?>
                        </div>
                        <?php 
                    }
                    
                    
                    ?>
                    
                </div>
            </div>
        </div>
    </div>
</section>
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
                    <form action="importer.php" method="post" enctype="multipart/form-data">
                      <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <fieldset>
                               <?php echo "<input name='matière' type='text' value ='$cours'  id='subject'>"; ?>
                       </fieldset>
                   </div>
                   <div class="col-md-6 col-sm-12">
                            <fieldset>
                               <input name="cours" type="text" id="subject" placeholder="Nom du cours">
                       </fieldset>
                   </div>
                   <div class="row">
                      <div class="col-md-12 head">
                        
                  </div>
                  <div class="col-md-12">

                      <input type="file" name="file"/>
                      <button type="submit" name="submit" value="Upload" class="main-button-icon" >Charger<i class="fa fa-arrow-right"></i></button>
              </div>
             
            </div>     

          </div>
      </form>
                          
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

<!-- jQuery -->
<script src="..\..\Html\assets/js/jquery-2.1.0.min.js"></script>

<!-- Bootstrap -->
<script src="..\..\Html\assets/js/popper.js"></script>
<script src="..\..\Html\assets/js/bootstrap.min.js"></script>

<!-- Plugins -->
<script src="..\..\Html\assets/js/owl-carousel.js"></script>
<script src="..\..\Html\assets/js/scrollreveal.min.js"></script>
<script src="..\..\Html\assets/js/waypoints.min.js"></script>
<script src="..\..\Html\assets/js/jquery.counterup.min.js"></script>
<script src="..\..\Html\assets/js/imgfix.min.js"></script> 
<script src="..\..\Html\assets/js/slick.js"></script> 
<script src="..\..\Html\assets/js/lightbox.js"></script> 
<script src="..\..\Html\assets/js/isotope.js"></script> 

<!-- Global Init -->
<script src="..\..\Html\assets/js/custom.js"></script>

<script>

    $(function() {
        var selectedClass = "";
        $("p").click(function(){
            selectedClass = $(this).attr("data-rel");
            $("#portfolio").fadeTo(50, 0.1);
            $("#portfolio div").not("."+selectedClass).fadeOut();
            setTimeout(function() {
              $("."+selectedClass).fadeIn();
              $("#portfolio").fadeTo(50, 1);
          }, 500);
            
        });
    });

</script>

</body>
</html>