<?php
ob_start(); 
session_start() ;
    if($_SESSION['role']!="client"){ //client
      header("location: erreur.php") ;
      exit ;
    }
    else if($_SESSION['role'] =="client"){
       $id_user = $_SESSION['id'] ; 
    }
$title = "Vos réservations, votre histoire : Plongez dans vos prochaines escapades !";
require_once __DIR__ . '/../../includ/DB.php';
require_once __DIR__ . '/../backend/class_reservation.php'; 


if(isset($_POST["changeStatut"])){
    $id_reservation = intval($_POST["id_reservation"]);
    $newStatut = $_POST["changeStatut"];
    $reservation = new Reservation() ; 
    $resutlt = $reservation->changeStatut($id_reservation , $newStatut);

}



afficher();
function afficher(){
  
    $conn= Database :: getInstance() ; 
    $db = $conn->getConnection() ; 
    $result = Reservation::affichertt( $db); 

    if($result){
        echo " <div class='listeTable' ><table border='1'><thead>";
        echo "<tr><th>ID</th><th>Client</th><th>Activite</th><th>Date de reservation</th><th>Statut</th><th>Action</th></tr></thead><tbody>";
        foreach ($result as $objet){
            $id= $objet->id_reservation; 
            echo "<tr>
                <td>{$objet->id_reservation}</td>
                <td>{$objet->nom} {$objet->prenom}</td>       
                <td>{$objet->titre}</td>
                <td>{$objet->date_reservation}</td>
                <td>
                    <form action='' method='post'>
                        <input type='hidden' name='id_reservation' value='{$objet->id_reservation}'>
                        <select name='changeStatut' onchange ='this.form.submit()' class='w-full bg-gray-100 border border-gray-300 rounded-lg p-2 text-sm'>
                            <option value='enAttente' " . ($objet->statut == 'enAttente' ? 'selected' : '') . ">En attente</option>
                            <option value='confirmee' " . ($objet->statut == 'Confirmée' ? 'selected' : '') . ">Confirmée</option>
                            <option value='annulee' " . ($objet->statut == 'Annulée' ? 'selected' : '') . ">Annulée</option>
                        </select>
                    </form>
                </td>

                <td class='flex align-center justify-center'>
                    <form   action='' method='post'>
                    <input type='hidden' name='id_reservation' value='{$objet->id_reservation}'>
                        <div class='flex'>
                            <button type='submit' name='archive' value='$id'><span class='text-red-400 cursor-pointer material-symbols-outlined'>folder</span></button>
                        </div>
                    </form>
                </td>
            </tr>";
        }
        echo "</tbody></table></div>";
} else {
    echo "<p>Aucun client trouvé.</p>";
}
}
?>  
<?php
$content = ob_get_clean(); 
include 'layout.php'; 
?>