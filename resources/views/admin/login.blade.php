<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion Admin - Ste Azzahhafi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-br from-blue-900 to-blue-600 min-h-screen flex items-center justify-center">

    <div class="bg-white shadow-xl rounded-xl w-full max-w-md p-8 space-y-6">
        <h2 class="text-3xl font-bold text-center text-blue-900">Connexion Admin</h2>

        <form method="POST" action="{{ route('admin.auth') }}" class="space-y-5">
            @csrf

            <!-- Email -->
            <div>
                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                <input type="email" name="email" id="email" placeholder="admin@example.com"
                    class="mt-1 w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('email')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="••••••••"
                    class="mt-1 w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('password')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Access Code -->
            <div>
                <label for="access_code" class="block text-sm font-medium text-gray-700">Code URL personnalisé</label>
                <input type="text" name="access_code" id="access_code" placeholder="azahhafi2024"
                    class="mt-1 w-full border border-gray-300 rounded-md shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('access_code')
                    <div class="text-red-600 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit"
                    class="w-full bg-blue-700 hover:bg-blue-800 text-white font-bold py-2 px-4 rounded-md transition duration-300">
                    Se connecter
                </button>
            </div>
        </form>
    </div>

</body>
</html>
