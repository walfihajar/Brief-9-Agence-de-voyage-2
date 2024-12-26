<?php
ob_start();
$title = "Gestion des reservations";
require "../backend/classe_reservation.php";
require_once __DIR__ . '/../../includ/DB.php';
require_once __DIR__ . '/../../includ/DatabaseManager.php';
$dbManager = new DatabaseManager();
?>





$query = "select id_activite ,  titre from activite" ;
$result = mysqli_query($conn,$query); 
$serachActivite = " <div ><form action='' method='post'> 
                        <select name='search' onchange='this.form.submit()' class='inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'> 
                        <option value=''> Choisir Activite </option>" ; 

                   while($row = mysqli_fetch_assoc($result)){
                
 $serachActivite .=              " <option value={$row["id_activite"]}> {$row["titre"]}  </option>" ; 
                    }
                    $serachActivite .=             "</select></form></div>" ; 



?>                                                                                                                                                                                                                    
              




<div id="modal" class=" hidden fixed inset-0 flex items-center z-50 justify-center bg-white bg-opacity-50">
    <div class="relative p-6 shadow-xl rounded-lg bg-white text-gray-900 overflow-y-auto lg:w-1/3">
        <span id="closeForm"
            class="absolute right-4 top-4 text-gray-600 hover:text-gray-900 cursor-pointer material-symbols-outlined text-2xl">cancel</span>
        <h2 class="text-2xl font-bold mb-6 text-center text-yellow-500"> Réservation</h2>
        <p id="pargErreur"
            class="hidden text-sm font-semibold px-4 py-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
        </p>
        <form id="formulaire" class="flex flex-col gap-4" action="" method="POST">
            <input id="id_input" type="hidden" value="-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="id_client" class="block font-medium mb-1">Client</label>
                    <?php
                    $query = "select id_client , nom , prenom  from client" ;
                    $result = mysqli_query($conn,$query); 
                    echo"<select name='id_client'  class='inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'> 
                     <option value=''> Choisir Activite </option>" ; 
                    while($row = mysqli_fetch_assoc($result)){
                        echo"
                        <option value={$row["id_client"]}> {$row["nom"]} {$row["prenom"]}   </option>" ; 
                    }
                     echo"</select>"
                    ?>
                </div>
                <div>
                    <label for="id_activite" class="block font-medium mb-1">Activité</label>
                    <?php
                    $query = "select id_activite ,  titre from activite" ;
                    $result = mysqli_query($conn,$query); 
                    echo"<select name='id_activite'  class='inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'> 
                     <option value=''> Choisir Activite </option>" ; 
                    while($row = mysqli_fetch_assoc($result)){
                        echo"
                        <option value={$row["id_activite"]}> {$row["titre"]}  </option>" ; 
                    }
                     echo"</select>"
                    ?>
                </div>
                <div>
                    <label for="statut" class="block font-medium mb-1">Statut</label>
                    <select id="statut" name="statut"
                        class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                        <option value="En attente">En attente</option>
                        <option value="Confirmée">Confirmée</option>
                        <option value="Annulée">Annulée</option>
                    </select>
                </div>

                <div>
                    <label for="date_reservation" class="block font-medium mb-1">Date reservation</label>
                    <input id="date_reservation" name="date_reservation" type="date" placeholder="Date"
                    class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                </div>
               
            </div>
            <div class="flex justify-center">
                <button type="submit" name="ajouter" id="submitreservation"
                    class="w-full bg-[#7F020F] hover:bg-red-700 text-white font-bold py-2 rounded-lg">Valider</button>
            </div>
        </form>
    </div>
</div>


<!---->

<?php

if (isset($_POST['ajouter'])) {
    $id_client = mysqli_real_escape_string($conn, $_POST['id_client']);
    $id_activite = mysqli_real_escape_string($conn, $_POST['id_activite']);
    $statut = mysqli_real_escape_string($conn, $_POST['statut']);
    $date_reservation =mysqli_real_escape_string($conn, $_POST['date_reservation']); // Date et heure actuelle pour la réservation
    $query =  "INSERT INTO reservation (id_client, id_activite, statut, date_reservation)  VALUES (?, ?,?,?)" ; 
    $stmt = mysqli_prepare($conn ,$query);
    mysqli_stmt_bind_param($stmt , "iiss" , $id_client , $id_activite , $statut , $date_reservation);
    mysqli_stmt_execute($stmt);
   
    if (  mysqli_stmt_execute($stmt)) {
        echo "Réservation ajoutée avec succès";
    } else {
        echo "Erreur : " . $sql . "<br>" . mysqli_error($conn);
    }
    mysqli_stmt_close($stmt);
}

if(isset($_POST["delete"])){
    try {
        $search=$_POST["search"];
        $id=$_POST["delete"];  //  $_POST["delete"]   btn delete prend value= id_reservation 
        $query="delete from reservation where id_reservation=?";
        $stmt = mysqli_prepare($conn , $query);
        mysqli_stmt_bind_param($stmt , "i" , $id );
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);
        header("location: reservation.php");
        exit;
    } catch (mysqli_sql_execption $e) {
        echo "<div class='text-red-500  text-xl semi-bold  bg-white opacity-70'>{$e->getmessage()} </div>" ;
    }

}
//affichage  : 


// affichage recherche 
if(isset($_POST["search"])){
    $id = intval($_POST["search"]);
    $query_select = "select r.id_reservation ,a.titre ,  c.nom  , c.prenom , r.statut ,r.date_reservation   from reservation as r  
    inner join activite as a  on a.id_activite = r.id_activite 
    inner join  client as c  on c.id_client = r.id_client
    where r.id_activite = $id" ; 

// affichage de all reservation
}else {
$query_select = "select r.id_reservation ,a.titre ,  c.nom  , c.prenom , r.statut ,r.date_reservation   from reservation as r  
inner join activite as a  on a.id_activite = r.id_activite 
inner join  client as c  on c.id_client = r.id_client";
}



$resultat = mysqli_query($conn, $query_select);
if ($resultat) {
    echo "<div class='listeTable' ><table><thead><tr><th>id reservation</th><th>client</th><th>activite</th><th>statut</th><th>date reservation</th><th>Action</th></tr></thead><tbody>";
    while ($row = mysqli_fetch_assoc($resultat)) {
        $id = $row["id_reservation"] ; 
        echo "<tr>
        <td>{$row["id_reservation"]}</td>
        <td>{$row["nom"]} {$row["prenom"]}</td>
        <td>{$row["titre"]}</td>
        <td>{$row["statut"]}</td>
        <td>{$row["date_reservation"]}</td>
        <td> <form   action='reservation.php' method='post'>
                    <div class='flex'>
                        <button type='submit' name='delete' value='$id'>
                            <span class='text-red-400 cursor-pointer material-symbols-outlined'>
                                delete
                            </span>
                        </button>
        <button type='submit' name='edit' value='$id'>
           <!-- <span class='text-yellow-400 cursor-pointer material-symbols-outlined'>
                edit
            </span>-->
        </button>
    </div></td>
        </tr>";
    }
    echo "</tbody></table></div>";

}
mysqli_close($conn);

?>
<?php
$content = ob_get_clean();
include 'layout.php';
?>