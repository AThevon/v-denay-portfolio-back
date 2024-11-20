<x-app-layout>
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Liste des Catégories</h1>
            {{-- <a href="{{ route('categories.create') }}"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Ajouter une Catégorie
            </a> --}}
        </div>

        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700">
                <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase">
                            Nom
                        </th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase">
                            Image
                        </th>
                        <th class="px-6 py-3 text-right text-sm font-medium text-gray-500 dark:text-gray-300">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($categories as $category)
                        <tr>
                            <td
                                class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900 dark:text-gray-100">
                                {{ $category->title }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900 dark:text-gray-100">
                                @if ($category->image)
                                    <img src="{{ $category->image }}" alt="{{ $category->title }}"
                                        class="h-48 object-contain">
                                @else
                                    <span>Pas d'image</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                <a href="{{ route('categories.edit', $category) }}"
                                    class="text-blue-600 dark:text-blue-400 hover:underline">Modifier</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
