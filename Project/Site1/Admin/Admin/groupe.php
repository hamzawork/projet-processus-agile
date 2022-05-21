 <?php require_once "..\..\Html\home.php"; ?>
 <?php
    $mysqli = mysqli_connect('localhost', 'root', '', 'formation');
    $mysqli -> set_charset("utf8");
    $requete = "SELECT * FROM groupe";
    $resultat = $mysqli -> query($requete);
    ?>
 <!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style7.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
</head>
<body> 
         <form action="" method="POST" autocomplete="">
     <table >
     <tr>
       <th>ID</th>
       <th>Nom du Groupe</th>
       <th>Niveau</th>
       <th>Filière</th>
       <th> Modifer</th>
        <th>Supprimer</th>
     </tr>
          <?php   
            while ($ligne = $resultat -> fetch_assoc()) 
            {
              echo"<tr> 
                <td>$ligne[groupe_id] </td>
                <td>$ligne[groupe_libellé]</td>
                <td> $ligne[niveau_id]</td>
                <td> $ligne[filière_id]</td>
                <td><label for='show2' class='btn btn-danger'>Editer</label></td>
                <td><a href='listegroupecontrooller.php?ID=$ligne[groupe_id]' class='btn btn-danger'>Supprimer</a></td>
                </tr>";
            }
            ?>  
     </table>
   </form>
   <div class="center">
         <input type="checkbox" id="show">
         <label for="show" class="show-btn">Ajouter</label>
         <div class="container">
            <label for="show" class="close-btn fas fa-times" title="close"></label>
            <form method="POST" action="listegroupecontrooller.php">
              <div class="data">
                  <label>Numéro du Groupe</label>
                  <input type="value" name="id" >
               </div>
              <div class="data">
                  <label>Nom du Groupe</label>
                  <input type="text" name="groupe">
               </div>
               <div class="data">
                  <label>Année</label>
                  <select name="niveau">
                    <option value="">--Choissisez un choix--</option>
                    <option value="1">1ère année</option>
                    <option value="2">2ème année</option>
                    <option value="3">3éme année</option>
                  </select>
               </div>
               <div class="data">
                  <label>filière</label>
                  <select name="filiere">
                    <option value="">--Choissisez un choix--</option>
                    <option value="1">SSI</option>
                    <option value="2">GL</option>
                    <option value="3">IWIM</option>
                    <option value="3">IDF</option>
                    <option value="3">BI</option>
                    <option value="3">IA</option>
                  </select>
               </div>
               <div class="btn">
                  <div class="inner"></div>
                  <button type="submit" name="ajout">Ajouter</button>
               </div>
            </form>
         </div>
       </div>
       <div class="center">
         <input type="checkbox" id="show2">
         <div class="container">
            <label for="show2" class="close-btn fas fa-times" title="close"></label>
            <form method="POST" action="listegroupecontrooller.php">
              <div class="data">
                  <label>Email</label>
                  <input type="text" name="email">
               </div>
               <div class="data">
                  <label>Année</label>
                  <input type="text" >
               </div>
               <div class="data">
                  <label>Groupe</label>
                  <input type="text" name="groupe">
               </div>
               <div class="data">
                  <label>filière</label>
                  <input type="text" >
               </div>
               <div class="btn">
                  <div class="inner"></div>
                  <button type="submit" name="ajout">Modifier</button>
               </div>
            </form>
         </div>
       </div>
</body>
</html>
