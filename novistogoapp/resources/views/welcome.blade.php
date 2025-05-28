<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novis Togo - Aide aux enfants des rues</title>
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/base.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('css/navigation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/hero.css') }}">
    <link rel="stylesheet" href="{{ asset('css/impact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    <link rel="stylesheet" href="{{ asset('css/missions.css') }}">
    <link rel="stylesheet" href="{{ asset('css/projects.css') }}">
    <link rel="stylesheet" href="{{ asset('css/testimonials.css') }}">
    <link rel="stylesheet" href="{{ asset('css/donation.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    <link rel="stylesheet" href="{{ asset('css/blog.css') }}">
    <link rel="stylesheet" href="{{ asset('css/project-modal.css') }}">
    <link rel="stylesheet" href="{{ asset('css/alerts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
</head>
<body>

    @include('partials.header')

    @include('partials.hero')

    @include('partials.impact')

    @include('partials.about')

    @include('partials.missions')

    @include('partials.projects')

    @include('partials.testimonials')

    @include('partials.donation')

    @include('partials.contact')

    @include('partials.blog')

    @include('partials.footer')

    <script src="{{ asset('js/navigation.js') }}"></script>
    <script src="{{ asset('js/testimonials.js') }}"></script>
    <script src="{{ asset('js/blog.js') }}"></script>
    <script src="{{ asset('js/projects.js') }}"></script>
    <script src="{{ asset('js/contact.js') }}"></script>
    <script src="{{ asset('js/animations.js') }}"></script>
    <script src="{{ asset('js/forms.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>
