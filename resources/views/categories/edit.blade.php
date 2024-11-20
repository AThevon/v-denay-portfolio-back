<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Modifier la Catégorie</h1>

        <form action="{{ route('categories.update', $category) }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom de la
                    Catégorie</label>
                <input type="text" id="title" name="title" value="{{ old('title', $category->title) }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('title')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Image</label>
                <input type="file" id="image" name="image"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('image')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
                @if ($category->image)
                    <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">Image actuelle :</p>
                    <img src="{{ $category->image }}" alt="{{ $category->title }}" class="h-20 mt-2">
                @endif
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('categories.index') }}"
                    class="text-gray-600 dark:text-gray-400 hover:underline mr-4">Annuler</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
