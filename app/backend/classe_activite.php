

<?php 

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

    public function __construct(DatabaseManager $dbManager, int $id_activite, string $titre = '', ?string $description = '', ?string $destination = '', ?float $prix = null, ?string $date_debut = '', ?string $date_fin = '', ?int $place_disponible =null , string $archive = '0')
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
    }


  
    
    public function getAll(): array
   {   $params=[
        $this->archive ='0'      ]  ;
        return $this->dbManager->selectAll('activite' , $params);
    }
    public function getById(): bool
    {
        return $this->dbManager->selectAll('activite', 'id_activite = ?', [$this->id_activite]);
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




    public function supprimerActivite(): bool
    {
        return $this->dbManager->delete('activite', 'id_activite',$this->id_activite);
    }

    public function modifierActivite(array $nouveauxDetails): bool
    {
        return $this->dbManager->update('activite', $nouveauxDetails, 'id_activite = ?', [$this->id_activite]);
    }
}
