<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'article') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('admin.posts.update', $post) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') {{-- Ou PATCH --}}

                        <!-- Title -->
                        <div>
                            <label for="title" class="block font-medium text-sm text-gray-700">{{ __('Titre') }}</label>
                            <p class="text-xs text-gray-500 mb-1">Créez un titre concis et engageant (en gras, centré, texte gris foncé/noir)</p>
                            <input id="title" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="title" value="{{ old('title', $post->title) }}" required autofocus />
                        </div>

                        <!-- Summary -->
                        <div class="mt-4">
                            <label for="summary" class="block font-medium text-sm text-gray-700">{{ __('Résumé') }}</label>
                            <p class="text-xs text-gray-500 mb-1">Rédigez un résumé court et captivant (2-3 phrases) qui incite les lecteurs à cliquer sur "Lire plus"</p>
                            <textarea id="summary" name="summary" rows="2" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('summary', $post->summary) }}</textarea>
                        </div>

                        <!-- Content -->
                        <div class="mt-4">
                            <label for="content" class="block font-medium text-sm text-gray-700">{{ __('Contenu complet de l\'article') }}</label>
                            <p class="text-xs text-gray-500 mb-1">Générez un contenu détaillé pour l'article complet, en cohérence avec le résumé et le titre</p>
                            <textarea id="content" name="content" rows="10" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" required>{{ old('content', $post->content) }}</textarea>
                        </div>

                        <!-- Tag Selection -->
                        <div class="mt-4">
                            <label for="tag_select" class="block font-medium text-sm text-gray-700">{{ __('Étiquette') }}</label>
                            <p class="text-xs text-gray-500 mb-1">L'étiquette apparaîtra dans un rectangle vert (#28A745) en haut à gauche de la carte</p>
                            @php
                                $currentTag = old('tag_select', $post->tag);
                                $isCustom = !in_array($currentTag, ['ACTUALITÉS', 'PROJETS', 'TÉMOIGNAGES', 'ENVIRONNEMENT', '']) && !is_null($currentTag);
                            @endphp
                            <select id="tag_select" name="tag_select" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">-- Choisir une étiquette --</option>
                                <option value="ACTUALITÉS" {{ $currentTag == 'ACTUALITÉS' ? 'selected' : '' }}>ACTUALITÉS</option>
                                <option value="PROJETS" {{ $currentTag == 'PROJETS' ? 'selected' : '' }}>PROJETS</option>
                                <option value="TÉMOIGNAGES" {{ $currentTag == 'TÉMOIGNAGES' ? 'selected' : '' }}>TÉMOIGNAGES</option>
                                <option value="ENVIRONNEMENT" {{ $currentTag == 'ENVIRONNEMENT' ? 'selected' : '' }}>ENVIRONNEMENT</option>
                                <option value="Autre" {{ $isCustom || $currentTag == 'Autre' ? 'selected' : '' }}>Autre (Préciser ci-dessous)</option>
                            </select>
                        </div>

                        <!-- Custom Tag Input (Initially Hidden) -->
                        <div class="mt-4" id="custom_tag_div" style="display: {{ $isCustom || old('tag_select', $post->tag) == 'Autre' ? 'block' : 'none' }};">
                            <label for="tag_custom" class="block font-medium text-sm text-gray-700">{{ __('Étiquette personnalisée') }}</label>
                            <input id="tag_custom" class="block mt-1 w-full rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" type="text" name="tag_custom" value="{{ old('tag_custom', $isCustom ? $post->tag : '') }}" />
                        </div>

                        <!-- Image -->
                        <div class="mt-4">
                            <label for="image" class="block font-medium text-sm text-gray-700">{{ __('Image') }}</label>
                            <p class="text-xs text-gray-500 mb-1">Choisissez une image horizontale qui représente visuellement le sujet de l'article. L'image sera placée en haut de la carte et occupera 60-70% de sa hauteur.</p>
                            <input id="image" class="block mt-1 w-full" type="file" name="image" accept="image/*" />
                            <p class="text-xs text-gray-500 mt-1">Format recommandé: 16:9 ou 4:3, résolution minimale 800x450px</p>
                            @if ($post->image)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="h-20 w-auto border rounded">
                                    <p class="text-xs text-gray-500 mt-1">Image actuelle</p>
                                </div>
                            @endif
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('admin.dashboard') }}" class="underline text-sm text-gray-600 hover:text-gray-900 mr-4">
                                {{ __('Annuler') }}
                            </a>

                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                {{ __('Publier') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tagSelect = document.getElementById('tag_select');
            const customTagDiv = document.getElementById('custom_tag_div');
            const customTagInput = document.getElementById('tag_custom');

            function toggleCustomTag() {
                if (tagSelect.value === 'Autre') {
                    customTagDiv.style.display = 'block';
                } else {
                    customTagDiv.style.display = 'none';
                    // Ne pas effacer si la valeur actuelle est déjà une étiquette personnalisée chargée
                    if (!{{ $isCustom ? 'true' : 'false' }} || tagSelect.value !== 'Autre') {
                       // customTagInput.value = ''; // On ne vide pas forcément ici pour garder la valeur si on re-sélectionne 'Autre'
                    }
                }
            }

            tagSelect.addEventListener('change', toggleCustomTag);

            // Initial check
            toggleCustomTag();
        });
    </script>
</x-app-layout>