<div class="max-w-md mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Inscription</h1>

    <?php if (isset($error)): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mb-6">
            <p><?= htmlspecialchars($error) ?></p>
        </div>
    <?php endif; ?>

    <form action="/user/register" method="POST" class="bg-white rounded-lg border border-gray-200 shadow-sm p-8">
        <div class="space-y-6">
            <div>
                <label for="prenom" class="block text-sm font-medium text-gray-700 mb-2">Prénom</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
            
            <div>
                <label for="nom" class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
            
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" id="email" name="email" placeholder="votre@email.com" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
            
            <div>
                <label for="motdepasse" class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                <input type="password" id="motdepasse" name="motdepasse" placeholder="Votre mot de passe" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>

            <div>
                <label for="role" class="block text-sm font-medium text-gray-700 mb-2">Rôle</label>
                <select id="role" name="role" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all bg-white">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
        </div>
        
        <button type="submit" class="w-full mt-8 bg-gray-800 text-white px-6 py-3 rounded-md hover:bg-gray-900 transition-colors duration-200 font-medium">
            S'inscrire
        </button>
    </form>

    <p class="text-center mt-6 text-gray-600">
        Déjà un compte ? 
        <a href="/user/login" class="text-gray-800 hover:text-gray-600 font-medium transition-colors duration-200">Connectez-vous</a>
    </p>
</div>
