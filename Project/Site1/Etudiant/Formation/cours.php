<?php require_once "..\..\Html\home_E.php"; ?>
  <?php
    $mysqli = mysqli_connect('localhost', 'root', '', 'formation');
    $mysqli -> set_charset("utf8");
    $requete = "SELECT * FROM matière";
    $resultat = $mysqli -> query($requete);
    ?>


<!DOCTYPE html>
<body>
    <div class="dummy-text">
     <div class="wrapper2">
     	<?php 
      if(isset($_GET['SE']))
      {
            $SE=$_GET['SE'] ;
            if ($SE == 1)
            {
            while ($ligne = $resultat -> fetch_assoc() ) 
            {
              if($ligne['matière_id']>1100 && $ligne['matière_id']<1200)
              {
      ?>
    <div class="box">
      <i class="fas fa-quote-left quote"></i>
      <div class="content">
        <div class="info">
          <div class="name">
            <?php 
            echo"<a	href='up-down-cours.php?ID=$ligne[matière_id]'>$ligne[matière_libellé]</a>"; 
            ?>
          	</div>
          <div class="job"><?php echo"$ligne[matière_id]"?></div>
          <div class="stars">
         
          </div>
        </div>
      </div>
    </div>
    <?php 
    }
   }
  }
  if ($SE == 2)
            {
            while ($ligne = $resultat -> fetch_assoc() ) 
            {
              if($ligne['matière_id']>1200 && $ligne['matière_id']<1300)
              {
      ?>
    <div class="box">
      <i class="fas fa-quote-left quote"></i>
      <div class="content">
        <div class="info">
          <div class="name">
            <?php 
            echo"<a href='up-down-cours.php?ID=$ligne[matière_id]'>$ligne[matière_libellé]</a>"; 
            ?>
            </div>
          <div class="job"><?php echo"$ligne[matière_id]"?></div>
          <div class="stars">
    
          </div>
        </div>
      </div>
    </div>
    <?php 
    }
   }
  }
  if ($SE == 3)
            {
            while ($ligne = $resultat -> fetch_assoc() ) 
            {
              if($ligne['matière_id']>2300 && $ligne['matière_id']<2400)
              {
      ?>
    <div class="box">
      <i class="fas fa-quote-left quote"></i>
      <div class="content">
        <div class="info">
          <div class="name">
            <?php 
            echo"<a href='up-down-cours.php?ID=$ligne[matière_id]'>$ligne[matière_libellé]</a>"; 
            ?>
            </div>
          <div class="job"><?php echo"$ligne[matière_id]"?></div>
          <div class="stars">
          </div>
        </div>
      </div>
    </div>
    <?php 
    }
   }
  }
  if ($SE == 4)
            {
            while ($ligne = $resultat -> fetch_assoc() ) 
            {
              if($ligne['matière_id']>2400 && $ligne['matière_id']<2500)
              {
      ?>
    <div class="box">
      <i class="fas fa-quote-left quote"></i>
      <div class="content">
        <div class="info">
          <div class="name">
            <?php 
            ?>
            </div>
          <div class="job"><?php echo"$ligne[matière_id]"?></div>
          <div class="stars">
          </div>
        </div>
      </div>
    </div>
    <?php 
    }
   }
  }
   if ($SE == 5)
            {
            while ($ligne = $resultat -> fetch_assoc() ) 
            {
              if($ligne['matière_id']>3500)
              {
      ?>
    <div class="box">
      <i class="fas fa-quote-left quote"></i>
      <div class="content">
        <div class="info">
          <div class="name">
            <?php 
            echo"<a href='up-down-cours.php?ID=$ligne[matière_id]'>$ligne[matière_libellé]</a>"; 
            ?>
            </div>
          <div class="job"><?php echo"$ligne[matière_id]"?></div>
          <div class="stars">
          </div>
        </div>
      </div>
    </div>
    <?php 
    }
   }
  }
}
?>
  </div>
  </div>
  
</body>
</html>