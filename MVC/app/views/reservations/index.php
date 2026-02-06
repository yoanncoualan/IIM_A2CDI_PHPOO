<div>
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Mes réservations</h1>

    <?php if (isset($reservations) && count($reservations) > 0): ?>
        <div class="grid gap-6">
            <?php 
            $activiteModel = new ActiviteModel();
            foreach ($reservations as $reservation): 
                $activity = $activiteModel->getActivityById($reservation['activite_id']);
            ?>
                <div class="bg-white rounded-lg border border-gray-200 shadow-sm hover:shadow-md transition-shadow duration-200 overflow-hidden">
                    <div class="p-6">
                        <div class="flex items-start justify-between mb-4">
                            <h2 class="text-xl font-semibold text-gray-800">
                                <a href="/reservation/show/<?= $reservation['id'] ?>" class="hover:text-gray-600 transition-colors duration-200">
                                    Réservation #<?= $reservation['id'] ?>
                                </a>
                            </h2>
                            <span class="px-3 py-1 text-xs font-medium rounded-full <?= $reservation['etat'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                                <?= $reservation['etat'] ? 'Confirmée' : 'Annulée' ?>
                            </span>
                        </div>
                        
                        <div class="space-y-2 text-sm text-gray-600 mb-4">
                            <?php if (!empty($activity)): ?>
                                <p class="flex items-center">
                                    <span class="font-medium text-gray-700 w-32">Activité:</span>
                                    <span><?= htmlspecialchars($activity['nom']) ?></span>
                                </p>
                                <p class="flex items-center">
                                    <span class="font-medium text-gray-700 w-32">Date activité:</span>
                                    <span><?= htmlspecialchars($activity['datetime_debut']) ?></span>
                                </p>
                            <?php endif; ?>
                            <p class="flex items-center">
                                <span class="font-medium text-gray-700 w-32">Date réservation:</span>
                                <span><?= htmlspecialchars($reservation['date_reservation']) ?></span>
                            </p>
                        </div>
                        
                        <?php if ($reservation['etat']): ?>
                            <div class="pt-4 border-t border-gray-100">
                                <a href="/reservation/cancel/<?= $reservation['id'] ?>" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')"
                                    class="text-red-600 hover:text-red-800 text-sm font-medium transition-colors duration-200">
                                    Annuler la réservation
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-12 text-center">
            <p class="text-gray-500 text-lg">Aucune réservation</p>
        </div>
    <?php endif; ?>

    <div class="mt-8 text-center">
        <a href="/" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">← Retour à la liste des activités</a>
    </div>
</div>

