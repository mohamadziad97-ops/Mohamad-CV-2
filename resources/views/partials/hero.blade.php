<section class="hero">
    <div class="container hero-grid">
        <div class="hero-copy">
            <p class="eyebrow reveal"><span class="pulse"></span> Open to new opportunities · {{ $cv['contact']['location'] }}</p>
            <h1 class="hero-title reveal">
                <span class="hello">Hello, I'm</span>
                {{ $cv['name'] }}
            </h1>
            <p class="hero-role reveal"><span class="gradient-text">{{ $cv['title'] }}</span></p>
            <p class="hero-tagline reveal">{{ $cv['tagline'] }}</p>

            <div class="hero-ctas reveal">
                <a href="#contact" class="btn btn-primary">Let's work together <span aria-hidden="true">→</span></a>
                <a href="{{ asset('files/Mohammad_Ghaith_CV.pdf') }}" class="btn btn-ghost" download>
                    <svg viewBox="0 0 24 24" width="17" height="17" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 3v12M7 10l5 5 5-5M5 21h14"/></svg>
                    Download CV
                </a>
                <button type="button" class="btn btn-ghost" data-li-open>
                    <svg viewBox="0 0 24 24" width="16" height="16" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9.75h4v11H3zM9.5 9.75h3.8v1.6h.06c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.77 2.6 4.77 6v5.45h-4v-4.83c0-1.15-.02-2.63-1.6-2.63-1.6 0-1.85 1.25-1.85 2.55v4.91h-4z"/></svg>
                    LinkedIn
                </button>
            </div>

            <ul class="hero-meta reveal">
                <li><a href="mailto:{{ $cv['contact']['email'] }}">{{ $cv['contact']['email'] }}</a></li>
                <li><a href="tel:{{ $cv['contact']['phone_raw'] }}">{{ $cv['contact']['phone'] }}</a></li>
                <li><a href="https://wa.me/{{ $cv['whatsapp']['number'] }}?text={{ rawurlencode($cv['whatsapp']['message']) }}" target="_blank" rel="noopener" class="wa-inline"><svg viewBox="0 0 24 24" width="15" height="15" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.25-.46-2.38-1.47-.88-.79-1.47-1.76-1.64-2.05-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.6-.92-2.2-.24-.58-.49-.5-.67-.5h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.88 1.21 3.08.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.22 1.36.19 1.87.12.57-.09 1.75-.72 2-1.41.25-.69.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35zM12.05 21.5h-.01a9.43 9.43 0 0 1-4.8-1.32l-.35-.2-3.57.94.95-3.48-.22-.36a9.4 9.4 0 0 1-1.44-5.02c0-5.2 4.24-9.44 9.45-9.44 2.52 0 4.9.99 6.68 2.77a9.38 9.38 0 0 1 2.76 6.68c0 5.21-4.24 9.43-9.45 9.43zm8.04-17.47A11.3 11.3 0 0 0 12.04.7C5.78.7.68 5.8.68 12.06c0 2 .52 3.96 1.52 5.68L.6 23.3l5.69-1.49a11.33 11.33 0 0 0 5.75 1.47h.01c6.26 0 11.36-5.1 11.36-11.36 0-3.03-1.18-5.89-3.32-8.03z"/></svg> WhatsApp</a></li>
            </ul>
        </div>

        <div class="hero-visual reveal">
            <div class="portrait">
                <div class="portrait-ring" aria-hidden="true"></div>
                <img src="{{ asset($cv['photo']) }}" alt="Portrait of {{ $cv['name'] }}" width="800" height="805">
                <div class="float-card fc-1">
                    <strong>5+</strong>
                    <span>years of<br>experience</span>
                </div>
                <div class="float-card fc-2">
                    <span class="dot"></span>
                    <span>Laravel · PHP · SQL</span>
                </div>
                <div class="float-card fc-3">
                    <span class="code">&lt;/&gt;</span>
                    <span>Clean, secure code</span>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="stats reveal">
            @foreach ($cv['stats'] as $stat)
                <div class="stat">
                    <span class="stat-value" data-count="{{ $stat['value'] }}">{{ $stat['value'] }}</span>
                    <span class="stat-label">{{ $stat['label'] }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>
