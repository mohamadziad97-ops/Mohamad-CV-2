<section class="section section-alt" id="education">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-kicker">04 — Education &amp; Languages</span>
            <h2 class="section-title">Foundations &amp; <em>communication</em></h2>
        </div>

        <div class="edu-grid">
            @foreach ($cv['education'] as $edu)
                <article class="card edu-card reveal">
                    <div class="edu-icon" aria-hidden="true">
                        <svg viewBox="0 0 24 24" width="26" height="26" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M22 10 12 5 2 10l10 5 10-5z"/><path d="M6 12v5c3 2 9 2 12 0v-5"/></svg>
                    </div>
                    <h3>{{ $edu['degree'] }}</h3>
                    <p class="edu-school">{{ $edu['school'] }}</p>
                    <div class="edu-meta">
                        <span class="badge">{{ $edu['period'] }}</span>
                        <span class="badge">{{ $edu['note'] }}</span>
                    </div>
                </article>
            @endforeach

            <article class="card lang-card reveal" style="--d: 80ms">
                <h3>Languages</h3>
                @foreach ($cv['languages'] as $lang)
                    <div class="lang">
                        <div class="lang-row">
                            <span class="lang-name">{{ $lang['name'] }}</span>
                            <span class="lang-level">{{ $lang['level'] }}</span>
                        </div>
                        <div class="bar"><span style="--w: {{ $lang['percent'] }}%"></span></div>
                    </div>
                @endforeach
            </article>
        </div>
    </div>
</section>
