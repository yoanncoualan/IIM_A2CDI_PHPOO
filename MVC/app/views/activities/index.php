<div class="mb-8">
    <h1 class="text-3xl font-semibold text-gray-800 mb-2">Liste des activités</h1>
    <?php if (isset($isAdmin) && $isAdmin): ?>
        <a href="/activity/create" class="inline-block mt-4 bg-gray-800 text-white px-5 py-2.5 rounded-md hover:bg-gray-900 transition-colors duration-200 text-sm font-medium">
            Ajouter une nouvelle activité
        </a>
    <?php endif; ?>
</div>

<?php if (isset($activities) && count($activities) > 0): ?>
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($activities as $activity): ?>
            <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">
                        <a href="/activity/show/<?= $activity['id'] ?>" class="hover:text-gray-600 transition-colors duration-200">
                            <?= htmlspecialchars($activity['nom']) ?>
                        </a>
                    </h2>
                    
                    <div class="space-y-2 text-sm text-gray-600 mb-4">
                        <?php if (isset($activity['type_nom'])): ?>
                            <p class="flex items-center">
                                <span class="font-medium text-gray-700 w-24">Type:</span>
                                <span><?= htmlspecialchars($activity['type_nom']) ?></span>
                            </p>
                        <?php endif; ?>
                        <p class="flex items-center">
                            <span class="font-medium text-gray-700 w-24">Date:</span>
                            <span><?= htmlspecialchars($activity['datetime_debut']) ?></span>
                        </p>
                        <p class="flex items-center">
                            <span class="font-medium text-gray-700 w-24">Durée:</span>
                            <span><?= htmlspecialchars($activity['duree']) ?> minutes</span>
                        </p>
                        <p class="flex items-center">
                            <span class="font-medium text-gray-700 w-24">Places:</span>
                            <span class="font-semibold text-gray-800"><?= htmlspecialchars($activity['places_disponibles']) ?></span>
                        </p>
                    </div>
                    
                    <?php if ($activity['description']): ?>
                        <p class="text-sm text-gray-600 mt-4 pt-4 border-t border-gray-100">
                            <?= htmlspecialchars($activity['description']) ?>
                        </p>
                    <?php endif; ?>
                    
                    <a href="/activity/show/<?= $activity['id'] ?>" class="inline-block mt-4 text-gray-800 hover:text-gray-600 text-sm font-medium transition-colors duration-200">
                        Voir les détails →
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <div class="bg-white rounded-lg border border-gray-200 p-12 text-center">
        <p class="text-gray-500 text-lg">Aucune activité disponible</p>
    </div>
<?php endif; ?>

