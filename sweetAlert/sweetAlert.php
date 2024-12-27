<?php

// Syntax:

// swal("add title Text","Add simple text","add icon",
//        {Json Format To add other swal function})



 function sweetAlert(){
 
    $titre = $_SESSION['msgSweetAlert']['title'] ;
    $text = $_SESSION['msgSweetAlert']['text'] ;
    $status= $_SESSION['msgSweetAlert']['status'] ;
     echo " <script>
            document.addEventListener('DOMContentLoaded', function() {
                Swal.fire({
                    title: '".($status === "success" ? "Succès" : "Erreur")."',
                    text: '$text',
                    icon: '$status'
                });
            });

         </script>" ; 
        unset( $_SESSION['msgSweetAlert'] );


 }
 function sweetAlertDelete( $message){
 echo " <script> Swal.fire({
    title: 'Êtes-vous sûr ?',
    text: $message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Oui, supprimer !',
    cancelButtonText: 'Annuler'
  }).then((result) => {
    if (result.isConfirmed) {
      Swal.fire(
        'Supprimé !',
        'L\'élément a été supprimé avec succès.',
        'success'
      );
      // Ajoutez ici la logique pour effectuer la suppression, par exemple :
      // window.location.href = 'delete.php?id=1';
    }
  }); </script>"  ; }
?>