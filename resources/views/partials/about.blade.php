<section class="section" id="about">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-kicker">01 — About</span>
            <h2 class="section-title">Engineering software that <em>businesses rely on</em></h2>
        </div>

        <div class="about-grid">
            <div class="about-text reveal">
                <p class="lead">{{ $cv['summary'] }}</p>
            </div>

            <div class="highlights">
                @foreach ($cv['highlights'] as $i => $h)
                    <article class="card highlight reveal" style="--d: {{ $i * 80 }}ms">
                        <span class="highlight-num">0{{ $i + 1 }}</span>
                        <h3>{{ $h['title'] }}</h3>
                        <p>{{ $h['text'] }}</p>
                    </article>
                @endforeach
            </div>
        </div>
    </div>
</section>
