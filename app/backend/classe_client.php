

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

    public function ajouterActivite(): bool
    {
        $data =  [
            'id_activite' => $this->id_activite,
            'titre' => $this->titre,
            'description' => $this->description,
            'destination' => $this->destination,
            'prix' => $this->prix,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'place_disponible' => $this->place_disponible,
            'archive' => $this->archive
        ] ;
        return $this->dbManager->insert('activite', $data);
    }

    public function EditerActivite(): bool
    {
        $data =  [
            'titre' => $this->titre,
            'description' => $this->description,
            'destination' => $this->destination,
            'prix' => $this->prix,
            'date_debut' => $this->date_debut,
            'date_fin' => $this->date_fin,
            'place_disponible' => $this->place_disponible,
            'archive' => $this->archive
        ] ;
        $condition=['id_activite'=> $this->id_activite] ;
        return $this->dbManager->Update('activite', $data , $condition);
    }



    public function supprimerActivite(): bool
    {
        return $this->dbManager->delete('activite', 'id_activite',$this->id_activite);
    }

    public function modifierActivite(array $nouveauxDetails): bool
    {
        return $this->dbManager->update('activite', $nouveauxDetails, 'id_activite = ?', [$this->id_activite]);
    }
}
