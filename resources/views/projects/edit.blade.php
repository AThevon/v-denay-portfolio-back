<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Modifier le Projet</h1>

        <!-- Formulaire d'édition -->
        <form action="{{ route('projects.update', $project) }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <!-- Titre -->
            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Titre</label>
                <input type="text" id="title" name="title" value="{{ old('title', $project->title) }}"
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
                        <option value="{{ $category->id }}" @selected(old('category_id', $project->category_id) == $category->id)>
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
                <div class="flex items-center space-x-4">
                    @if ($project->image)
                        <img src="{{ $project->image }}" alt="Image actuelle"
                            class="w-24 h-24 object-cover rounded-md shadow-md">
                    @endif
                    <input type="file" id="image" name="image"
                        class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                </div>
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URL -->
            <div class="mb-4">
                <label for="url" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Lien
                    YouTube</label>
                <input type="url" id="url" name="url" value="{{ old('url', $project->url) }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('url')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Date -->
            <div class="mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Date</label>
                <input type="date" id="date" name="date"
                    value="{{ old('date', $project->date ? $project->date->format('Y-m-d') : '') }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('date')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Client -->
            <div class="mb-4">
                <label for="client" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Client</label>
                <input type="text" id="client" name="client" value="{{ old('client', $project->client) }}"
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
                        <option value="{{ $role->id }}" @selected($project->roles->pluck('id')->contains($role->id))>
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
