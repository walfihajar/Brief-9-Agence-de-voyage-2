<?php
include 'db.php';
ob_start(); 
session_start() ;
    if($_SESSION['id_role'] !=1 && $_SESSION['id_role'] !=2 ){ //client
      header("location: erreur.php") ;
      exit ;
    }
    else if($_SESSION['id_role'] ==1 || $_SESSION['id_role'] ==2  ){ //admin et super admin 
       $id_user = $_SESSION['id'] ; 
    } 

$title = "DASHBORD";

$result_clients = $conn->query("SELECT COUNT(*) AS total_clients FROM client");
$row_clients = mysqli_fetch_assoc($result_clients);
$total_clients = $row_clients['total_clients'];

$result_activites = $conn->query("SELECT COUNT(*) AS total_activites FROM activite");
$row_activites = mysqli_fetch_assoc($result_activites);
$total_activites = $row_activites['total_activites'];

$result_reservations = $conn->query("SELECT COUNT(*) AS total_reservations FROM reservation");
$row_reservations = mysqli_fetch_assoc($result_reservations);
$total_reservations = $row_reservations['total_reservations'];

$result_client_reservation = $conn->query("SELECT COUNT(DISTINCT id_client) AS total_client_reservation FROM reservation");
$row_client_reservation = mysqli_fetch_assoc($result_client_reservation);
$total_client_reservation = $row_client_reservation['total_client_reservation'];


$result_activite_reservation = $conn->query("SELECT COUNT(DISTINCT id_activite) AS total_activite_reservation FROM reservation");
$row_activite_reservation = mysqli_fetch_assoc($result_activite_reservation);
$total_activite_reservation = $row_activite_reservation['total_activite_reservation'];

$result_statut_reservation = $conn->query("SELECT COUNT(*) AS total_confirme_reservation FROM reservation  where statut='Confirmée' ");
$row_statut_reservation = mysqli_fetch_assoc($result_statut_reservation);
$total_statut_reservation = $row_statut_reservation['total_confirme_reservation'];



?>



<div class="grid  grid-cols-2 lg:grid-cols-3">
<div class="inline-block w-52 p-5 m-2 text-center text-xl border border-indigo-300 rounded-lg shadow-md">
    <!-- Contenu de la carte -->
        <h3>Nombres de Clients</h3>
        <p><?php echo $total_clients; ?></p>
    </div>
    <div class="inline-block w-52 p-5 m-2 text-center text-xl border border-indigo-300 rounded-lg shadow-md">
    <!-- Contenu de la carte -->
        <h3> Nombres d'Activités</h3>
        <p><?php echo $total_activites; ?></p>
    </div>
    <div class="inline-block w-52 p-5 m-2 text-center text-xl  border border-indigo-300 rounded-lg shadow-md">
    <!-- Contenu de la carte -->
        <h3> Nombres de Réservations</h3>
        <p><?php echo $total_reservations; ?></p>
    </div>

    <div class="inline-block w-52 p-5 m-2 text-center text-xl  border border-indigo-300 rounded-lg shadow-md">
    <!-- Contenu de la carte -->
        <h3> Nombre de Clients Réservés</h3>
        <p><?php echo $total_client_reservation; ?></p>
    </div>

    <div class="inline-block w-52 p-5 m-2 text-center text-xl  border border-indigo-300 rounded-lg shadow-md">
    <!-- Contenu de la carte -->
    <h3 >Nombre d'Activités Réservées</h3>
    <p c><?php echo $total_activite_reservation; ?></p>
    </div>

    
    <div class="inline-block w-52 p-5 m-2 text-center text-xl  border border-indigo-300 rounded-lg shadow-md">
    <!-- Contenu de la carte -->
    <h3 >Nombre de Réservation confirmées</h3>
    <p><?php echo $total_statut_reservation; ?></p>
    </div>

</div>
<?php
$content = ob_get_clean(); 
include 'layout.php'; 
?>
