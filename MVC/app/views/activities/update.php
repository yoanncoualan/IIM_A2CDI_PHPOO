<div class="max-w-2xl mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8">Modifier une activité</h1>

    <form action="/activity/update/<?= $activity['id'] ?>" method="POST" class="bg-white rounded-lg border border-gray-200 shadow-sm p-8">
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" name="nom" value="<?= htmlspecialchars($activity['nom']) ?>" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <select name="type_id" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all bg-white">
                    <?php foreach ($types as $type): ?>
                        <option value="<?= $type['id'] ?>" <?= $type['id'] == $activity['type_id'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['nom']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Places disponibles</label>
                <input type="number" name="places_disponibles" value="<?= htmlspecialchars($activity['places_disponibles']) ?>" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all resize-none"><?= htmlspecialchars($activity['description']) ?></textarea>
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Date et heure de début</label>
                <input type="datetime-local" name="datetime_debut" value="<?= date('Y-m-d\TH:i', strtotime($activity['datetime_debut'])) ?>" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Durée (minutes)</label>
                <input type="number" name="duree" value="<?= htmlspecialchars($activity['duree']) ?>" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
        </div>
        
        <div class="mt-8 flex items-center justify-between">
            <button type="submit" class="bg-gray-800 text-white px-6 py-2.5 rounded-md hover:bg-gray-900 transition-colors duration-200 font-medium">
                Modifier
            </button>
            <a href="/activity/show/<?= $activity['id'] ?>" class="text-gray-600 hover:text-gray-900 transition-colors duration-200">Retour</a>
        </div>
    </form>
</div>

