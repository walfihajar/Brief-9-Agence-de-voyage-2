<?php 
require_once __DIR__ . '/../../includ/DB.php';
class User
{
    private int $id_user;
    private string $nom;
    private string $prenom;
    private string $email;
    private string $pwd;
    private string $telephone;
    private string $adresse;
    private int $id_role;
    private int $archive;

    // Connexion à la base de données
    private $db;

    public function __construct($nom,$prenom, $email, $pwd, $telephone, $adresse,$id_role = 2,$archive = 0
    ) {
        // base de donnée ; 
        $this->db = Database::getInstance()->getConnection();
       
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->pwd = $pwd;
        $this->telephone = $telephone;
        $this->adresse = $adresse;
        $this->id_role = $id_role;
        $this->archive = $archive;


        
    }
    public function __toString()
    {
        return "Nom: {$this->nom}, Prénom: {$this->prenom}, Email: {$this->email}, Téléphone: {$this->telephone}, Adresse: {$this->adresse}, Rôle: {$this->id_role}, Archive: {$this->archive}";
    }
    // Méthode statique pour la connexion d'utilisateur
    public static function  login($email, $password)
    {
        try {
            // 1. Vérifier si l'email existe dans la base de données
            $newdb = Database::getInstance();
            $db=$newdb->getConnection() ;
            $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
            $stmt->bindParam(':email', $email);
            $stmt->execute();

            // Si l'utilisateur existe
            if ($stmt->rowCount() > 0) {
                $user = $stmt->fetch(PDO::FETCH_OBJ);  // recupere le reusltat sous forme d objet en revanche ; il recupere sous format array assoc $user = $stmt->fetch(PDO::FETCH_ASSOC);  
                
                // 2. Vérifier si le mot de passe est correct
                if (password_verify($password, $user->pwd)) {
                    // Si le mot de passe est correct, retourner l'utilisateur
                    return [
                        'success' => true,
                        'user' => $user
                    ];
                } else {
                    // Si le mot de passe ne correspond pas
                    return [
                        'success' => false,
                        'message' => 'Mot de passe incorrect.'
                    ];
                }
            } else {
                // Si l'email n'existe pas dans la base de données
                return [
                    'success' => false,
                    'message' => 'Aucun utilisateur trouvé avec cet email.'
                ];
            }
        } catch (PDOException $e) {
            // Gérer les erreurs liées à la base de données
            return [
                'success' => false,
                'message' => 'Erreur de connexion à la base de données: ' . $e->getMessage()
            ];
        }
    }
    /*static function findUserbyEmail($email){
            $strm = DB:connect()->prepare("SELECT id_user, nom, mdp  ,id_role FROM users WHERE email = :email");
            $strm->bindParm(':email':$email);
            $strm->execute();
            if($strm->rowCount()>0){
                $pwd = $strm->fetch();
                return $pwd ;
            } else{ return false ;}   
    }*/

    // Méthode statique pour enregistrer un nouvel utilisateur
    static public function registreUser($newUser)
    {
        try {
     
            $strm = $newUser->db->prepare('
                INSERT INTO users (nom, prenom, email, pwd, telephone, adresse, id_role, archive) 
                VALUES (:nom, :prenom, :email, :pwd, :telephone, :adresse, :id_role, :archive)
            ');
            $strm->bindParam(':nom', $newUser->nom);
            $strm->bindParam(':prenom', $newUser->prenom);
            $strm->bindParam(':email', $newUser->email);
            $strm->bindParam(':pwd', $newUser->pwd);
            $strm->bindParam(':telephone', $newUser->telephone);
            $strm->bindParam(':adresse', $newUser->adresse);
            $strm->bindParam(':id_role', $newUser->id_role);
            $strm->bindParam(':archive', $newUser->archive);

        
            if ($strm->execute()) {
                return true; 
            } else {
                return false; 
            }
        } catch (PDOException $e) {
            echo "Erreur lors de l'insertion : " . $e->getMessage();
            return false;
        }
    }
}
