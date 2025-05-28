<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Gestion des Articles de Blog</h3>

                    {{-- Bouton pour ajouter un nouvel article --}}
                    <div class="mb-4">
                        <a href="{{ route('admin.posts.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Ajouter un Article
                        </a>
                    </div>

                    {{-- Tableau pour afficher les articles --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TITRE</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PUBLIÉ LE</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($posts as $post)
                                    <tr>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $post->title }}</td>
                                        <td class="py-4 px-6 text-sm text-gray-500">{{ $post->published_at ? $post->published_at->format('d M Y') : 'Non publié' }}</td>
                                        <td class="py-4 px-6 text-sm font-medium">
                                            <a href="{{ route('admin.posts.edit', $post) }}" class="text-blue-600 hover:text-blue-900 mr-3">Modifier</a>
                                            <form action="{{ route('admin.posts.destroy', $post) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cet article?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-transparent border-0 p-0">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-4 px-6 text-sm text-gray-500 text-center">Aucun article pour le moment.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div>
                        {{ $posts->links() }}
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Gestion des Projets</h3>

                    {{-- Bouton pour ajouter un nouveau projet --}}
                    <div class="mb-4">
                        <a href="{{ route('admin.projects.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                            Ajouter un Projet
                        </a>
                    </div>

                    {{-- Tableau pour afficher les projets --}}
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">TITRE</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">PUBLIÉ LE</th>
                                    <th class="py-3 px-6 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ACTIONS</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @forelse ($projects as $project)
                                    <tr>
                                        <td class="py-4 px-6 text-sm font-medium text-gray-900">{{ $project->title }}</td>
                                        <td class="py-4 px-6 text-sm text-gray-500">{{ $project->published_at ? $project->published_at->format('d M Y') : 'Non publié' }}</td>
                                        <td class="py-4 px-6 text-sm font-medium">
                                            <a href="{{ route('admin.projects.edit', $project) }}" class="text-blue-600 hover:text-blue-900 mr-3">Modifier</a>
                                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST" class="inline" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce projet?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-transparent border-0 p-0">
                                                    Supprimer
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-4 px-6 text-sm text-gray-500 text-center">Aucun projet pour le moment.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    {{-- Pagination Links --}}
                    <div>
                        {{ $projects->links() }}
                    </div>
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Informations sur les Dons</h3>
                    {{-- Le contenu pour les informations sur les dons ira ici --}}
                    <p class="text-sm text-gray-600">Section pour les informations sur les dons à venir.</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>