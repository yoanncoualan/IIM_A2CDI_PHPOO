<?php 

require './vendor/autoload.php';
 
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

require_once './bdd.php';
 
$bdd = new Bdd();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=h&, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>dfgdfgdfg</h1>
</body>
</html>