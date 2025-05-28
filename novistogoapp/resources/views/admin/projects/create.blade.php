<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ajouter un Projet') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('admin.projects.store') }}" enctype="multipart/form-data">
                        @csrf

                        <!-- Titre -->
                        <div class="mb-4">
                            <label for="title" class="block text-sm font-medium text-gray-700">Titre</label>
                            <input type="text" name="title" id="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('title') }}" required>
                            @error('title')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="mb-4">
                            <label for="image" class="block text-sm font-medium text-gray-700">Image</label>
                            <input type="file" name="image" id="image" class="mt-1 block w-full">
                            <p class="text-xs text-gray-500 mt-1">Format recommandé: JPG, PNG. Max 2MB.</p>
                            @error('image')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catégorie / Tag -->
                        <div class="mb-4">
                            <label for="tag_select" class="block text-sm font-medium text-gray-700">Catégorie</label>
                            <select name="tag_select" id="tag_select" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                <option value="">Sélectionner une catégorie</option>
                                <option value="Éducation" {{ old('tag_select') == 'Éducation' ? 'selected' : '' }}>Éducation</option>
                                <option value="Santé" {{ old('tag_select') == 'Santé' ? 'selected' : '' }}>Santé</option>
                                <option value="Infrastructure" {{ old('tag_select') == 'Infrastructure' ? 'selected' : '' }}>Infrastructure</option>
                                <option value="Formation" {{ old('tag_select') == 'Formation' ? 'selected' : '' }}>Formation</option>
                                <option value="Autre" {{ old('tag_select') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('tag_select')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catégorie personnalisée -->
                        <div class="mb-4" id="custom_tag_div" style="display: none;">
                            <label for="tag_custom" class="block text-sm font-medium text-gray-700">Catégorie personnalisée</label>
                            <input type="text" name="tag_custom" id="tag_custom" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="{{ old('tag_custom') }}">
                            @error('tag_custom')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Résumé -->
                        <div class="mb-4">
                            <label for="summary" class="block text-sm font-medium text-gray-700">Résumé (optionnel)</label>
                            <textarea name="summary" id="summary" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('summary') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Un court résumé qui sera affiché dans la liste des projets. Si laissé vide, il sera généré automatiquement.</p>
                            @error('summary')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Contenu -->
                        <div class="mb-4">
                            <label for="content" class="block text-sm font-medium text-gray-700">Contenu</label>
                            <textarea name="content" id="content" rows="10" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('content') }}</textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Publication -->
                        <div class="mb-4">
                            <div class="flex items-center">
                                <input type="checkbox" name="publish" id="publish" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" value="1" {{ old('publish') ? 'checked' : '' }}>
                                <label for="publish" class="ml-2 block text-sm text-gray-700">Publier immédiatement</label>
                            </div>
                            <p class="text-xs text-gray-500 mt-1">Si non coché, le projet sera enregistré comme brouillon.</p>
                        </div>

                        <!-- Boutons -->
                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150 mr-3">Annuler</a>
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">Enregistrer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Afficher/masquer le champ de catégorie personnalisée
        document.addEventListener('DOMContentLoaded', function() {
            const tagSelect = document.getElementById('tag_select');
            const customTagDiv = document.getElementById('custom_tag_div');
            
            // Fonction pour afficher/masquer le champ personnalisé
            function toggleCustomTag() {
                if (tagSelect.value === 'Autre') {
                    customTagDiv.style.display = 'block';
                } else {
                    customTagDiv.style.display = 'none';
                }
            }
            
            // Vérifier l'état initial
            toggleCustomTag();
            
            // Ajouter l'écouteur d'événement
            tagSelect.addEventListener('change', toggleCustomTag);
        });
    </script>
</x-app-layout>