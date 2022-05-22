<?php require_once "..\..\Html\home_P.php"; ?>
<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'formation');
$mysqli -> set_charset("utf8");
$requete = "SELECT * FROM matière WHERE professeur_CP =  '$professeur_CP'";
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
                  <h3>Bonjour <?php echo $fetch_info['professeur_nom'] ?> <?php echo $fetch_info['professeur_prenom'] ?> </h3>

                  
              </div>
          </div>
      </div>

  </div>
</div>
<div class="scroll-down scroll-to-section"><a href="#about"><i class="fa fa-arrow-down"></i></a></div>
<section class="section" id="about">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-xs-12">
                <div class="left-text-content">
                 <div class="container">

                    <?php 

                    $Date_f = date('Y-m-d', strtotime('+4 day'));
                    $Date_d = date('Y-m-d'); 
                    $programme =  "SELECT DISTINCT programme_date FROM programme WHERE professeur_CP  = '$professeur_CP' AND programme_date >= '$Date_d' AND programme_date <= '$Date_f'   ORDER BY programme_date ASC ";
                    $run_programme = mysqli_query($con, $programme);

                    setlocale(LC_TIME, "fr_FR","French");
                    $Dated = strftime("%A %d %B %Y", strtotime($Date_d));
                    $Datef = strftime("%A %d %B %Y", strtotime($Date_f)); 

                    echo "<h4><strong>Du $Dated au $Datef </strong></h4>" ;
                    ?> <table><tr>  <?php
                    while($ligne = $run_programme -> fetch_assoc())
                    {

                        ?> 
                        <td> <div class="container2"> 
                           <?php
                           $format = $ligne['programme_date'];
                           setlocale(LC_TIME, "fr_FR","French");
                           $newDate  = strftime("%A %d %B %Y", strtotime($format));
                           $timestamp = strtotime($format); 
                           $test = date("l", $timestamp) ;

                           if($test != 'Sunday')
                           {
                            echo"<h3>$newDate</h3>   ";
                            $jours=$ligne['programme_date'];                                       
                            $programme_j =  "SELECT * FROM programme INNER JOIN matière ON programme.matière_id = matière.matière_id INNER JOIN groupe ON programme.groupe_id  = groupe.groupe_id  INNER JOIN salle ON programme.salle_id = salle.salle_numero  WHERE programme_date = '$jours' AND programme.professeur_CP = '$professeur_CP' ORDER BY programme_début ASC ";
                            $run_programme_j = mysqli_query($con, $programme_j);
                            while($ligne = $run_programme_j -> fetch_assoc())
                            {

                                if(mysqli_num_rows($run_programme_j) > 0)
                                {
                                  echo " 
                                  <div class='timeline-item' date-is='Du $ligne[programme_début]  A  $ligne[programme_fin]' >
                                  <h1>Matière : $ligne[matière_libellé] </h1>
                                  <p>
                                  <b> Groupe  : $ligne[groupe_libellé]  </b>
                                  </p>
                                   <p>
                                                             <b> Salle  : $ligne[salle_libellé]  </b>
                                                        </p>
                                  </div>

                                  ";
                              }
                              else
                                {echo " pas encore programmé </div>";}

                        }
                    }
                    ?> </div></td>  <?php    
                }
                ?> </tr></table>
            </div>
        </div>
    </div>
</div>
</div>
</section>


<!-- ***** Testimonials Starts ***** -->
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
                            <h4> <?php echo"<a href='../up_cours/up_cours.php?ID=$ligne[matière_id]&nom=$ligne[matière_libellé]'><h4>$ligne[matière_libellé]</h4></a>"; ?></h4>
                            <span><?php echo"$ligne[matière_id]"?></span>
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