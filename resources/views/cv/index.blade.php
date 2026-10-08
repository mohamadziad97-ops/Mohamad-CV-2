<!DOCTYPE html>
<html lang="en" data-theme="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $cv['name'] }} — {{ $cv['title'] }}</title>
    <meta name="description" content="{{ $cv['name'] }}, {{ $cv['title'] }} based in {{ $cv['contact']['location'] }}. {{ $cv['tagline'] }}">
    <meta property="og:title" content="{{ $cv['name'] }} — {{ $cv['title'] }}">
    <meta property="og:description" content="{{ $cv['tagline'] }}">
    <meta property="og:image" content="{{ asset($cv['photo']) }}">
    <link rel="icon" href="data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 64 64'%3E%3Crect width='64' height='64' rx='16' fill='%230f2a2a'/%3E%3Ctext x='32' y='42' font-family='Georgia,serif' font-size='28' text-anchor='middle' fill='%2349d6b0'%3EMG%3C/text%3E%3C/svg%3E">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fraunces:opsz,wght@9..144,400;9..144,600;9..144,700&family=Manrope:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/cv.css') }}">
    <script>
        (function () {
            try {
                var t = localStorage.getItem('cv-theme');
                if (!t) t = window.matchMedia('(prefers-color-scheme: light)').matches ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', t);
            } catch (e) {}
        })();
    </script>
</head>
<body>
    <div class="bg-orbs" aria-hidden="true"><span></span><span></span><span></span></div>

    @include('partials.nav')

    <main>
        @include('partials.hero')
        @include('partials.about')
        @include('partials.experience')
        @include('partials.skills')
        @include('partials.education')
        @include('partials.contact')
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <a href="#top" class="brand"><span class="brand-mark">MG</span> {{ $cv['name'] }}</a>
            <p>&copy; {{ date('Y') }} {{ $cv['name'] }} · Built with Laravel</p>
            <a href="#top" class="to-top" aria-label="Back to top">↑</a>
        </div>
    </footer>

    @include('partials.linkedin')

    <a href="https://wa.me/{{ $cv['whatsapp']['number'] }}?text={{ rawurlencode($cv['whatsapp']['message']) }}" class="wa-float" target="_blank" rel="noopener" aria-label="Chat on WhatsApp">
        <svg viewBox="0 0 24 24" width="28" height="28" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.25-.46-2.38-1.47-.88-.79-1.47-1.76-1.64-2.05-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.6-.92-2.2-.24-.58-.49-.5-.67-.5h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.88 1.21 3.08.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.22 1.36.19 1.87.12.57-.09 1.75-.72 2-1.41.25-.69.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35zM12.05 21.5h-.01a9.43 9.43 0 0 1-4.8-1.32l-.35-.2-3.57.94.95-3.48-.22-.36a9.4 9.4 0 0 1-1.44-5.02c0-5.2 4.24-9.44 9.45-9.44 2.52 0 4.9.99 6.68 2.77a9.38 9.38 0 0 1 2.76 6.68c0 5.21-4.24 9.43-9.45 9.43zm8.04-17.47A11.3 11.3 0 0 0 12.04.7C5.78.7.68 5.8.68 12.06c0 2 .52 3.96 1.52 5.68L.6 23.3l5.69-1.49a11.33 11.33 0 0 0 5.75 1.47h.01c6.26 0 11.36-5.1 11.36-11.36 0-3.03-1.18-5.89-3.32-8.03z"/></svg>
        <span class="wa-tip">Chat on WhatsApp</span>
    </a>

    <script src="{{ asset('js/cv.js') }}" defer></script>
</body>
</html>
