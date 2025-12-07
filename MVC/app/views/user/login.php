<div class="max-w-md mx-auto">
    <h1 class="text-3xl font-semibold text-gray-800 mb-8 text-center">Connexion</h1>

    <?php if (isset($error)): ?>
        <div class="bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-md mb-6">
            <p><?= htmlspecialchars($error) ?></p>
        </div>
    <?php endif; ?>

    <form action="/user/login" method="POST" class="bg-white rounded-lg border border-gray-200 shadow-sm p-8">
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                <input type="email" name="email" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Mot de passe</label>
                <input type="password" name="password" required 
                    class="w-full px-4 py-2.5 border border-gray-300 rounded-md focus:ring-2 focus:ring-gray-800 focus:border-transparent outline-none transition-all">
            </div>
        </div>
        
        <button type="submit" class="w-full mt-8 bg-gray-800 text-white px-6 py-3 rounded-md hover:bg-gray-900 transition-colors duration-200 font-medium">
            Se connecter
        </button>
    </form>

    <p class="text-center mt-6 text-gray-600">
        Pas encore de compte ? 
        <a href="/user/register" class="text-gray-800 hover:text-gray-600 font-medium transition-colors duration-200">S'inscrire</a>
    </p>
</div>