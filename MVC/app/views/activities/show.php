<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8"><?= htmlspecialchars($activity['nom']) ?></h1>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 mb-6">
        <div class="space-y-4">
            <?php if (isset($activity['type_nom'])): ?>
                <div class="flex items-start">
                    <span class="text-sm font-medium text-gray-700 w-32">Type:</span>
                    <span class="text-gray-800"><?= htmlspecialchars($activity['type_nom']) ?></span>
                </div>
            <?php endif; ?>
            
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-700 w-32">Description:</span>
                <span class="text-gray-800"><?= htmlspecialchars($activity['description']) ?></span>
            </div>
            
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-700 w-32">Date de début:</span>
                <span class="text-gray-800"><?= htmlspecialchars($activity['datetime_debut']) ?></span>
            </div>
            
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-700 w-32">Durée:</span>
                <span class="text-gray-800"><?= htmlspecialchars($activity['duree']) ?> minutes</span>
            </div>
            
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-700 w-32">Places restantes:</span>
                <span class="text-gray-800 font-semibold"><?= htmlspecialchars($placesLeft) ?> / <?= htmlspecialchars($activity['places_disponibles']) ?></span>
            </div>
        </div>
    </div>

    <?php if (isset($isAdmin) && $isAdmin): ?>
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 mb-6">
            <div class="flex items-center space-x-4">
                <a href="/activity/update/<?= $activity['id'] ?>" class="bg-gray-800 text-white px-5 py-2.5 rounded-md hover:bg-gray-900 transition-colors duration-200 text-sm font-medium">
                    Modifier
                </a>
                <a href="/activity/delete/<?= $activity['id'] ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette activité ?')" 
                    class="bg-red-600 text-white px-5 py-2.5 rounded-md hover:bg-red-700 transition-colors duration-200 text-sm font-medium">
                    Supprimer
                </a>
            </div>
        </div>
    <?php endif; ?>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 mb-6">
        <?php if (isset($isLoggedIn) && $isLoggedIn && $placesLeft > 0): ?>
            <form action="/reservation/create/<?= $activity['id'] ?>" method="POST">
                <button type="submit" class="bg-gray-800 text-white px-6 py-3 rounded-md hover:bg-gray-900 transition-colors duration-200 font-medium w-full">
                    Réserver cette activité
                </button>
            </form>
        <?php elseif (isset($isLoggedIn) && $isLoggedIn && $placesLeft <= 0): ?>
            <p class="text-red-600 font-medium text-center">Plus de places disponibles</p>
        <?php else: ?>
            <p class="text-center">
                <a href="/user/login" class="text-gray-800 hover:text-gray-600 transition-colors duration-200 font-medium">
                    Connectez-vous pour réserver
                </a>
            </p>
        <?php endif; ?>
    </div>

    <div class="text-center">
        <a href="/" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">← Retour à la liste</a>
    </div>
</div>

