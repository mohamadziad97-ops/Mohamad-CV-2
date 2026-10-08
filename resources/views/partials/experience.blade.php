<section class="section section-alt" id="experience">
    <div class="container">
        <div class="section-head reveal">
            <span class="section-kicker">02 — Experience</span>
            <h2 class="section-title">Where I've <em>made an impact</em></h2>
        </div>

        <ol class="timeline">
            @foreach ($cv['experience'] as $job)
                <li class="timeline-item reveal">
                    <span class="timeline-dot @if ($job['current']) is-current @endif" aria-hidden="true"></span>
                    <div class="card job">
                        <div class="job-head">
                            <div>
                                <h3 class="job-role">{{ $job['role'] }}</h3>
                                <p class="job-company">{{ $job['company'] }} <span>· {{ $job['location'] }}</span></p>
                            </div>
                            <span class="badge @if ($job['current']) badge-live @endif">{{ $job['period'] }}</span>
                        </div>
                        <ul class="job-points">
                            @foreach ($job['points'] as $point)
                                <li>{{ $point }}</li>
                            @endforeach
                        </ul>
                    </div>
                </li>
            @endforeach
        </ol>
    </div>
</section>
