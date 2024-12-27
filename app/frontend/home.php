<?php
session_start() ; 
require "../backend/classe_activite.php";
require_once __DIR__ . '/../../includ/DB.php';
require_once __DIR__ . '/../../includ/DatabaseManager.php';
$dbManager = new DatabaseManager();
$objActivite = new Activite($dbManager , 0);

/*require("sweetAlert/sweetAlert.php"); 
if($_SERVER['REQUEST_METHOD']=="GET" && isset($_SESSION['msgSweetAlert'])){
  sweetAlert(); 
}*/

?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Restaurant</title>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- sweet alert-->
    <script src='https://cdn.tailwindcss.com'></script>
    <link rel='stylesheet' href='css/style.css' />
    <link
      href='https://fonts.googleapis.com/css2?family=Merienda&display=swap'
      rel='stylesheet'
    />
    <link
      href='https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css'
      rel='stylesheet'
    />
    <link
      rel='stylesheet'
      href='https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined'
    />

        <!-- Favicon -->
        <link href='img/favicon.ico' rel='icon'>
        <!-- Inclure le CSS de Font Awesome -->
      <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css'>
      <script src="js/main.js"  defer></script>
  </head>
  <body id="pageHome" class="bg-gray-100 font-merienda lg:mx-16 px-2.5 ">

  <!-- Navbar -->
    <nav
      class='bg-gray-900 text-white px-4 lg:px-8 py-3 flex justify-between items-center'
    >
      <a href='#' class='flex items-center space-x-2'>
        <div class='text-primary text-2xl font-bold flex items-center'>
          <img  class='   w-30 h-16 ' src='images/imgs/logo1.png'>
        </div>
    
      </a>
      <button class='lg:hidden text-white text-2xl' id='navbar-toggler'>
        <i class='fa fa-bars'></i>
      </button>
      <div class='hidden lg:flex items-center space-x-6' id='navbar-menu'>
        <a href='home.php' class='hover:text-[#FEA116] '>Home</a>
        <a href='#menu-section' class='hover:text-[#FEA116] '>Menu</a>
        <a href='about.html' class='hover:text-[#FEA116] '>About</a>
        <a href='service.html' class='hover:text-[#FEA116] '>Service</a>
        <a href='contact.html' class='hover:text-[#FEA116] '>Contact</a>
        <a href='gestion/gestionRes_Client.php' class='hover:text-[#FEA116] text-3xl '>

          <i class='fa-solid fa-utensils'></i></a>
       
          <div class='relative group'>
            <a href='#' id='menuToggle' class='flex items-center hover:text-[#FEA116] text-3xl'>
              <i class='fa-solid fa-user-tie'></i>
              <i class='fa fa-caret-down'></i>
            </a>
            <div
              id='dropdownMenu'
              class='absolute hidden bg-gray-800 text-white mt-2 rounded shadow-md p-2 space-y-2'
            >
              <a href='login/login.php' class='block hover:bg-gray-700 p-2 rounded'>se connecter</a>
              <a href='login/register.php' class='block hover:bg-gray-700 p-2 rounded'>s'inscrire</a>
              <a href='login/deconnecter.php' class='block hover:bg-gray-700 p-2 rounded'>se deconnecter</a>
            </div>
          </div>
       
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="bg-[url('images/imgs/header.png')] bg-cover  py-16">
      <div
        class='container mx-auto flex flex-col lg:flex-row items-center justify-between'
      >
        <div class='lg:w-1/2 text-center lg:text-left space-y-6 p-2.5'>
          <h1 class='text-4xl lg:text-6xl font-bold text-yellow-100'>
            <?php 
              // if (isset($_SESSION['name']) )
              //        {echo "Bonjour Notre cher Client" . $_SESSION['name'] ;}
              //        else 
              //        {echo "Profitez de Notre Experience depuis 50ans"  ;}  
               //ligne 95?>
          </h1> <p class='text-white leading-relaxed'>
            Découvrez l'excellence gastronomique avec notre chef de cuisine passionné. Offrez à vos papilles une expérience inoubliable à travers des plats créatifs.
          </p>
      
        </div>
      <!-- <div class='lg:w-1/2 flex justify-center lg:justify-end'>
          <img
            class='w-84 h-80 rounded-lg'
            src='images/imgs/header1.png'
            alt='Hero Image'
          />--> 
        </div>
      </div>
    </div>

<!-- Menu Section -->
<div id='menu-section' class="py-16 px-10    bg-[url('img/map3.png')] bg-[#FAF5F1] no-repeat bg-cover">
  <h2 class='text-center text-3xl font-bold text-gray-800 mb-8'>
    ~ Nos Plans  ~
  </h2>
  <div class='menu-cards grid grid-cols-4 '> 
   <!--  //    <img class='card-img-top' src='$urlPhoto' alt='{$nomMenu}' />-->
    <!-- Meat Menu -->
    <?php 
    $dbManager = new DatabaseManager();
    $newActivite = new Activite($dbManager , 0);
    $result = $newActivite->getAll(); 
    foreach ($result as $objet) {
        echo"
          <div class='card h-[500px]'>
           <img class='card-img-top' src='$objet->photo' alt='photo {$objet->titre}' />
            <div class='card-body'>
              <h5 class='card-title'>~ {$objet->titre} ~</h5>
            <ul class='list-group'>
            <li class='list-group-item'>  {$objet->prix} </li>
            <li class='list-group-item'> {$objet->date_debut}</li>
            <li class='list-group-item'>{$objet->date_fin} </li>
            <li class='list-group-item'>{$objet->place_disponible}</li>
            <li class='list-group-item'>  {$objet->description} </li>
            </ul>
        <form method='get' action='home.php' >
             <input type='hidden' name='id_activite' value='{$objet->id_activite}'>
            <button type=submit name=''  class=' text-end text-[#21a9db] underline hover:scale-150 transition-transform cursor-pointer inline-block'
            >Reserver </button>
        </form>
          </div>
        </div>";
      }
 
    ?>
   
  </div>
</div>


<?php
if( $_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["reserver"]) ) {
  // echo "<div><p>Réserver</p><div>";
   if($_SESSION['role']=="client"){
   $id_menu = trim(mysqli_real_escape_string($conn, $_POST["id_menu"]));
   $date = trim(mysqli_real_escape_string($conn, $_POST["date"]));
   $heure = trim(mysqli_real_escape_string($conn, $_POST["heure"]));
   $nb_personne = trim(mysqli_real_escape_string($conn, $_POST["nb_personne"]));
   $tel = trim(mysqli_real_escape_string($conn, $_POST["tel"]));
   $msg = trim(mysqli_real_escape_string($conn, $_POST["message"]));
   $id_user = $_SESSION["id"];
   $statut = 'en attente';
   $description = $msg ?: '';
   
   $query = "INSERT INTO reservation (date_r, heure_r, nb_personne_r, statut_r, id_user, id_menu, tel, message) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
   $stmt = mysqli_prepare($conn, $query);
   mysqli_stmt_bind_param($stmt, "ssisiiss", $date, $heure, $nb_personne, $statut, $id_user, $id_menu, $tel, $description);
   if(mysqli_stmt_execute($stmt)){
    
    mysqli_stmt_close($stmt); 
    $_SESSION['msgSweetAlert'] = [
         'title' =>'success'  ,
         'text' => 'reservation effectue avec succes , veuillez attendre la confirmation de votre réservation ',
         'status'=> 'success'
    ]  ;
    header("Location: index.php");
    exit;
  } else{
    $_SESSION['msgSweetAlert']= [
      'title' =>'Avirtissment'  ,
      'text' => 'reservation echouée',
      'status' => 'error'
 ] ;
 mysqli_stmt_close($stmt); 
 header("Location: index.php");
 exit;
   
    //sweetAlert( "erreur " , "Erreur lors de supprission de reservation " , "error") ;
   }

 }
 else {
            sweetAlert("Attention" , "Veuillez vous identifier pour réserver. " , "erreur") ;
}

 }




if (isset($_GET['id_activite']) && is_numeric($_GET['id_activite'])) {
    $id = intval($_GET['id_activite']);
    $newAct= new activite($dbManager) ; 
    $objet = $newAct->getById($id) ;
    
    echo "<div id='modal' class='fixed inset-0 bg-black bg-opacity-70 flex items-center justify-center z-40'>
          <div class='bg-white  max-w-4xl rounded-lg shadow-lg relative'>
            <button  class='absolute top-3 right-3 text-gray-500 hover:text-gray-700 text-2xl' 
            onclick='closeModal(\"modal\")'>
              &times;
            </button>
       
          <div class='grid grid-cols-1 gap-4  '>
            <div class=' flex items-center'>
              <div class='p-6'>
                <h2 id='menu-title' class='text-2xl font-bold  text-[#FEA116] mb-8 '>
                   Reservation     
                 </h2>
                    <h2 id='menu-title' class='text-center text-xl font-medium   '>
                   {$objet->titre}
                 </h2>
               <!--  formulaire -->
                <form method='post'  action ='' class=''>
                 
                    <!-- Date & Time -->
                    <div class='flex flex-col gap-4 '>
                      <div>
                        <label for='date' class='text-gray-900'>Date</label>
                        <input
                          type='date'
                          name='date'
                          class='w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-primary'
                          placeholder='Date'
                        />
                      </div>
                      <div>
                        <label for='heure' class='text-gray-900'>Heure</label>
                        <input
                          type='time'
                          name='heure'
                          class='w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-primary'
                          placeholder='Heure'
                        />
                      </div>

                      <div class=''>
                        <label for='select1' class='text-gray-900'
                          >Nombre de personnes</label
                        >
                        <input
                          type='number'
                          name='nb_personne'
                          class='w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-primary'
                          placeholder='Nombre de personnes'
                        />
                      </div>

                      <div>
                        <label for='tel' class='text-gray-900'>Téléphone :</label>
                        <input  name='tel'
                        class='w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-primary'
                          type='tel'
                          placeholder='Votre numéro de téléphone' />
                      </div>
                      <!-- Special Request -->
                      <div class=''>
                        <label for='message' class='text-gray-900'
                          >Message</label
                        >
                        <textarea
                          class='form-control w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring focus:border-primary'
                          name='message'
                          placeholder='Message'
                          style='height: 100px'
                        ></textarea>
                      </div>
                      <!-- Submit Button -->
                      <div class=''>
                      <input type=hidden name='id_menu' value={$objet->id_activite}>
                        <button name='reserver'
                          class='btn bg-[#FEA116] text-white w-full py-3 rounded-lg transition'
                          type='submit'
                        >
                          Reserver
                        </button>
                      
                      </div>
                    </div>
                 
                </form>
              </div>
            </div>
          </div>
          </div></div></div>";
}
?>













 

<footer class="container-fluid bg-[#0f172b] bg-[url('img/footer1.jpg')] bg-[#FAF5F1] no-repeat bg-cover text-[#333333] pt-5 ">
    <div class='container py-5 px-10'>
        <div class='grid grid-cols-1 lg:grid-cols-4 gap-5'>
            <div class='space-y-4 flex flex-col'>
                <h4 class='section-title text-[#FEA116] mb-4'>Company</h4>
                <a class='text-[#333333]' href=''>About Us</a>
                <a class='text-[#333333]' href=''>Contact Us</a>
                <a class='text-[#333333]' href=''>Reservation</a>
                <a class='text-[#333333]' href=''>Privacy Policy</a>
                <a class='text-[#333333]' href=''>Terms & Condition</a>
            </div>
            <div class='space-y-4'>
                <h4 class='text-[#FEA116] mb-4'>Contact</h4>
                <p class='mb-2 text-[#333333]'><i class='fa fa-map-marker-alt me-3'></i>123 Street, New York, USA</p>
                <p class='mb-2 text-[#333333]'><i class='fa fa-phone-alt me-3'></i>+012 345 67890</p>
                <p class='mb-2 text-[#333333]'><i class='fa fa-envelope me-3'></i>info@example.com</p>
                <div class='flex space-x-2 pt-2'>
                    <a class='btn btn-outline-dark' href=''><i class='fab fa-twitter'></i></a>
                    <a class='btn btn-outline-dark' href=''><i class='fab fa-facebook-f'></i></a>
                    <a class='btn btn-outline-dark' href=''><i class='fab fa-youtube'></i></a>
                    <a class='btn btn-outline-dark' href=''><i class='fab fa-linkedin-in'></i></a>
                </div>
            </div>
            <div class='space-y-4'>
                <h4 class='section-title text-[#FEA116] mb-4'>Opening</h4>
                <h5 class='text-[#333333]'>Monday - Saturday</h5>
                <p class='text-[#333333]'>09AM - 09PM</p>
                <h5 class='text-[#333333]'>Sunday</h5>
                <p class='text-[#333333]'>10AM - 08PM</p>
            </div>
            <div class='space-y-4'>
                <h4 class='section-title text-primary mb-4'>Newsletter</h4>
                <p class='text-[#333333]'>Dolor amet sit justo amet elitr clita ipsum elitr est.</p>
                <div class='relative mx-auto' style='max-width: 400px;'>
                    <input class='form-control border-primary w-full py-3 px-4' type='text' placeholder='Your email'>
                    <button type='button' class='btn btn-primary py-2 absolute top-0 end-0 mt-2 me-2'>SIGNUP</button>
                </div>
            </div>
        </div>
    </div>

    <div class='copyright bg-black py-2.5'>
        <div class='text-center text-xs text-[#333333]'>
            &copy; All Rights Reserved.
        </div>
    </div>
</footer>


  </body>
</html>



?>