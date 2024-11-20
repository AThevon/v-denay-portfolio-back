<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Ajouter un Projet</h1>

        <!-- Formulaire d'ajout -->
        <form action="{{ route('projects.store') }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <!-- Titre -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titre</label>
                <input type="text" id="title" name="title" value="{{ old('title') }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Catégorie -->
            <div class="mb-4">
                <label for="category_id"
                    class="block text-sm font-medium text-gray-700 dark:text-gray-300">Catégorie</label>
                <select id="category_id" name="category_id"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>
                            {{ $category->title }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Image -->
            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                <input type="file" id="image" name="image"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL -->
            <div class="mb-4">
                <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lien Embed
                    YouTube</label>
                <input type="url" id="url" name="url" value="{{ old('url') }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('url')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
                <div class="flex gap-2">
                    <button type="button"
                        class="mt-2 px-2 py-1 bg-red-600 text-white font-semibold rounded-md shadow-md hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor">
                            <path
                                d="M19.615 3.184c-.424-.3-1.365-.568-2.56-.68-2.502-.24-6.266-.24-6.266-.24h-.008s-3.766 0-6.266.24c-1.196.112-2.137.38-2.56.68-.472.324-.832.85-1.051 1.425-.244.619-.367 1.653-.367 3.095v4.543c0 1.442.123 2.476.367 3.095.22.575.58 1.1 1.051 1.425.424.3 1.365.568 2.56.68 2.502.24 6.266.24 6.266.24s3.766 0 6.266-.24c1.196-.112 2.137-.38 2.56-.68.472-.324.832-.85 1.051-1.425.244-.619.367-1.653.367-3.095v-4.543c0-1.442-.123-2.476-.367-3.095-.22-.575-.58-1.1-1.051-1.425zm-10.452 8.116v-5.6l5.6 2.8-5.6 2.8z" />
                        </svg>
                        <a href="https://www.youtube.com/" target="_blank">YouTube</a>
                    </button>
                    <button type="button" id="toggle-helper"
                        class="mt-2 px-2 py-1 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Où trouver le bon lien ?
                    </button>
                    <div class="hidden h-screen w-screen fixed inset-0 bg-black bg-opacity-50 z-40 justify-center items-center gap-10"
                        id="helper-image">
                        <img src="{{ asset('images/helper-yt-link-1.png') }}" alt="Helper"
                            class="h-[60vh] object-contain rounded-md shadow-lg z-50">
                        <img src="{{ asset('images/helper-yt-link-2.png') }}" alt="Helper"
                            class="h-[60vh] object-contain rounded-md shadow-lg z-50">
                    </div>
                </div>
            </div>

            <!-- Date -->
            <div class="mb-4 relative">
                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                <input type="date" id="date" name="date" value="{{ old('date') }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Client -->
            <div class="mb-4">
                <label for="client" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Client</label>
                <input type="text" id="client" name="client" value="{{ old('client') }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('client')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Rôles -->
            <div class="mb-4">
                <label for="roles" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rôles</label>
                <select id="roles" name="roles[]" multiple
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                    @foreach ($roles as $role)
                        <option value="{{ $role->id }}" @selected(collect(old('roles'))->contains($role->id))>
                            {{ $role->name }}
                        </option>
                    @endforeach
                </select>
                <p class="text-sm text-gray-500 dark:text-gray-400">Maintenez <kbd
                        class="bg-gray-200 px-1 rounded dark:bg-gray-700">Ctrl</kbd> pour sélectionner plusieurs rôles.
                </p>
                @error('roles')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end mt-6">
                <a href="{{ route('projects.index') }}"
                    class="text-gray-600 dark:text-gray-400 hover:underline mr-4">Annuler</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

<script>
    const helperImage = document.getElementById('helper-image');
    const toggleHelper = document.getElementById('toggle-helper');

    toggleHelper.addEventListener('click', function() {
        helperImage.classList.remove('hidden');
        helperImage.classList.add('flex');
        document.body.style.overflow = 'hidden';
    });

    helperImage.addEventListener('click', function() {
        helperImage.classList.remove('flex');
        helperImage.classList.add('hidden');
        document.body.style.overflow = 'auto';
    });
</script>
