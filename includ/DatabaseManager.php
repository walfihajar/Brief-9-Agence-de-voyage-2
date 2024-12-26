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
        $columns = implode(', ', array_keys($data));
        $placeholders = implode(', ', array_fill(0, count($data), '?'));

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

    // Méthode de mise à jour générique
    public function update(string $table, array $data, string $condition, array $params): bool
    {
        $set = implode(', ', array_map(fn($key) => "$key = ?", array_keys($data)));

        $query = "UPDATE $table SET $set WHERE $condition";
        $stmt = $this->connection->prepare($query);

        return $stmt->execute(array_merge(array_values($data), $params));
    }
   /* exemple de foreach : $members = array("Peter"=>"35", "Ben"=>"37", "Joe"=>"43");
            foreach ($members as $x => $y) {
            echo "$x : $y <br>";
            }foreach ($members as $x => $y) {
            echo "$x : $y <br>";
          }*/
    // Méthode pour récupérer des données

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


    public function getLastInsertId(): int
{
    return (int)$this->connection->lastInsertId();
}
}
