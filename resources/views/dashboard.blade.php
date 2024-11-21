<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Grille des cartes -->
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6">
                <!-- Card pour la photo de profil -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Photo de Profil</h3>
                    <img src="{{ $bucketUrl }}/misc/profile_picture.jpg" alt="Photo de profil"
                        class="w-full h-[25rem] object-contain mb-4 mx-auto">
                    <form action="{{ route('files.uploadProfilePicture') }}" method="POST"
                        enctype="multipart/form-data" class="flex flex-col">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Changer la
                            photo</label>
                        <input type="file" name="profile_picture" accept="image/*"
                            class="block text-white w-full mt-2 p-2 border rounded-md">
                        @error('profile_picture')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="mt-4 px-4 py-2 w-full ml-auto bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all">
                            Mettre à jour
                        </button>
                    </form>
                </div>

                <!-- Card pour le CV -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 col-span-2">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">CV</h3>
                    <iframe src="{{ $bucketUrl }}/misc/cv.pdf#toolbar=0"
                        class="w-full h-[25rem] border rounded-md mb-4" title="Aperçu du CV"></iframe>
                    <form action="{{ route('files.uploadCV') }}" method="POST" enctype="multipart/form-data"
                        class="flex flex-col">
                        @csrf
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">Changer le CV</label>
                        <input type="file" name="cv" accept=".pdf"
                            class="block text-white w-full mt-2 p-2 border rounded-md">
                        @error('cv')
                            <p class="text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                        <button type="submit"
                            class="mt-4 px-4 py-2 w-full bg-red-600 text-white rounded-md hover:bg-red-700 transition-all">
                            Mettre à jour
                        </button>
                    </form>
                </div>

                <!-- Section pour les liens sociaux -->
                <!-- Section pour les liens sociaux -->
                <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6 col-span-4">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4">Liens Sociaux</h3>
                    <form action="{{ route('social-links.update') }}" method="POST" class="flex flex-col gap-6">
                        @csrf
                        @foreach ($socialLinks as $socialLink)
                            <div class="border p-4 rounded-lg">
                                <!-- Plateforme -->
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Plateforme : {{ ucfirst($socialLink->platform) }}
                                </label>
                                <input type="hidden" name="social_links[{{ $loop->index }}][platform]"
                                    value="{{ $socialLink->platform }}">

                                <!-- URL -->
                                <label class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    URL
                                </label>
                                <input type="url" name="social_links[{{ $loop->index }}][url]"
                                    value="{{ $socialLink->url }}" class="block w-full mt-2 p-2 border rounded-md"
                                    placeholder="https://example.com">
                                @error("social_links.{$loop->index}.url")
                                    <p class="text-red-600 mt-1">{{ $message }}</p>
                                @enderror

                                <!-- Description -->
                                <label class="block mt-4 text-sm font-medium text-gray-700 dark:text-gray-300">
                                    Description
                                </label>
                                <input type="text" name="social_links[{{ $loop->index }}][description]"
                                    value="{{ $socialLink->description }}"
                                    class="block w-full mt-2 p-2 border rounded-md"
                                    placeholder="Entrez une description">
                                @error("social_links.{$loop->index}.description")
                                    <p class="text-red-600 mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        @endforeach

                        <!-- Bouton pour soumettre -->
                        <button type="submit"
                            class="mt-4 px-4 py-2 w-full bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-all">
                            Mettre à jour
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<script>
    document.querySelector('input[name="profile_picture"]').addEventListener('change', function() {
        if (this.files[0].size > 10485760) {
            const errorMsg = document.createElement('p');
            errorMsg.classList.add('text-red-600', 'mt-1');
            errorMsg.textContent = 'Le fichier ne doit pas dépasser 10 Mo.';
            this.parentNode.appendChild(errorMsg);
            this.value = '';
        }
    });
</script>
