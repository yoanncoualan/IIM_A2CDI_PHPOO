<?php

class BDD{
    private $db = null;
   
    public function __construct()
    {
      // Si on n'est pas déjà connecté à la BDD
      if($this->db == null){
        $this->connect();
      }
    }
    
    // Nouvelle connexion à la BDD
    private function connect():void
    {
        try{
            $this->db = new PDO(
              'mysql:host='. $_ENV['db_host'] .';dbname='. $_ENV['db_name'],
              $_ENV['db_user'],
              $_ENV['db_pwd']
            );
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
          }
          catch(Exception $e){
            // Affichage de l'erreur
            echo $e->getCode() .' : '. $e->getMessage();
          }
        }
    
  }
?>