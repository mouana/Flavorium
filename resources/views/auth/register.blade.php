<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex items-center justify-center h-screen bg-gray-100">

    <div class="w-full max-w-md bg-white p-6 rounded-lg shadow-md">
        <h2 class="text-2xl font-bold mb-6 text-center">Inscription</h2>

        <form method="POST" action="{{ route('register.store') }}">
            @csrf

            <div class="mb-4">
                <label for="nom" class="block text-gray-700">Nom</label>
                <input id="nom" name="nom" type="text" value="{{ old('nom') }}" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                @error('nom')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-gray-700">Email</label>
                <input id="email" name="email" type="email" value="{{ old('email') }}" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                @error('email')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="mot_de_passe" class="block text-gray-700">Mot de passe</label>
                <input id="mot_de_passe" name="mot_de_passe" type="password" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
                @error('mot_de_passe')
                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="mot_de_passe_confirmation" class="block text-gray-700">Confirmer mot de passe</label>
                <input id="mot_de_passe_confirmation" name="mot_de_passe_confirmation" type="password" required
                       class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring focus:border-blue-300">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 text-white py-2 rounded-md hover:bg-green-700 transition">
                S’inscrire
            </button>
        </form>
    </div>

</body>
</html>
