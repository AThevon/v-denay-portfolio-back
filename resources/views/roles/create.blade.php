<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Ajouter un Rôle</h1>

        <form action="{{ route('roles.store') }}" method="POST"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Nom du
                    Rôle</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <a href="{{ route('roles.index') }}"
                    class="text-gray-600 dark:text-gray-400 hover:underline mr-4">Annuler</a>
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Enregistrer
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
