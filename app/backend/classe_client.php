

<?php 


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
    
    
        public function getAll(): array
       {   $params=[ 'archive'=>'0'  ]  ;
            return $this->dbManager->selectAll('users' , $params);
        }

        public function getById($id): ?stdClass
        {
            $params=['id_activite' => $id] ;
            return $this->dbManager->selectById('users', $params);
        }
        //changer Role
        public function EditerRoleClient(): bool
        {
            $data =  [
                'id_role' => $this->id_role 
                ] ;
            $condition=['id_user'=> $this->id_user] ;
            return $this->dbManager->Update('users', $data , $condition);
        }
        // archive 
        public function ArchiverClient(): bool
        {
            $data =  [
                'archive' => $this->archive
                ] ;
            $condition=['id_user'=> $this->id_user] ;
            return $this->dbManager->Update('users', $data , $condition);
        }

        public function setIdRole(int $id_role): void {
            $this->id_role = $id_role;
        }
        public function setArchive(int $archive): void {
            $this->archive = $archive;
        }

        public function supprimerClient(): bool
        {
            return $this->dbManager->delete('users', 'id_user',$this->id_user);
        }
    
 
}
