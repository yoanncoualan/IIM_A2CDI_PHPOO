<!DOCTYPE html>
<html lang="fr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?= $title ?? 'Mon titre par défaut' ?></title>
 <!-- <link rel="stylesheet" href="/assets/style.css"> -->
</head>

<body>
 <header>
  <h1>Mon site MVC</h1>
  <nav>
   <a href="/user/findAll">Liste des utilisateurs</a>
   <a href="/user/one/1">1er utilisateur</a>
   <a href="/user/register">S'inscrire</a>
  </nav>
 </header>

 <main>
  <?= $content ?? '<p>Aucun contenu à afficher</p>' ?>
 </main>

 <footer>
    <h1>Login</h1>
    <form action="POST">
    <input type="text" placeholder="Username" name="username">
    <input type="password" placeholder="Password" name="password">
    <button type="submit">Sumbit yeahh</button>
    </form>
 
 </footer>
</body>

</html>