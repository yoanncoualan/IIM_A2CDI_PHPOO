<?php

require './vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once './class/Bdd.php';
require_once './class/Categorie.php';

$bdd = new Bdd();
$sql = 'SELECT * FROM categorie';
// Récupération des données
$resultat = $bdd->prepareExecute($sql);
// Conversion du résultat en objet de type Categorie
$categories = $resultat->fetchAll(PDO::FETCH_CLASS, 'Categorie');
// Parcours des résultats
foreach ($categories as $une_categorie) {
 echo $une_categorie;
}
