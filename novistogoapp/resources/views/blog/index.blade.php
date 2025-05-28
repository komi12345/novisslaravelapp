@extends('layouts.app')

@section('content')
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
            @forelse ($posts as $post)
                <!-- Article de blog -->
                <div class="blog-card">
                    <div class="blog-image">
                        @if($post->image)
                            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                        @else
                            <img src="{{ asset('images/default-blog.jpg') }}" alt="{{ $post->title }}">
                        @endif
                        @if($post->tag)
                            <div class="blog-category">{{ $post->tag }}</div>
                        @endif
                    </div>
                    <div class="blog-content">
                        <h3>{{ $post->title }}</h3>
                        <p class="blog-date"><i class="far fa-calendar-alt"></i> {{ $post->published_at->format('d M Y') }}</p>
                        <p>{{ Str::limit($post->content, 100) }}</p>
                        <a href="{{ route('blog.show', $post) }}" class="read-more" data-article-id="article-{{ $post->id }}">Lire plus <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            @empty
                <div class="blog-empty">
                    <p>Aucun article disponible pour le moment. Revenez bientôt!</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection