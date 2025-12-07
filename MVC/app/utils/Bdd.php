<?php
abstract class Bdd
{
    protected $co = null;

    /**
     * Établit la connexion si elle n'existe pas déjà.
     */
    protected function __construct()
    {
        if ($this->co == null) {
            $this->connect();
        }
    }

    /**
     * Méthode privée pour créer la connexion PDO.
     * Utilise les variables d'environnement ($_ENV).
     */
    private function connect(): void
    {
        $this->co = new PDO(
            'mysql:host=' . $_ENV['db_host'] . ';dbname=' . $_ENV['db_name'],
            $_ENV['db_user'],
            $_ENV['db_pwd']
        );
    }

    /**
     * Retourne l'objet de connexion PDO.
     */
    public function getCo(): PDO
    {
        return $this->co;
    }
}