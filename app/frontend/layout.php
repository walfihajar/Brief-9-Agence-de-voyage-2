<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Concevoir une application web de gestion d agence de voyage">
    <meta name="keywords" content="voyage, travel, actvite, destination, reservation ,nature">
    <meta name="author" content="Mina">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" />
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Voyage</title>
    <link rel="icon" href="img/logo.png" type="image/png">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    <link rel="icon" href="img/logo1.jpg" type="image/x-icon">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css"> <!-- icon reseau sociaux-->
    <link rel="stylesheet" href="styles/index.css" />
    <?php  if($title!="DASHBORD") {echo "<script src='js/main.js' defer></script>";} 
    ?>
    <script src='js/burger.js' defer></script>
    <link rel="stylesheet" href="css/style.css" />


</head>

<body class=" flex flex-col relative bg-[url('img/map3.png')] bg-[#FAF5F1] no-repeat bg-cover    kanit-medium">
    <div class=" flex ">
        <aside class="hidden lg:block   bg-white bg-opacity-80   border-2 border-orange-100 rounded-xl w-1/5 p-2 pt-10">
            <div >
                <img class="mx-auto" src="img/logo.png" width="150" alt="logo">
            </div>
            
            <?php  
if ($_SESSION['role'] != 'client') { // Utilisez '==' pour la comparaison
    echo '<nav id="menu" class="hidden lg:flex flex-col justify-center mx-auto items-center align-center mt-16">
            <a href="home.php"
                class="text-orange-400 flex justify-center items-center m-2 w-2/3 border-2 cursor-pointer border-orange-400 rounded-lg hover:scale-[1.1] hover:text-gray-800">
                <span class="material-symbols-outlined cursor-pointer lg:text-4xl">Home</span> Accueil
            </a>
            <a href="activite.php"
                class="text-orange-400 flex items-center justify-center m-2 w-2/3 border-2 cursor-pointer border-orange-400 rounded-lg hover:scale-[1.1] hover:text-gray-800">
                <span class="material-symbols-outlined cursor-pointer lg:text-4xl">kayaking</span> Activité
            </a>
            <a href="reservationClient.php"
                class="text-orange-400 flex items-center m-2 justify-center w-2/3 border-2 cursor-pointer border-orange-400 rounded-lg hover:scale-[1.1] hover:text-gray-800">
                <span class="material-symbols-outlined cursor-pointer lg:text-4xl">airplane_ticket</span> Réservation
            </a>
            <a href="client.php"
                class="text-orange-400 flex items-center justify-center gap-5 m-2 w-2/3 border-2 cursor-pointer border-orange-400 rounded-lg hover:scale-[1.1] hover:text-gray-800">
                <span class="material-symbols-outlined cursor-pointer lg:text-4xl">person_add</span> Client
            </a>
        </nav>'; 
} 
?>

        </aside>
        <div  class="w-full">
            <header class="p-5 lg:my-2.5 ">
            
                <div class=" mx-auto flex justify-between items-center">
                <div >
                <img class="lg:hidden mx-auto" src="img/logo.png" width="150" alt="logo">
            </div>

                <div class="flex  lg:ml-auto lg:flex-row flex-1  items-center  justify-end">
                        <a href="#" class="text-white">
                            <img src="./img/User.png" alt="user logo">
                        </a>

                </div>
                <div id="menuBurger" class="lg:hidden bg-black text-white p-4 absolute w-1/3 top-10 right-0 hidden">
                    <nav class="flex flex-col items-center">
                        <a href="index.php" class="hover:bg-white hover:text-black rounded px-3 py-1 mb-2">DashBoard</a>
                        <a href="reservation.php"
                            class="hover:bg-white hover:text-black rounded px-3 py-1 mb-2">Reservation</a>
                        <a href="activite.php" class="hover:bg-white hover:text-black rounded px-3 py-1 mb-2">Activitée
                            Us</a>
                        <a href="client.php" class="hover:bg-white hover:text-black rounded px-3 py-1 mb-2">Client</a>
                    </nav>
                </div>
                    <div class="lg:hidden ml-auto order-3">
                        <button id="menu-button" class="text-black">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" class="w-8 h-8">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M4 6h16M4 12h16M4 18h16"></path>
                            </svg>
                        </button>
                    </div>




                </div>
<!-- Menu burger-->
              
            </header>
            <div class="px-2.5">
            <hr class="border-t border-orange-400 opacity-50">
          
             </div>

          
            

             <div class=" flex justify-between lg:mx-20  mb-8      p-2 border-b-2 border-y-indigo-300  ">


             <h2 class="text-2xl text-indigo-800  "> <?php echo $title; ?></h2>
          
          
                 <?php  if($title=="Gestion des reservations") {echo $serachActivite;} ?>

         </div>
         
               
          


        


            <main class="flex-grow ">

                <div class=" h-full flex flex-col lg:flex-row lg:px-[20px] gap-20 relative justify-cente">
                    <div class=" w-full ">
                        <?php
                        // Main contient les autres pages 
                        echo isset($content) ? $content : '<p>Bienvenue sur le site de réservation de voyages.</p>';
                        ?>
                    </div>

                </div>

        </div>
        </main>
    </div>
    </div>
    <footer class="mt-10">

        <section class=" flex flex-col md:flex-row items-center justify-between px-8 md:px-20git bra mb-5 ">
            <img src="img/logo.png" width="100" alt="logo">
            <div class="text-orange-500">
                <h3 class="text-lg font-semibold">Follow us</h3>
                <div class="flex space-x-4">
                    <a href="#"><i class='bx bxl-facebook-circle'></i></a>
                    <a href="#"><i class='bx bxl-pinterest'></i></a>
                    <a href="#"><i class='bx bxl-whatsapp'></i></a>
                    <a href="#"><i class='bx bxl-instagram-alt'></i></a>
                </div>
            </div>
        </section>

        <hr class=" mx-10 border-t border-orange-400 opacity-80">

        <section class=" flex flex-col md:flex-row justify-between gap-10 sm:gap-20 px-14 py-10">
            <div class="flex flex-col justify-evenly sm:flex-row gap-10 md:gap-20 w-full text-orange-400">
                <div>
                    <h3 class="text-sm font-semibold mb-1">Activités</h3>
                    <hr class="my-2.5 border-t border-orange-400 opacity-80">
                    <div class="text-gray-800">
                        <a href="#">Surf</a>
                        <div><a href="#">SKY</a></div>
                        <div><a href="#">circuit</a></div>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-bold mb-1">LIENS UTILES</h3>
                    <hr class="my-2.5 border-t border-orange-400 opacity-80">
                    <div class="text-gray-800">
                        <a href="#">FAQ</a>
                        <div><a href="#">Aide en ligne</a></div>
                        <div><a href="#">Conditions d'utilisation</a></div>
                    </div>
                </div>
                <div>
                    <h3 class="text-sm font-bold mb-1">SUPPORT</h3>
                    <hr class="my-2.5 border-t border-orange-400 opacity-80">
                    <div class="text-gray-800">
                        <a href="#">Contactez-nous</a>
                        <div><a href="#">Centre d'assistance</a></div>
                    </div>
                </div>

                <img src="img/footer.jpg" class="w-32 h-32">
            </div>


        </section>
        <div class="px-10">
            <hr class="border-t border-orange-400 opacity-50">
        </div>

        <div class="text-center pt-4 ">
            <p class="text-orange-300  p-4">© 2025-2030 Copyright VoYa
            </p>
        </div>

    </footer>

</body>

</html>