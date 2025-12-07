<!DOCTYPE html>
<html lang="fr">

<head>
 <meta charset="UTF-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <title><?= $title ?? 'Mon titre par défaut' ?></title>
 <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 min-h-screen">
 <header class="bg-white border-b border-gray-200 shadow-sm">
  <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
   <div class="flex justify-between items-center py-6">
    <h1 class="text-2xl font-semibold text-gray-800">Parc d'activités</h1>
    <nav class="flex items-center space-x-6">
     <a href="/" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">Activités</a>
     <?php if (isset($_SESSION['id'])): ?>
      <a href="/reservation" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">Mes réservations</a>
      <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
       <a href="/user" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">Utilisateurs</a>
       <a href="/reservation/list" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">Toutes les réservations</a>
      <?php endif; ?>
      <a href="/user/logout" class="text-gray-600 hover:text-red-400 transition-colors duration-200">Déconnexion</a>
     <?php else: ?>
      <a href="/user/register" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">S'inscrire</a>
      <a href="/user/login" class="bg-gray-800 text-white px-4 py-2 rounded-md hover:bg-gray-900 transition-colors duration-200">Connexion</a>
     <?php endif; ?>
    </nav>
   </div>
  </div>
 </header>

 <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
  <?= $content ?? '<p class="text-gray-500">Aucun contenu à afficher</p>' ?>
 </main>

</body>

</html>