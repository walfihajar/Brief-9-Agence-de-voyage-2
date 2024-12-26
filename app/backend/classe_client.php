

<?php 

class Activite
{
    class Client {
        private DatabaseManager $dbManager;
        private int $id_user;
        private ?string $nom;
        private ?string $prenom;
        private ?string $email;
        private ?float $pwd;
        private ?string $telephone; // Notez la correction de l'orthographe ici
        private ?string $adresse;
        private ?int $id_role;
        private ?string $archive;
    
        public function __construct(DatabaseManager $dbManager, int $id_user, ?string $nom = '', ?string $prenom = '', ?string $email = '', ?float $pwd = null, ?string $telephone = '', ?string $adresse = '', ?int $id_role = null, ?string $archive = '0') {
            $this->dbManager = $dbManager;
            $this->id_user = $id_user;
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->email = $email;
            $this->pwd = $pwd;
            $this->telephone = $telephone; // Correction de l'orthographe
            $this->adresse = $adresse;
            $this->id_role = $id_role;
            $this->archive = $archive;
        }
    }


  
    
    public function getAll(): array
   {   $params=[ 'archive'=>'0'  ]  ;
        return $this->dbManager->selectAll('client' , $params);
    }

    public function getById($id): ?stdClass
    {
    //       echo('<br/>---  id : -------------') ;
    //     var_dump($id) ; 
    //       echo('<br/>------ -------------') ;
        $params=['id_activite' => $id] ;
    //   // var_dump($params) ; 

    //   echo('<br/>------ resultat -------------') ;
    //   print_r($this->dbManager->selectById('activite', $params));
        return $this->dbManager->selectById('activite', $params);
    }





    public function getById($id): ?stdClass
    {
    //       echo('<br/>---  id : -------------') ;
    //     var_dump($id) ; 
    //       echo('<br/>------ -------------') ;
        $params=['id_activite' => $id] ;
    //   // var_dump($params) ; 

    //   echo('<br/>------ resultat -------------') ;
    //   print_r($this->dbManager->selectById('activite', $params));
        return $this->dbManager->selectById('activite', $params);
    }

    public function ArchiveClient(): bool
    {
        $data =  [
            'archive' => 0
        ] ;
        $condition=['id_client'=> $this->id_client] ;
        return $this->dbManager->Update('client', $data , $condition);
    }

    public function supprimerActivite(): bool
    {
        return $this->dbManager->delete('activite', 'id_activite',$this->id_activite);
    }

 
}
