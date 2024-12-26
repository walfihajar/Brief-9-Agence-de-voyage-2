<?php require_once 'DB.php';

class DatabaseManager
{
    private PDO $connection;

    public function __construct()
    {
        // Obtenir l'instance unique de Database
        $db = Database::getInstance();
        // Utiliser la connexion PDO à partir de cette instance
        $this->connection = $db->getConnection();
    }

    // Méthode d'insertion générique
    public function insert(string $table, array $data): bool
    {
        // exemple w3school  
        // $arr = array('Hello','World!','Beautiful','Day!');  
        // $set = implode("=? ,",$arr);   ---->Hello=? ,World!=? ,Beautiful=? ,Day! 
        // $set = $set.'=?' ;
        // echo $set  :   Hello=? ,World!=? ,Beautiful=? ,Day!=?
        //     $placeholders = implode(', ', array_fill(0, count($arr), '?'));
        // echo $placeholders ;     ---->  ?, ?, ?, ?
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));  //array_fill() : Remplit un tableau avec des valeurs.


        $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";
        $stmt = $this->connection->prepare($query);

        return $stmt->execute(array_values($data));
    }

    // Méthode de suppression générique
    public function delete(string $table, string $condition, int $param): bool
    {
        $query = "DELETE FROM $table WHERE $condition =:valeur";
        
        $stmt = $this->connection->prepare($query);
       // $stmt->bindValue(":$param", $condition, PDO::PARAM_STR);

        $stmt->bindValue(":valeur" , $param , PDO::PARAM_INT ) ;

        return $stmt->execute();
    }


    public function update(string $table, array $data, array $condition): bool
{     // j ai un table associative key=> values   je dois recupere les cles de array $data
    //pour les mettre dans set je les ai convertis en chaine de caractere 
    // etape2 : je  recupere les values $data pour l execute dans stmt dans dernire ligne

    $columns =array_keys($data);
    $values = array_values($data);
    
     $set =implode(" =? ," , $columns) ; // converti array to string regarde l exemple de w3s sur insert 
     $set = $set ."=? " ;   
    $cond =array_key_first($condition);

    $query = "UPDATE $table SET $set WHERE  $cond=?";  // j ai utlisier array_key_first($array) pour avoir id_primaire_table que j ai passe en param, vue qu j ai qu une seuele valeur j ai trouvé cette methode pour recupere une seule key et (pas valeur !!!)
     array_push($values , $condition['id_activite']);


     var_dump($query) ;
   //  exit ;
    $stmt = $this->connection->prepare($query);

    if ($stmt->execute($values)){
           echo 'modif ok' ;
            return true ;
    } else {
        echo 'modif non' ;
    }
    
    return $stmt->execute($values);
}  


    public function selectAll(string $table, array $params = []): array
{
    // Début de la requête de base
    $query = "SELECT * FROM $table";

    // Ajouter des conditions si des paramètres sont fournis
    if (!empty($params)) {
        $conditions = [];
        foreach ($params as $param => $condition) {
            // Assurez-vous que les valeurs sont sécurisées, ici on suppose que ce sont des noms de colonnes et des valeurs sécurisées
            $conditions[] = "$param = :$param";  // Utilisation de placeholders pour éviter les injections SQL
        }
        // Joindre toutes les conditions par "AND"
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Préparer et exécuter la requête
    $stmt = $this->connection->prepare($query);
    
    // Lier les paramètres sécurisés
    if (!empty($params)) {
        foreach ($params as $param => $condition) {
            // Utilisation de PDO::PARAM_STR pour lier chaque paramètre, vous pouvez ajuster le type selon vos besoins
            $stmt->bindValue(":$param", $condition, PDO::PARAM_STR);
        }
    }

    // Exécuter la requête
   if ($stmt->execute()){
 // Retourner les résultats sous forme de tableau associatif
 return $stmt->fetchAll(PDO::FETCH_OBJ);
   } else {
      return false ; 
   }

   
}



public function selectById(string $table, array $params = []): ?stdClass
{
    // Début de la requête de base
    $query = "SELECT * FROM $table";

    // Ajouter des conditions si des paramètres sont fournis
    if (!empty($params)) {
        $conditions = [];
        foreach ($params as $param => $condition) {
            // Assurez-vous que les valeurs sont sécurisées, ici on suppose que ce sont des noms de colonnes et des valeurs sécurisées
            $conditions[] = "$param = :$param";  // Utilisation de placeholders pour éviter les injections SQL
        }
        // Joindre toutes les conditions par "AND"
        $query .= " WHERE " . implode(' AND ', $conditions);
    }

    // Préparer et exécuter la requête
    $stmt = $this->connection->prepare($query);
    
    // Lier les paramètres sécurisés
    if (!empty($params)) {
        foreach ($params as $param => $condition) {
            // Utilisation de PDO::PARAM_STR pour lier chaque paramètre, vous pouvez ajuster le type selon vos besoins
            $stmt->bindValue(":$param", $condition, PDO::PARAM_STR);
        }
    }

    // Exécuter la requête
   if ($stmt->execute()){
    $result = $stmt->fetch(PDO::FETCH_OBJ); 
   
 // Retourner les résultats sous forme de tableau associatif
        return $result;
   } else {
      return false ; 
   }

   
}


    public function getLastInsertId(): int
{
    return (int)$this->connection->lastInsertId();
}
}
