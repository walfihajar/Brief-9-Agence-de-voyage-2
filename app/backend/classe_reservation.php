<?php
require_once(__DIR__ . '/../../includ/DB.php');
enum Statut: string
    {
        case enAttente = 'En attente';
        case confirmee = 'Confirmée';
        case annulee = 'Annulée';
    }


class Reservation 
{
 
    private int $id_reservation;
    private int $id_user;
    private int $id_activite;
    private Statut $statut;
    private ?string $date_reservation;
    private ?string $archive;
    private $db ;

    public function __construct(?int $id_reservation=0, ?int $id_user =0 , ?int $id_activite =0 , ?Statut $statut = null, ?string $date_reservation ='', ?string $archive = '0')
    {
        $this->id_reservation = $id_reservation;
        $this->id_user = $id_user;
        $this->id_activite = $id_activite;
        $this->statut = $statut ?? statut::enAttente;
        $this->date_reservation = $date_reservation ?: date('Y-m-d H:i:s');
        $this->archive = $archive;
    
        $conn= Database :: getInstance() ; 
        $this->db = $conn->getConnection() ; 

    }
    static public function affichertt($db){
        $query = " select r.id_reservation, a.titre,  u.nom, u.prenom, r.statut, r.date_reservation , a.prix
                   from reservation as r
                   inner join activite as a on a.id_activite = r.id_activite               
                   inner join users as u on u.id_user = r.id_user" ;    
        $stmt = $db->prepare($query);
        $stmt-> execute();
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
         return $result ; 
    }
    static public function createReservation($newRes){

        $query = "insert into reservation (id_user , id_activite , statut , date_reservation)
         values (:id_user , :id_activite , :statut , :date_reservation )" ; 

        $stmt =  $newRes->db->prepare($query) ; 


        $statutValue = $newRes->statut->value; 

       
        $stmt->bindParam(':id_user' , $newRes->id_user ) ; 
        $stmt->bindParam(':id_activite' , $newRes->id_activite ) ;
        $stmt->bindParam(':statut', $statutValue) ;
        $stmt->bindParam(':date_reservation' , $newRes->date_reservation ) ;

        $stmt->execute(); 
          
    }
    static public function modifyReservation($modifiedRes){

        $query = "update reservation
                  set id_user = :id_user, id_activite = :id_activite, statut = :statut, date_reservation = :date_reservation 
                  where id_reservation = :id_reservation ";

        $stmt = $modifiedRes->db->prepare($query);

        $statutValue = $modifiedRes->statut->value;
        $stmt->bindParam(':id_reservation', $modifiedRes->id_reservation);
        $stmt->bindParam(':id_user',$modifiedRes->id_user);
        $stmt->bindParam(':id_activite',$modifiedRes->id_activite);
        $stmt->bindParam(':statut',$statutValue);
        $stmt->bindParam(':date_reservation',$modifiedRes->date_reservation);

        $stmt->execute();
    }

    public function changeStatut($id_reservation, $newStatut){
        $query = "update reservation 
                  set statut = :statut
                  where id_reservation = :id_reservation";
        $stmt = $this->db->prepare($query);
        $stmt-> bindParam(':id_reservation',$id_reservation,PDO::PARAM_INT);
        $stmt->bindParam(':statut',$newStatut,PDO::PARAM_STR);
        $stmt->execute();
    }
    
    public function archiveRes($id_reservation){
        $query = "UPDATE reservation 
                  SET archive = '1' 
                  WHERE id_reservation = :id_reservation";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id_reservation', $id_reservation, PDO::PARAM_INT);
        $stmt->execute();
    }}



// $reservation1 = new Reservation(
//     78,              
//     1,                 
//     2,                 
//     Statut::enAttente,  
//     date('2024-10-4 12:12:12'), 
//     '0'                
// );


// Reservation::createReservation($reservation1);