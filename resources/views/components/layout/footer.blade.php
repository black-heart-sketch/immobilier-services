<footer class="bg-gray-900 text-white pt-16 pb-8">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- À Propos -->
            <div>
                <h3 class="text-xl font-semibold mb-4">À Propos</h3>
                <p class="text-gray-400 mb-4">
                    Votre partenaire de confiance pour tous vos projets immobiliers, 
                    de construction et d'aménagement.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-facebook text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-instagram text-xl"></i>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                </div>
            </div>

            <!-- Services -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Nos Services</h3>
                <ul class="space-y-2">
                    <li><a href="/terrains" class="text-gray-400 hover:text-white">Vente de Terrains</a></li>
                    <li><a href="/topographie" class="text-gray-400 hover:text-white">Topographie</a></li>
                    <li><a href="/btp" class="text-gray-400 hover:text-white">BTP</a></li>
                    <li><a href="/decoration" class="text-gray-400 hover:text-white">Décoration Intérieure</a></li>
                    <li><a href="/location-engins" class="text-gray-400 hover:text-white">Location d'Engins</a></li>
                    <li><a href="/pepinieres" class="text-gray-400 hover:text-white">Pépinières</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Contact</h3>
                <ul class="space-y-2 text-gray-400">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1.5 mr-3"></i>
                        <span>123 Rue Example, Ville, Pays</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3"></i>
                        <span>+123 456 789</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3"></i>
                        <span>contact@example.com</span>
                    </li>
                </ul>
            </div>

            <!-- Newsletter -->
            <div>
                <h3 class="text-xl font-semibold mb-4">Newsletter</h3>
                <p class="text-gray-400 mb-4">
                    Inscrivez-vous pour recevoir nos dernières actualités et offres.
                </p>
                <form class="space-y-2">
                    <div>
                        <input type="email" 
                               placeholder="Votre email" 
                               class="w-full px-4 py-2 rounded-lg bg-gray-800 border border-gray-700 focus:outline-none focus:border-primary-500">
                    </div>
                    <button type="submit" 
                            class="w-full bg-primary-600 text-white px-4 py-2 rounded-lg hover:bg-primary-700 transition">
                        S'inscrire
                    </button>
                </form>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
            <p>&copy; {{ date('Y') }} Votre Entreprise. Tous droits réservés.</p>
        </div>
    </div>
</footer> 