<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="flex items-center justify-between mb-6">
            <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">Liste des Projets</h1>
            <a href="{{ route('projects.create') }}"
                class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-md shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Ajouter un Projet
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($projects as $project)
                <div
                    class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden flex flex-col justify-between">
                    <div class="">

                        <!-- Image du projet -->
                        @if ($project->image)
                            <img src="{{ $project->image }}" alt="{{ $project->title }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-gray-300 dark:bg-gray-700 flex items-center justify-center">
                                <span class="text-gray-600 dark:text-gray-400">Pas d'image</span>
                            </div>
                        @endif

                        <!-- Contenu -->
                        <div class="p-4">
                            <h3 class="text-lg font-bold text-gray-900 dark:text-gray-100">{{ $project->title }}</h3>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-2">
                                <strong>Catégorie :</strong> {{ $project->category->title }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <strong>Rôles :</strong>
                                {{ $project->roles->isNotEmpty() ? $project->roles->pluck('name')->join(', ') : 'Aucun rôle' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <strong>Client :</strong> {{ $project->client ?? 'Non spécifié' }}
                            </p>
                            <p class="text-sm text-gray-600 dark:text-gray-400 mt-1">
                                <strong>Date :</strong>
                                {{ $project->date ? $project->date->format('d/m/Y') : 'Non spécifiée' }}
                            </p>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="flex items-center justify-between px-4 py-3 bg-gray-100 dark:bg-gray-900">
                        <a href="{{ route('projects.edit', $project) }}"
                            class="text-sm text-blue-600 dark:text-blue-400 hover:underline">
                            Modifier
                        </a>
                        <form action="{{ route('projects.feature', $project) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-sm font-semibold px-3 py-1 rounded-lg text-white {{ $project->featured ? 'bg-green-600 hover:bg-green-700' : 'bg-gray-600 hover:bg-gray-700' }}">
                                {{ $project->featured ? 'Mis en avant' : 'Mettre en avant' }}
                            </button>
                        </form>
                        <form action="{{ route('projects.destroy', $project) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-red-600 dark:text-red-400 hover:underline">
                                Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $projects->links('pagination::tailwind') }}
        </div>
    </div>
</x-app-layout>
