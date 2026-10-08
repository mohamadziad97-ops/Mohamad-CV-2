<section class="section" id="skills">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-kicker">03 — Skills</span>
            <h2 class="section-title">The <em>toolkit</em> I work with</h2>
        </div>

        <div class="skills-grid">
            @foreach ($cv['skills'] as $i => $group)
                <article class="card skill-card reveal" style="--d: {{ ($i % 3) * 80 }}ms">
                    <h3>{{ $group['group'] }}</h3>
                    <ul class="chips">
                        @foreach ($group['items'] as $item)
                            <li class="chip">{{ $item }}</li>
                        @endforeach
                    </ul>
                </article>
            @endforeach
        </div>
    </div>
</section>
