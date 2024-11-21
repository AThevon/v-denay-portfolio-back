<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200 mb-6">Gérer le CV</h1>

        <!-- Message de succès -->
        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulaire d'upload -->
        <form action="{{ route('cv.upload') }}" method="POST" enctype="multipart/form-data"
            class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            @csrf

            <div class="mb-4">
                <label for="cv" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Uploader un
                    nouveau
                    CV</label>
                <input type="file" id="cv" name="cv" accept="application/pdf"
                    class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                @error('cv')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
