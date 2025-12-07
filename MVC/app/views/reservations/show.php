<div class="max-w-3xl mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Détails de la réservation</h1>

    <?php 
    $activiteModel = new ActiviteModel();
    $activity = $activiteModel->getActivityById($reservation['activite_id']);
    ?>

    <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-8 mb-6">
        <div class="space-y-4">
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-700 w-40">ID réservation:</span>
                <span class="text-gray-800 font-semibold">#<?= htmlspecialchars($reservation['id']) ?></span>
            </div>
            
            <?php if (!empty($activity)): ?>
                <div class="flex items-start">
                    <span class="text-sm font-medium text-gray-700 w-40">Activité:</span>
                    <a href="/activity/show/<?= $activity['id'] ?>" class="text-gray-800 hover:text-gray-600 transition-colors duration-200 font-medium">
                        <?= htmlspecialchars($activity['nom']) ?>
                    </a>
                </div>
                
                <div class="flex items-start">
                    <span class="text-sm font-medium text-gray-700 w-40">Description:</span>
                    <span class="text-gray-800"><?= htmlspecialchars($activity['description']) ?></span>
                </div>
                
                <div class="flex items-start">
                    <span class="text-sm font-medium text-gray-700 w-40">Date de l'activité:</span>
                    <span class="text-gray-800"><?= htmlspecialchars($activity['datetime_debut']) ?></span>
                </div>
                
                <div class="flex items-start">
                    <span class="text-sm font-medium text-gray-700 w-40">Durée:</span>
                    <span class="text-gray-800"><?= htmlspecialchars($activity['duree']) ?> minutes</span>
                </div>
            <?php endif; ?>
            
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-700 w-40">Date de réservation:</span>
                <span class="text-gray-800"><?= htmlspecialchars($reservation['date_reservation']) ?></span>
            </div>
            
            <div class="flex items-start">
                <span class="text-sm font-medium text-gray-700 w-40">État:</span>
                <span class="px-3 py-1 text-xs font-medium rounded-full <?= $reservation['etat'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                    <?= $reservation['etat'] ? 'Confirmée' : 'Annulée' ?>
                </span>
            </div>
        </div>
    </div>

    <?php if ($reservation['etat']): ?>
        <div class="bg-white rounded-lg border border-gray-200 shadow-sm p-6 mb-6">
            <form action="/reservation/cancel/<?= $reservation['id'] ?>" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir annuler cette réservation ?')">
                <button type="submit" class="bg-red-600 text-white px-6 py-3 rounded-md hover:bg-red-700 transition-colors duration-200 font-medium w-full">
                    Annuler la réservation
                </button>
            </form>
        </div>
    <?php endif; ?>

    <div class="text-center">
        <a href="/reservation" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">← Retour à mes réservations</a>
    </div>
</div>

