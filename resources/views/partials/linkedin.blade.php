<dialog class="li-modal" id="liModal" aria-labelledby="liTitle" data-delay="{{ $cv['linkedin']['popup_delay'] }}">
    <div class="li-card">
        <button type="button" class="li-close" data-li-close aria-label="Close">
            <svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round"><path d="M6 6l12 12M18 6 6 18"/></svg>
        </button>

        <div class="li-banner" aria-hidden="true"></div>

        <div class="li-avatar">
            <img src="{{ asset($cv['photo']) }}" alt="" width="96" height="96">
            <span class="li-badge" aria-hidden="true">in</span>
        </div>

        <h2 class="li-name" id="liTitle">{{ $cv['name'] }}</h2>
        <p class="li-title">{{ $cv['title'] }} · {{ $cv['contact']['location'] }}</p>

        <p class="li-text">Let's connect on LinkedIn — I share my work on enterprise systems, Laravel and backend engineering.</p>

        <div class="li-url">
            <span>linkedin.com/{{ $cv['linkedin']['handle'] }}</span>
            <button type="button" class="li-copy" data-li-copy="{{ $cv['linkedin']['url'] }}">Copy</button>
        </div>

        <div class="li-actions">
            <a href="{{ $cv['linkedin']['url'] }}" target="_blank" rel="noopener" class="btn btn-li btn-block">
                View LinkedIn profile <span aria-hidden="true">↗</span>
            </a>
            <button type="button" class="btn btn-ghost btn-block" data-li-close>Maybe later</button>
        </div>
    </div>
</dialog>
