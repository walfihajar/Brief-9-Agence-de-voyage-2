<?php

enum Statut: string
    {
        case EnAttente = 'En attente';
        case Termine = 'Confirmée';
        case Annule = 'Annulée';
    }


class Reservation2 
{
    private DatabaseManager $dbManager;
    private int $id_reservation;
    private int $id_user;
    private int $id_activite;
    private Statut $statut;
    private ?string $date_reservation;
    private ?string $archive;

    public function __construct(DatabaseManager $dbManager, int $id_reservation=0, int $id_user =0 , int $id_activite =0 , Statut $statut, ?string $date_reservation ='', ?string $archive = '0')
    {
        $this->dbManager = $dbManager;
        $this->id_reservation = $id_reservation;
        $this->id_user = $id_user;
        $this->id_activite = $id_activite;
        $this->statut = $statut;
        $this->date_reservation = $date_reservation;
        $this->archive = $archive;
    }

    public function getAll():array 
    {
        $params = [$this-> archive ='0'];
        return $this->dbManager->selectAll('reservation',$params);
    }

    public function getById()
    {
        return $this->dbManager->selectAll('reservation',[$this->id_reservation]);
    }

    public function ajouterReservation(): bool
    {
        $data = [
            'id_activite' => $this->id_reservation,
            'id_user' => $this->id_user,
            'id_activite' => $this->id_activite,
            'statut' => $this->statut,
            'date_reservation' => $this->date_reservation,
            'archive' => $this->archive
        ];
        return $this->dbManager->insert('reservation',$data);
    }

    public function modifierActivite(array $newStat ):bool
    {
        return $this->dbManager->update('reservation',$newStat, 'id_reservation = ?',[$this->id_reservation]);
    }
}

                                                                                                                                                                                                         
              




