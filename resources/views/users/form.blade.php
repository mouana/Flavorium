<div class="space-y-6">
    <!-- First Row - Name and Email -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="nom" class="block text-sm font-medium text-gray-700">Nom complet *</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input type="text" name="nom" id="nom" value="{{ old('nom', $user->nom ?? '') }}" required
                    class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                    placeholder="Nom et prénom">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">Email *</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input type="email" name="email" id="email" value="{{ old('email', $user->email ?? '') }}" required
                    class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                    placeholder="email@exemple.com">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                        <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                    </svg>
                </div>
            </div>
        </div>
    </div>

    @if (empty($edit))
    <!-- Second Row - Password and Confirmation -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
            <label for="mot_de_passe" class="block text-sm font-medium text-gray-700">Mot de passe *</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input type="password" name="mot_de_passe" id="mot_de_passe" required
                    class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                    placeholder="••••••••">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>

        <div>
            <label for="mot_de_passe_confirmation" class="block text-sm font-medium text-gray-700">Confirmation *</label>
            <div class="mt-1 relative rounded-md shadow-sm">
                <input type="password" name="mot_de_passe_confirmation" id="mot_de_passe_confirmation" required
                    class="focus:ring-green-500 focus:border-green-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md"
                    placeholder="••••••••">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 8a6 6 0 01-7.743 5.743L10 14l-1 1-1 1H6v2H2v-4l4.257-4.257A6 6 0 1118 8zm-6-4a1 1 0 100 2 2 2 0 012 2 1 1 0 102 0 4 4 0 00-4-4z" clip-rule="evenodd" />
                    </svg>
                </div>
            </div>
        </div>
    </div>
    @endif

    <!-- Third Row - Role (full width) -->
    <div class="grid grid-cols-1">
        <div>
            <label for="role" class="block text-sm font-medium text-gray-700">Rôle *</label>
            <div class="mt-1">
                <select name="role" id="role" required
                    class="focus:ring-blue-500 focus:border-blue-500 block w-full pl-3 pr-10 py-2 sm:text-sm border-gray-300 rounded-md">
                    <option value="">Sélectionner un rôle</option>
                    <option value="admin" {{ (old('role', $user->role ?? '') == 'admin') ? 'selected' : '' }}>Administrateur</option>
                    <option value="user" {{ (old('role', $user->role ?? '') == 'user') ? 'selected' : '' }}>Utilisateur</option>
                </select>
            </div>
        </div>
    </div>
</div>