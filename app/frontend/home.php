<?php
//ob_start();
session_start() ; 
require("../../sweetAlert/sweetAlert.php"); 

require "../backend/classe_activite.php";
require "../backend/class_reservation.php";

require_once __DIR__ . '/../../includ/DB.php';
require_once __DIR__ . '/../../includ/DatabaseManager.php';
$dbManager = new DatabaseManager();
$objActivite = new Activite($dbManager , 0);


// if($_SERVER['REQUEST_METHOD']=="POST" && isset($_SESSION['msgSweetAlert'])){
//   sweetAlert(); 
// }

?>
<!DOCTYPE html>
<html lang='en'>
  <head>
    <meta charset='UTF-8' />
    <meta name='viewport' content='width=device-width, initial-scale=1.0' />
    <title>Voyage</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> <!-- sweet alert-->
    <script src='https://cdn.tailwindcss.com'></script>
    <link rel='stylesheet' href='css/style.css' />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=search" />
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
      class='bg-[#FAF5F1]  text-gray-800 px-4 lg:p-8 flex justify-between items-center'
    >
      <a href='#' class='flex items-center space-x-2'>
        <div class='text-primary text-2xl font-bold flex items-center'>
          <img  class='   w-30 h-16 ' src='img/logo.png'>
       
        </div>
    
      </a>
      <button class='lg:hidden text-white text-2xl' id='navbar-toggler'>
        <i class='fa fa-bars'></i>
      </button>
      <div class='hidden lg:flex items-center space-x-6' id='navbar-menu'>
        <a href='home.php' class='hover:text-[#FEA116] '>Home</a>
        <a href='about.html' class='hover:text-[#FEA116] '>About</a>
        <a href='service.html' class='hover:text-[#FEA116] '>Service</a>
        <a href='contact.html' class='hover:text-[#FEA116] '>Contact</a>

       
          <?php if($_SESSION['id_role'] ==3 ){ //client
                      echo " <a href='reservationClient.php' class='hover:text-[#FEA116] '>
                <span class='material-symbols-outlined text-4xl '>
                  airplane_ticket
                  </span></i></a>"
                      exit ;
            }
            else if($_SESSION['id_role'] ==2   ){ //admin et super admin 
              echo " <a href='Dashboard.php' class='hover:text-[#FEA116] '>
              <span class='material-symbols-outlined text-4xl '>
                airplane_ticket
                </span></i></a>"
                    exit ;
            } 
            else if($_SESSION['id_role'] ==1   ){ //admin et super admin 
              echo " <a href='client.php' class='hover:text-[#FEA116] '>
              <span class='material-symbols-outlined text-4xl '>
                airplane_ticket
                </span></i></a>"
                    exit ;
            } 
?>
          <div class='relative group'>
            <a href='#' id='menuToggle' class='flex items-center hover:text-[#FEA116] text-3xl'>
              <i class='fa-solid fa-user-tie'></i>
              <i class='fa fa-caret-down'></i>
            </a>
            <div
              id='dropdownMenu'
              class='absolute hidden bg-gray-800 text-white mt-2 rounded shadow-md p-2 space-y-2'
            >
              <a href='../login/login.php' class='block hover:bg-gray-700 p-2 rounded'>se connecter</a>
              <a href='../login/register.php' class='block hover:bg-gray-700 p-2 rounded'>s'inscrire</a>
              <a href='../login/deconnecter.php' class='block hover:bg-gray-700 p-2 rounded'>se deconnecter</a>
            </div>
          </div>
       
      </div>
    </nav>

    <!-- Hero Section -->
    <div class="px-6 md:px-20 lg:px-8 lg:py-16  bg-[url('img/map3.png')] bg-[#FAF5F1] no-repeat bg-cover" 
    >
   <div class="md:flex md:space-x-10">
    <div class="md:w-1/2">
   
    <p class="text-2xl text-gray-700 mb-5">
    <?php if (isset($_SESSION['role']) && $_SESSION['role']=="client") { ?>
        <span class='text-orange-500'><?php echo htmlspecialchars($_SESSION['nom'], ENT_QUOTES, 'UTF-8'); ?></span>
    <?php } ?>
    </p>
   
    <h1 class="text-4xl md:text-5xl font-bold leading-tight">
     Voyagez au-delà , 
      <br/>
      au-delà
      <span class="text-orange-500">
      des frontières
      </span>
      <br/>
      vivez l'inoubliable
     </h1>
     <p class="mt-6 text-gray-700">
     Découvrez les Merveilles Cachées du Monde
     Découvrez les moments uniques et les trésors cachés qui déclenchent des expériences inoubliables. Des rencontres rares aux destinations remarquables, nous vous aidons à dévoiler l'étincelle qui transforme chaque voyage en une histoire précieuse
     </p>
     <button class="mt-6 bg-orange-500 text-white px-6 py-3 rounded-full">
     Planifiez votre voyage
     </button>
    </div>
    <div class="mt-10 md:mt-0 md:w-1/2 grid grid-cols-1 sm:grid-cols-2 gap-6">
     <img alt="A beautiful castle-like building in Quebec City, Canada" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/SlGN8l6nGMqfCCH2xjWvelhZI5VCgbVrM9riGzNqTGZHuHfnA.jpg" width="300"/>
     <img alt="Ancient temples in Bagan, Myanmar" class="rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/cluJHuTjf6y9YyCkXopoAuVqXxi8oty1bhbYAG6DgLdE3jfTA.jpg" width="300"/>
     <div></div>
     <img alt="Traditional    Chinese architecture in a serene garden" class=" self-center git rounded-lg" height="200" src="https://storage.googleapis.com/a1aa/image/oGLoGZOe1UVMAKshfLGpe96nkL12wZ81BJxn0irlEqoUcPePB.jpg" width="300"/>
    </div>
   </div>
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
<div id='menu-section' class="py-16 px-10    bg-[url('img/map3.png')] bg-[#FAF5F1] no-repeat bg-cover pt-10">
  <h2 class='text-center text-5xl font-bold text-gray-800 mb-8'>
    ~ TOP PLAN ~
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
            <li class='list-group-item'> prix : $ {$objet->prix} </li>
            <li class='list-group-item'> de {$objet->date_debut} jusqu'a {$objet->date_fin} </li>
            <li class='list-group-item'> Place disponible {$objet->place_disponible}</li>
            <li class='list-group-item'>  {$objet->description} </li>
            </ul>
        <form method='post' action='home.php' >
             <input type='hidden' name='id_activite' value='{$objet->id_activite}'>
            <button type=submit name='reserver'  class=' mx-8 float-right text-end text-[#21a9db] underline hover:scale-150 transition-transform cursor-pointer inline-block'
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
    $id_client =  $_SESSION['id'];
    // var_dump($id_client) ;
    // exit;
    $id_activite =  $_POST['id_activite'];
    $date_reservation = date('Y-m-d H:i:s');
    $id_user = $_SESSION["id"];
    $statut = Statut::enAttente;
   $ObjetReservation = new Reservation(0 , $id_client ,$id_activite ,$statut ,  $date_reservation );
   $result = Reservation::createReservation($ObjetReservation);


   if($result){
    $_SESSION['msgSweetAlert'] = [
         'title' =>'success'  ,
         'text' => 'reservation effectue avec succes , veuillez attendre la confirmation de votre réservation ',
         'status'=> 'success'
    ]  ;
    sweetAlert('home.php'); 
    exit; 

  } else{
    $_SESSION['msgSweetAlert']= [
      'title' =>'Avertissment'  ,
      'text' => 'reservation echouée',
      'status' => 'error'
 ] ;
 sweetAlert('home.php'); 
 exit; 
   }

 }
 else {
        
  $_SESSION['msgSweetAlert']= [
    'title' =>'Avertissment'  ,
    'text' => 'reservation echouée',
    'status' => 'error'
] ;
sweetAlert('home.php'); 
exit; 
}

 }
?>













<div class="h-80 container-fluid bg-[#0f172b] bg-[url('img/footer1.jpg')] bg-opacity-50 no-repeat bg-cover text-[#333333] pt-5" 
     style="background-size: 100% auto; background-position: center;">
    <div class="flex flex-col items-center justify-center h-full text-white text-center">
        <h1 class="text-3xl font-bold mb-6">Partez à l’aventure, revenez avec des souvenirs</h1>
        <form class="w-full max-w-md relative">
            <input type="text"  placeholder="Recherchez votre prochaine destination" 
                   class="w-full p-4 text-gray-700   placeholder:text-sm  rounded-full focus:outline-none focus:ring-2 focus:ring-[#FEA116]">
            <button type="submit" class="absolute right-2 top-1/2 transform -translate-y-1/2 bg-[#FEA116] text-white px-2 py-1 rounded-full"><span class="material-symbols-outlined">search</span>
            </button>
        </form>
    </div>
</div>








<footer class="container-fluid bg-[#0f172b] bg-[url('img/map3.png')] bg-[#FAF5F1] no-repeat bg-cover text-[#333333]  pt-5 ">
    <div class='container py-5'>
        <div class='grid grid-cols-1 lg:grid-cols-4 gap-5 px-10'>
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


