<section id="projets" class="projects">
    <div class="container">
        <div class="section-header">
            <h2>Nos projets</h2>
            <div class="separator"></div>
        </div>
        <div class="projects-intro">
            <p>Découvrez nos projets en cours et nos réalisations pour aider les enfants des rues au Togo.</p>
        </div>
        
        <div class="projects-grid">
            @forelse ($projects->take(3) as $project)
                <div class="project-card">
                    <div class="project-image">
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                        @else
                            <img src="{{ asset('images/project1.jpg') }}" alt="{{ $project->title }}">
                        @endif
                        @if($project->tag)
                            <div class="project-category">{{ $project->tag }}</div>
                        @endif
                    </div>
                    <div class="project-content">
                        <h3>{{ $project->title }}</h3>
                        <p>
                            @if(isset($project->summary) && !empty($project->summary))
                                {{ $project->summary }}
                            @else
                                {{ Str::limit(strip_tags($project->content), 100) }}
                            @endif
                        </p>
                        {{-- Lien pour ouvrir le modal avec le projet complet --}}
                        <a href="#" class="project-read-more" data-project-id="project-{{ $project->id }}">En savoir plus</a>
                    </div>
                    {{-- Contenu caché pour le modal --}}
                    <div id="project-{{ $project->id }}-content" style="display: none;">
                        <h2>{{ $project->title }}</h2>
                        @if($project->image)
                            <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                        @endif
                        <p class="project-date"><i class="far fa-calendar-alt"></i> {{ $project->created_at->format('d M Y') }}</p>
                        {!! nl2br(e($project->content)) !!}
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>Aucun projet trouvé.</p>
                </div>
            @endforelse
        </div>

        {{-- Bouton Voir plus/moins centré sous les projets --}}
        <div class="project-more">
            <button id="toggle-project-btn" class="btn-toggle-project">Voir plus</button>
        </div>
        
        {{-- Projets cachés (moins récents) --}}
        @if(count($projects) > 3)
            <div id="hidden-project-items" class="projects-grid" style="display: none;">
                @foreach($projects->slice(3) as $project)
                    <div class="project-card">
                        <div class="project-image">
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                            @else
                                <img src="{{ asset('images/project1.jpg') }}" alt="{{ $project->title }}">
                            @endif
                            @if($project->tag)
                                <div class="project-category">{{ $project->tag }}</div>
                            @endif
                        </div>
                        <div class="project-content">
                            <h3>{{ $project->title }}</h3>
                            <p>
                                @if(isset($project->summary) && !empty($project->summary))
                                    {{ $project->summary }}
                                @else
                                    {{ Str::limit(strip_tags($project->content), 100) }}
                                @endif
                            </p>
                            {{-- Lien pour ouvrir le modal avec le projet complet --}}
                            <a href="#" class="project-read-more" data-project-id="project-{{ $project->id }}">En savoir plus</a>
                        </div>
                        {{-- Contenu caché pour le modal --}}
                        <div id="project-{{ $project->id }}-content" style="display: none;">
                            <h2>{{ $project->title }}</h2>
                            @if($project->image)
                                <img src="{{ asset('storage/' . $project->image) }}" alt="{{ $project->title }}">
                            @endif
                            <p class="project-date"><i class="far fa-calendar-alt"></i> {{ $project->created_at->format('d M Y') }}</p>
                            {!! nl2br(e($project->content)) !!}
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            {{-- Créer un div caché vide pour éviter les erreurs JavaScript --}}
            <div id="hidden-project-items" class="projects-grid" style="display: none;"></div>
        @endif
    </div>
    
    {{-- Modal pour afficher le contenu complet du projet --}}
    <div id="project-modal" class="project-modal">
        <div class="project-modal-container">
            <div class="project-modal-header">
                <div></div>
                <div class="project-modal-close-icon">&times;</div>
            </div>
            <div class="project-modal-body">
                {{-- Le contenu sera injecté ici via JavaScript --}}
            </div>
            <div class="project-modal-footer">
                <button class="project-modal-back-btn">Retour</button>
            </div>
        </div>
    </div>
</section>