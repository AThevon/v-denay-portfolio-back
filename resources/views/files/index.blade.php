<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Gestion des Fichiers</h1>

        <!-- Upload du CV -->
        <form action="{{ route('files.uploadCV') }}" method="POST" enctype="multipart/form-data" class="mb-6">
            @csrf
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mettre à jour le CV</label>
            <input type="file" name="cv" accept=".pdf" class="block w-full mt-2 p-2 border rounded-md">
            @error('cv')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="mt-4 px-4 py-2 bg-blue-600 text-white rounded-md">Mettre à jour le CV</button>
        </form>

        <!-- Upload de la photo de profil -->
        <form action="{{ route('files.uploadProfilePicture') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Mettre à jour la photo de
                profil</label>
            <input type="file" name="profile_picture" accept="image/*"
                class="block w-full mt-2 p-2 border rounded-md">
            @error('profile_picture')
                <p class="text-red-600 mt-1">{{ $message }}</p>
            @enderror
            <button type="submit" class="mt-4 px-4 py-2 bg-green-600 text-white rounded-md">Mettre à jour la
                photo</button>
        </form>
    </div>
</x-app-layout>
