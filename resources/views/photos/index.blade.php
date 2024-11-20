<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Gestion des Photos</h1>

        <!-- Affichage des messages -->
        @if (session('success'))
            <div class="mb-4 p-4 rounded-md bg-green-100 border border-green-200 text-green-800">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="mb-4 p-4 rounded-md bg-red-100 border border-red-200 text-red-800">
                {{ session('error') }}
            </div>
        @endif

        <form action="{{ route('photos.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="photo" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Choisir une
                    photo</label>
                <input type="file" id="photo" name="photo"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('photo')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="theme" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Thème</label>
                <select id="theme" name="theme"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    <option value="illusions-perdues">Illusions Perdues</option>
                    <option value="photos-color">Photos Color</option>
                    <option value="portraits">Portraits</option>
                </select>
                @error('theme')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Upload
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
