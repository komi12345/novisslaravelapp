<section id="blog" class="blog">
    <div class="container">
        <div class="section-header">
            <h2>Notre Blog</h2>
            <div class="separator"></div>
        </div>
        <div class="blog-intro">
            <p>Découvrez nos dernières actualités, histoires inspirantes et informations sur nos projets en cours.</p>
        </div>
        <div class="blog-grid">
            @forelse ($posts->take(3) as $post)
                <div class="blog-card">
                    <div class="blog-image">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="{{ asset('images/default-blog.jpg') }}" alt="{{ $post->title }}">
                        @endif
                        @if($post->tag)
                            <div class="blog-category">{{ $post->tag }}</div>
                        @else
                            <div class="blog-category">Non catégorisé</div>
                        @endif
                    </div>
                    <div class="blog-content">
                        <h3>{{ $post->title }}</h3>
                        <p class="blog-date"><i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d M Y') }}</p>
                        <p>
                            @if(isset($post->summary) && !empty($post->summary))
                                {{ $post->summary }}
                            @else
                                {{ Str::limit(strip_tags($post->content), 100) }}
                            @endif
                        </p>
                        {{-- Lien pour ouvrir le modal avec l'article complet --}}
                        <a href="#" class="read-more" data-article-id="article-{{ $post->id }}">Lire plus <i class="fas fa-arrow-right"></i></a>
                    </div>
                    {{-- Contenu caché pour le modal --}}
                    <div id="article-{{ $post->id }}-content" style="display: none;">
                        <h2>{{ $post->title }}</h2>
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @endif
                        <p class="blog-date"><i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d M Y') }}</p>
                        {!! nl2br(e($post->content)) !!}
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>Aucun article de blog trouvé.</p>
                </div>
            @endforelse
        </div>

        {{-- Bouton Voir plus/moins centré sous les articles --}}
        <div class="blog-more">
            <button id="toggle-blog-btn" class="btn-toggle-blog">Voir plus</button>
        </div>
        
        {{-- Articles cachés (moins récents) --}}
        <div id="hidden-blog-posts" class="blog-grid" style="display: none;">
            @if(count($posts) > 3)
                @foreach($posts->slice(3) as $post)
                    <div class="blog-card">
                        <div class="blog-image">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            @else
                                <img src="{{ asset('images/default-blog.jpg') }}" alt="{{ $post->title }}">
                            @endif
                            @if($post->tag)
                                <div class="blog-category">{{ $post->tag }}</div>
                            @else
                                <div class="blog-category">Non catégorisé</div>
                            @endif
                        </div>
                        <div class="blog-content">
                            <h3>{{ $post->title }}</h3>
                            <p class="blog-date"><i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d M Y') }}</p>
                            <p>
                                @if(isset($post->summary) && !empty($post->summary))
                                    {{ $post->summary }}
                                @else
                                    {{ Str::limit(strip_tags($post->content), 100) }}
                                @endif
                            </p>
                            {{-- Lien pour ouvrir le modal avec l'article complet --}}
                            <a href="#" class="read-more" data-article-id="article-{{ $post->id }}">Lire plus <i class="fas fa-arrow-right"></i></a>
                        </div>
                        {{-- Contenu caché pour le modal --}}
                        <div id="article-{{ $post->id }}-content" style="display: none;">
                            <h2>{{ $post->title }}</h2>
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            @endif
                            <p class="blog-date"><i class="far fa-calendar-alt"></i> {{ $post->created_at->format('d M Y') }}</p>
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                @endforeach
            @endif
        </div>

        {{-- Structure modale pour afficher les articles complets --}}
        <div id="blog-modal" class="blog-modal">
            <div class="blog-modal-content">
                <button class="blog-modal-close-icon">&times;</button>
                <div class="blog-modal-body"><!-- Le contenu sera injecté ici par JavaScript --></div>
                <div class="blog-modal-footer">
                    <button class="btn btn-secondary blog-modal-back-btn">Retour</button>
                </div>
            </div>
        </div>

        {{-- Le bouton "Voir plus" peut être utilisé pour la pagination si nécessaire --}}
        {{-- Exemple de lien de pagination Laravel --}}
        {{-- <div class="blog-more">
            {{ $posts->links() }} 
        </div> --}}
    </div>
</section>