@extends('layouts.app')

@section('content')
<section class="blog-single">
    <div class="container">
        <div class="blog-single-header">
            <h1>{{ $post->title }}</h1>
            <div class="blog-meta">
                <span class="blog-date"><i class="far fa-calendar-alt"></i> {{ $post->published_at->format('d M Y') }}</span>
                @if($post->tag)
                    <span class="blog-tag">{{ $post->tag }}</span>
                @endif
            </div>
        </div>

        <div class="blog-single-content">
            @if($post->image)
                <div class="blog-featured-image">
                    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                </div>
            @endif

            <div class="blog-text">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <div class="blog-navigation">
            <a href="{{ route('blog.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Retour aux articles
            </a>
        </div>
    </div>
</section>
@endsection

@section('styles')
<style>
    .blog-single {
        padding: 4rem 0;
    }
    .blog-single-header {
        margin-bottom: 2rem;
        text-align: center;
    }
    .blog-single-header h1 {
        font-size: 2.5rem;
        margin-bottom: 1rem;
        color: #333;
    }
    .blog-meta {
        display: flex;
        justify-content: center;
        gap: 1rem;
        color: #666;
        margin-bottom: 1rem;
    }
    .blog-tag {
        background-color: #28A745;
        color: white;
        padding: 0.25rem 0.75rem;
        border-radius: 4px;
        font-size: 0.8rem;
    }
    .blog-featured-image {
        margin-bottom: 2rem;
        border-radius: 8px;
        overflow: hidden;
    }
    .blog-featured-image img {
        width: 100%;
        height: auto;
        display: block;
    }
    .blog-text {
        line-height: 1.8;
        color: #333;
        font-size: 1.1rem;
    }
    .blog-navigation {
        margin-top: 3rem;
        display: flex;
        justify-content: center;
    }
</style>
@endsection