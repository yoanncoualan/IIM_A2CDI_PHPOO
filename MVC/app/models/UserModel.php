<?php
/**
 * Gère toutes les opérations CRUD et d'authentification liées aux utilisateurs.
 * Hérite de Bdd pour la connexion PDO ($this->co).
 */
class UserModel extends Bdd
{

    // Appelle le constructeur de la classe parente (Bdd) pour initialiser $this->co.
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Tente de connecter un utilisateur en vérifiant l'email et le mot de passe.
     * Utilise password_verify() pour la sécurité.
     * @param string $email Email de l'utilisateur.
     * @param string $motdepasse Mot de passe en clair soumis.
     * @return array Les données de l'utilisateur ou un tableau vide ([]).
     */
    public function logUser(string $email, string $motdepasse): array
    {
        $stmt = $this->co->prepare('SELECT * FROM users WHERE email = :email');
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Vérifie si l'utilisateur existe ET si le hash du mot de passe correspond.
        if ($user && password_verify($motdepasse, $user['motdepasse'])) {
            return $user;
        }
        return [];
    }

    /**
     * Crée un nouvel utilisateur.
     * Le mot de passe est haché via password_hash() pour la sécurité.
     * @param array $data Tableau contenant prenom, nom, email, motdepasse et role.
     * @return bool Succès de l'insertion.
     */
    public function createUser(array $data): bool
    {
        $stmt = $this->co->prepare('INSERT INTO users (prenom, nom, email, motdepasse, role) VALUES (:prenom,:nom,:email,:motdepasse,:role)');
        return $stmt->execute([
            'prenom' => $data['prenom'],
            'nom' => $data['nom'],
            'email' => $data['email'],
            // Hachage du mot de passe (très important !).
            'motdepasse' => password_hash($data['motdepasse'], PASSWORD_DEFAULT),
            // Utilise 'user' par défaut si 'role' n'est pas fourni dans $data.
            'role' => $data['role'] ?? 'user' 
        ]);
    }

    /**
     * Récupère la liste de tous les utilisateurs.
     * @return array Liste de tous les utilisateurs.
     */
    public function getAllUsers(): array
    {
        $stmt = $this->co->prepare('SELECT * FROM users');
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}