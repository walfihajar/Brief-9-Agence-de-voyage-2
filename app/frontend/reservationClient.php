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
require "../backend/classe_activite.php";
require "../backend/class_reservation.php";
require_once __DIR__ . '/../../includ/DB.php';
require_once __DIR__ . '/../../includ/DatabaseManager.php';



if(isset($_POST["changeStatut"])){
    $id_reservation = intval($_POST["id_reservation"]);
    $newStatut = $_POST["changeStatut"];
    $reservation = new Reservation() ; 
    $resutlt = $reservation->changeStatut($id_reservation , $newStatut);

}
if(isset($_POST["changeActivity"])){
    $id_reservation = intval($_POST["id_reservation"]);
    $newidActivite = $_POST["changeActivity"];
    $reservation = new Reservation() ; 
    $resutlt = $reservation->changeActivite($id_reservation , $newidActivite);

}

afficher();
function afficher(){
  
    $dbManager = new DatabaseManager();
    $newActivite = new Activite($dbManager , 0);
    $activites = $newActivite->getAll();

    $conn= Database :: getInstance() ; 
    $db = $conn->getConnection() ; 
    $result = Reservation::affichertt( $db);

    if ($activites) {
        echo "<div class='listeTable'><table border='1'><thead>";
        echo "<tr><th>ID</th><th>Activité</th><th>Date de réservation</th><th>Statut</th><th>Action</th></tr></thead><tbody>";

        $reservation = Reservation::affichertt($db);

        foreach ($reservation as $objet) {
            $id = $objet->id_reservation;
            echo "<tr>
                    <td>{$objet->id_reservation}</td>
                    <td>
                        <form action='' method='post'>
                            <input type='hidden' name='id_reservation' value='{$objet->id_reservation}'>
                            <select name='changeActivity' onchange='this.form.submit()' class='w-full bg-gray-100 border border-gray-300 rounded-lg p-2 text-sm'>
                                <option value=''>Sélectionnez une activité</option>";

                             foreach ($activites as $activite) {
                             $selected = ($objet->titre == $activite->titre) ? 'selected' : '';
                             echo "<option value='{$activite->id_activite}' $selected>{$activite->titre}</option>";
            }

            echo "</select>
                        </form>
                    </td>
                    <td>{$objet->date_reservation}</td>
                    <td>{$objet->statut}</td>
                    <td class='flex align-center justify-center'>
                        <form action='' method='post'>
                            <input type='hidden' name='id_reservation' value='{$objet->id_reservation}'>
                            <button type='submit' name='cancel' value='$id'><span class='text-red-400 cursor-pointer material-symbols-outlined'>cancel</span></button>
                        </form>
                    </td>
                </tr>";
        }
        echo "</tbody></table></div>";
    }
}
?>

<?php
$content = ob_get_clean(); 
include 'layout.php'; 
?>

