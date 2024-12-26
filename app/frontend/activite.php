<?php
ob_start(); 
$title = "Gestion des activites";
require "../backend/classe_activite.php";
require_once __DIR__ . '/../../includ/DB.php';
require_once __DIR__ . '/../../includ/DatabaseManager.php';
$dbManager = new DatabaseManager();
?>






   <!-- #form -->

   <div id="modal" class=" hidden fixed inset-0 flex items-center z-50 justify-center bg-white bg-opacity-50">
    <div class="relative p-6 shadow-xl rounded-lg bg-white text-gray-900 overflow-y-auto lg:w-1/3">
        <span id="closeForm" class="absolute right-4 top-4 text-gray-600 hover:text-gray-900 cursor-pointer material-symbols-outlined text-2xl">cancel</span>
        <h2 class="text-2xl font-bold mb-6 text-center text-yellow-500">Ajouter Activité</h2>
        <p id="pargErreur" class="hidden text-sm font-semibold px-4 py-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
        </p>
        <form id="formulaire" class="flex flex-col gap-4" action="activite.php" method="post">
            <input id="id_input" type="hidden" value="-1">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                <div>
                    <label for="titre" class="block font-medium mb-1">Titre</label>
                    <input id="titre" name="titre" type="text" placeholder="Titre de l'activité" class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                </div>

                <div>
                    <label for="description" class="block font-medium mb-1">Description</label>
                    <textarea id="description" name="description" placeholder="Description de l'activité" class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm"></textarea>
                </div>

                <div>
                    <label for="destination" class="block font-medium mb-1">Destination</label>
                    <input id="destination" name="destination" type="text" placeholder="Destination" class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                </div>

                <div>
                    <label for="prix" class="block font-medium mb-1">Prix</label>
                    <input id="prix" name="prix" type="number" placeholder="Prix" class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                </div>

                <div>
                    <label for="date_debut" class="block font-medium mb-1">Date Début</label>
                    <input id="date_debut" name="date_debut" type="date" class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                </div>

                <div>
                    <label for="date_fin" class="block font-medium mb-1">Date Fin</label>
                    <input id="date_fin" name="date_fin" type="date" class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                </div>

                <div>
                    <label for="place_disponible" class="block font-medium mb-1">Places Disponibles</label>
                    <input id="place_disponible" name="place_disponible" type="number" placeholder="Nombre de places disponibles" class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                </div>

            </div>

            <div class="flex justify-center">
                <button type="submit" name="ajouter" class="w-full bg-[#7F020F] hover:bg-red-700 text-white font-bold py-2 rounded-lg">Valider</button>
            </div>
        </form>
    </div>
</div>

<!---->

<?php
// Ajouter un client
if (isset($_POST['ajouter'])) {
    $titre = $_POST['titre'];
    $description =$_POST['description'];
    $destination = $_POST['destination'];
    $prix =$_POST['prix'];
    $date_debut = $_POST['date_debut'];
    $date_fin = $_POST['date_fin'];
    $place_disponible = $_POST['place_disponible'];


    //$dbManager = new DatabaseManager();
    $newActivite = new Activite($dbManager);
    $newActivite->constructAvecParam( 0 ,$titre , $description ,$destination  ,$prix ,$date_debut , $date_fin , $place_disponible  ) ;
   $result = $newActivite->AjouterActivite() ;
    if ($result) { 
     
        header("Location: activite.php");
        exit; 
    } else {
        echo "<p>Erreur : insertion </p>";
    }
}


//https://www.w3schools.com/php/php_mysql_prepared_statements.asp
// methode plus securise car il prepare la requete avant de l appler en plus il consomme
if (isset($_POST["delete"])) {
    $id = intval($_POST["delete"]); // S'assurer que l'ID est un entier
    echo "id : ".$id;
           $dbManager = new DatabaseManager();
           $newActivite = new Activite($dbManager , $id);
            $result= $newActivite->supprimerActivite();
            if ($result) { 
                header("Location: activite.php");
                exit; 
            } else {
                echo "<p>Erreur : delete </p>";
            }
        }
// Afficher les clients
affiche() ; 
function affiche(){
    $dbManager = new DatabaseManager();
    $newActivite = new Activite($dbManager , 0);
    $result = $newActivite->getAll();  // Assurez-vous que la méthode AfficheAllActivite() existe et fonctionne correctement
   // print_r($result);
    if ($result) {
        echo "<div class='listeTable'><table border='1'>";
        echo "<tr><th>ID</th><th>Titre</th><th>Description</th><th>Prix</th><th>Date Début</th><th>Date Fin</th><th>Places Disponibles</th><th>Action</th></tr>";
        
        foreach ($result as $objet) {
            // Utilisez $objet->id_activite au lieu de $row['id_activite']
            $id = $objet->id_activite;
            echo "<tr>
                <td>{$objet->id_activite}</td>
                <td>{$objet->titre}</td>
                <td>{$objet->description}</td>
                <td>{$objet->prix}</td>
                <td>{$objet->date_debut}</td>
                <td>{$objet->date_fin}</td>
                <td>{$objet->place_disponible}</td>
                <td>
                    <form action='activite.php' method='post'>
                        <div class='flex'>
                            <button type='submit' name='delete' value='$id'>
                                <span class='text-red-400 cursor-pointer material-symbols-outlined'>
                                    delete
                                </span>
                            </button>
                        </div>
                    </form>
                </td>
            </tr>";
        }
        echo "</table></div>";
    } else {
        echo "<p>Aucune activité trouvée.</p>";
    }
}



?>
<?php
$content = ob_get_clean(); 
include 'layout.php'; 
?>
