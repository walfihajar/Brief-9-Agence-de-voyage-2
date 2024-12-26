<?php
include 'db.php';
ob_start(); 
$title = "Gestion des Clients";
?>
   <!-- form -->

   <div id="modal" class="  hidden fixed inset-0 flex items-center z-50 justify-center bg-white bg-opacity-50">
        <div class="relative p-6 shadow-xl rounded-lg bg-white text-gray-900 overflow-y-auto lg:w-1/3">
            <span id="closeForm"
                class="absolute right-4 top-4 text-gray-600 hover:text-gray-900 cursor-pointer material-symbols-outlined text-2xl">cancel</span>
            <h2 class="text-2xl font-bold mb-6 text-center text-yellow-500"> Client</h2>
            <p id="pargErreur"
                class="hidden text-sm font-semibold px-4 py-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded">
            </p>
            <form id="formulaire1" class="flex flex-col gap-4" action="" method="post">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nom" class="block font-medium mb-1">Nom</label>
                        <input   name ="nom" type="text" placeholder="Nom du client"
                            class="inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                    </div>
                    <div>
                        <label for="prenom" class="block font-medium mb-1">Prenom</label>
                        <input name ="prenom" type="text" placeholder="URL de la photo"
                            class=" inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                    </div>

                    <div>
                        <label for="email" class="block font-medium mb-1">Email :<span class="text-gray-200">nom@email.ma</span></label>
                        <input name="email" type="text" placeholder="email"
                            class=" inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                        
                    </div>


                    <div>
                        <label for="telephone" class="block font-medium mb-1">Telephone</label>
                        <input name="telephone" type="text" placeholder="telephone"
                            class=" inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                    </div>



                    <div>
                        <label for="adresse" class="block font-medium mb-1">adresse</label>
                        <input name="adresse" type="text" placeholder="adresse"
                            class=" inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                    </div>


                    <div>
                        <label for="date naissance" class="block font-medium mb-1">Date naissance</label>
                        <input name="date_naissance" type="date" placeholder="date"
                            class=" inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm">
                    </div>
              
                <div class="flex justify-center">
                    <button type="submit"  name="ajouter"
                        class="w-full bg-[#7F020F] hover:bg-red-700 text-white font-bold py-2 rounded-lg">Valider</button>
                </div>

                </div>
            </form>
        </div>
    </div>

<!---->

<?php
// Ajouter un client
if (isset($_POST['ajouter'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);  //https://www.w3schools.com/php/func_mysqli_real_escape_string.asp
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone= mysqli_real_escape_string($conn, $_POST['telephone']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $date_naissance = mysqli_real_escape_string($conn, $_POST['date_naissance']);

    $sql = "INSERT INTO client (nom, prenom ,  email ,  telephone , adresse , date_naissance) 
    VALUES ('$nom', '$prenom' , '$email' ,   '$telephone' , '$adresse' , '$date_naissance')";
    mysqli_query($conn , $sql); 
   
    // echo (mysqli_affected_rows($conn))   ; 
    // https://www.w3schools.com/php/func_mysqli_affected_rows.asp   
        //recupere le nb de ligne ajouter ou modifier ou supprmer - 
        //en general il retunrn nbr de ligne affecte lors de dernier query execute dans cet exemple   
        // mysqli_query($conn , $sql);    nbr ligne ajoute au table client
    if (mysqli_affected_rows($conn)) {
       // echo "<p>Client ajouté avec succès !</p>";
        header("Location: client.php");
        exit; 
      
    } else {
        echo "<p>Erreur : " . mysqli_error($conn) . "</p>";
    }
}


//delete 
if(isset($_POST["delete"])){
    // methode sans prepartion il peut cause des injection , elle est defavorable 
    $id=$_POST["delete"];
    /*$query="delete from client where id_client=$id" ;
    mysqli_query($conn , $query); */
    try {
    $query="delete from client where id_client=$id" ;
    mysqli_query($conn , $query);
    //echo "<div class='text-green-500  text-xl semi-bold  '> le client est supprimé avec succes  </div>" ;
    header("Location: client.php");
    }catch(mysqli_sql_exception $e){
        $code = $e->getCode();  // je recupere le numero d erreur 
        if($code === 1451 ){
            echo "<div class='text-red-500  text-xl semi-bold  bg-white opacity-70'>Désolé, vous ne pouvez pas supprimer ce client car il est lié à d'autres enregistrements. </div>" ;
        }else{
            echo "<div class='text-red-500  text-xl semi-bold  bg-white opacity-70'> {$e->getmessage()} </div>" ;
        }
    }
   

}



  // Charger les données du client
if (isset($_POST['edit'])) {
  
    $id = mysqli_real_escape_string($conn, $_POST['edit']);
    $sql = "SELECT * FROM client WHERE id_client = '$id'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_assoc($result)) {
        // charge les donnees dans la formulaire
        echo" <div id='modalEdit' class='   fixed inset-0 flex items-center z-50 justify-center bg-white z-50 bg-opacity-50'>
        <div class='relative p-6 shadow-xl rounded-lg bg-white text-gray-900 overflow-y-auto lg:w-1/3'>
            <span id='closeFormEdit'
                class='absolute right-4 top-4 text-gray-600 hover:text-gray-900 cursor-pointer material-symbols-outlined text-2xl'>cancel</span>
            <h2 class='text-2xl font-bold mb-6 text-center text-yellow-500'> Client</h2>
            <p id='pargErreur1'
                class='hidden text-sm font-semibold px-4 py-2 mb-4 text-red-700 bg-red-100 border border-red-400 rounded'>
            </p>
            <form id='formulaire2' class='flex flex-col gap-4' action='' method='post'>
                <input name='id_client' type='hidden' value='{$row['id_client']}'>
                <div class='grid grid-cols-1 md:grid-cols-2 gap-4'>

                    <div>
                        <label for='nom' class='block font-medium mb-1'>Nom</label>
                        <input  name ='nom' type='text'  value={$row['nom']}
                            class='inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'>
                    </div>
                    <div>
                        <label for='prenom' class='block font-medium mb-1'>Prenom</label>
                        <input name ='prenom' type='text' value={$row['prenom']}
                            class=' inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'>
                    </div>

                    <div>
                        <label for='email' class='block font-medium mb-1'>Email :<span class='text-gray-200'>nom@email.ma</span></label>
                        <input name='email' type='text' value={$row['email']}
                            class=' inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'>
                        
                    </div>


                    <div>
                        <label for='telephone' class='block font-medium mb-1'>Telephone</label>
                        <input name='telephone' type='text' value={$row['telephone']}
                            class=' inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'>
                    </div>



                    <div>
                        <label for='adresse' class='block font-medium mb-1'>adresse</label>
                        <input name='adresse' type='text' value={$row['adresse']}
                            class=' inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'>
                    </div>


                    <div>
                        <label for='date_naissance' class='block font-medium mb-1'>Date naissance</label>
                        <input name='date_naissance' type='date'  value={$row['date_naissance']}
                            class=' inputformulaire w-full bg-gray-50 border border-gray-300 rounded-lg p-2 text-sm'>
                    </div>
              
             
<div class='flex justify-center'>
    <button type='submit' name='modifier' class='w-full bg-[#7F020F] hover:bg-red-700 text-white font-bold py-2 rounded-lg'>Modifier</button>
</div>
                </div>
       </form></div></div>";
    } else {
        echo "<p>Erreur : Client non trouvé.</p>";
    }

      echo"<script> document.getElementById('closeFormEdit').addEventListener('click' , function() {
           document.getElementById('modalEdit').classList.add('hidden') ; }) ;</script>" ;
    } 

// Modifier 
if (isset($_POST['modifier'])) {
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);  //https://www.w3schools.com/php/func_mysqli_real_escape_string.asp
    $prenom = mysqli_real_escape_string($conn, $_POST['prenom']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $telephone= mysqli_real_escape_string($conn, $_POST['telephone']);
    $adresse = mysqli_real_escape_string($conn, $_POST['adresse']);
    $date_naissance = mysqli_real_escape_string($conn, $_POST['date_naissance']);
    $id =mysqli_real_escape_string($conn , $_POST['id_client']);

  //  $sql = "UPDATE client SET nom='$nom', prenom='$prenom', email='$email', telephone='$telephone' WHERE id_client='$id'";
    $sql="update client set nom='$nom' , prenom='$prenom', email='$email' , telephone='$telephone' , adresse='$adresse' , date_naissance='$date_naissance' where id_client='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "<p>Client mis à jour avec succès !</p>";
         header("Location: client.php"); 
        exit;
    } else {
        echo "<p>Erreur : " . mysqli_error($conn) . "</p>";
    }
}

// Afficher les clients
$sql = "SELECT * FROM client";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    echo " <div class='listeTable' ><table border='1'><thead>";
    echo "<tr><th>ID</th><th>Nom</th><th>Email</th><th>Telephne</th><th>Adresse</th><th>Date_naissance</th><th>Action</th></tr></thead><tbody>";
    while ($row = mysqli_fetch_assoc($result)) {
        $id= $row['id_client'] ; 
        echo "<tr>
            <td>{$row['id_client']}</td>
            <td>{$row['nom']} {$row['prenom']}</td>       
              <td>{$row['email']}</td>
               <td>{$row['telephone']}</td>
                <td>{$row['adresse']}</td>
            <td>{$row['date_naissance']}</td>
            <td class='flex align-center justify-center'>
                 <form   action='client.php' method='post'>
                    <div class='flex'>
                        <button type='submit' name='delete' value='$id'>
                            <span class='text-red-400 cursor-pointer material-symbols-outlined'>
                                delete
                            </span>
                        </button>
        <button  id='edit' name='edit' value='$id'>
            <span class='text-yellow-400 cursor-pointer material-symbols-outlined'>
                edit
            </span>
        </button>

          
    </div>
</form>
            </td>
        </tr>";
    }
    echo "</tbody></table></div>";
} else {
    echo "<p>Aucun client trouvé.</p>";
}


mysqli_close($conn);
?>
<?php
$content = ob_get_clean(); 
include 'layout.php'; 
?>
