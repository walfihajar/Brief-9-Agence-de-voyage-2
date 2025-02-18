

<?php 
enum TypeActivite: string {
    case VOLS = 'vols';
    case HOTELS = 'hôtels';
    case CIRCUIT = 'circuits touristiques';
}

class Activite
{
    private DatabaseManager $dbManager;
    private int $id_activite;
    private ?string $titre;
    private ?string $description;
    private ?string $destination;
    private ?float $prix;
    private ?string $date_debut;
    private ?string $date_fin;
    private ?int $place_disponible;
    private ?string $archive;
    public ?string $photo ; 
  //  private ?typeActivite $type ; 

    public function __construct(DatabaseManager $dbManager, ?int $id_activite=0 , ?string $titre = '', ?string $description = '', ?string $destination = '', ?float $prix = null, ?string $date_debut = '', ?string $date_fin = '', ?int $place_disponible =null , string $archive = '0' , ?string $photo = ''   )
    {
        $this->dbManager = $dbManager;
        $this->id_activite = $id_activite;
        $this->titre = $titre;
        $this->description = $description;
        $this->destination = $destination;
        $this->prix = $prix;
        $this->date_debut = $date_debut;
        $this->date_fin = $date_fin;
        $this->place_disponible = $place_disponible;
        $this->archive = $archive;
        $this->photo = $photo;


      //  var_dump($this->photo) ; 
       // exit ; 
     //   $this->type = $type;
    }
    
    public function getAll(): array
   {   $params=[ 'archive'=>'0'  ]  ;
        return $this->dbManager->selectAll('activite' , $params);
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
            'archive' => $this->archive ,
            'photo' => $this->photo 
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
            'archive' => $this->archive,
            'type' => $this->type,
            'photo'=>$this->photo
        ] ;
        $condition=['id_activite'=> $this->id_activite] ;
        return $this->dbManager->Update('activite', $data , $condition);
    }



    public function supprimerActivite(): bool
    {
        return $this->dbManager->delete('activite', 'id_activite',$this->id_activite);
    }


   
 
}
