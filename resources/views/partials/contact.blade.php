<section class="section" id="contact">
    <div class="container">
        <div class="contact-wrap card reveal">
            <div class="contact-info">
                <span class="section-kicker">05 — Contact</span>
                <h2 class="section-title">Let's build something <em>great together</em></h2>
                <p class="muted">Have a project, a role, or just want to talk tech? Send a message and I'll get back to you soon.</p>

                <ul class="contact-list">
                    <li>
                        <span class="ci" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg></span>
                        <div><small>Email</small><a href="mailto:{{ $cv['contact']['email'] }}">{{ $cv['contact']['email'] }}</a></div>
                    </li>
                    <li>
                        <span class="ci" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.9v3a2 2 0 0 1-2.2 2 19.8 19.8 0 0 1-8.6-3.1 19.5 19.5 0 0 1-6-6A19.8 19.8 0 0 1 2.1 4.2 2 2 0 0 1 4.1 2h3a2 2 0 0 1 2 1.7c.1.9.4 1.8.7 2.7a2 2 0 0 1-.5 2.1L8 9.8a16 16 0 0 0 6 6l1.3-1.3a2 2 0 0 1 2.1-.4c.9.3 1.8.6 2.7.7a2 2 0 0 1 1.7 2z"/></svg></span>
                        <div><small>Phone</small><a href="tel:{{ $cv['contact']['phone_raw'] }}">{{ $cv['contact']['phone'] }}</a></div>
                    </li>
                    <li>
                        <span class="ci ci-wa" aria-hidden="true"><svg viewBox="0 0 24 24" width="19" height="19" fill="currentColor" aria-hidden="true"><path d="M17.47 14.38c-.3-.15-1.75-.86-2.02-.96-.27-.1-.47-.15-.67.15-.2.3-.77.96-.94 1.16-.17.2-.35.22-.64.07-.3-.15-1.25-.46-2.38-1.47-.88-.79-1.47-1.76-1.64-2.05-.17-.3-.02-.46.13-.6.13-.14.3-.35.45-.52.15-.17.2-.3.3-.5.1-.2.05-.37-.02-.52-.08-.15-.67-1.6-.92-2.2-.24-.58-.49-.5-.67-.5h-.57c-.2 0-.52.07-.79.37-.27.3-1.04 1.02-1.04 2.48 0 1.46 1.07 2.88 1.21 3.08.15.2 2.1 3.2 5.08 4.49.71.31 1.26.49 1.7.63.71.22 1.36.19 1.87.12.57-.09 1.75-.72 2-1.41.25-.69.25-1.29.17-1.41-.07-.12-.27-.2-.57-.35zM12.05 21.5h-.01a9.43 9.43 0 0 1-4.8-1.32l-.35-.2-3.57.94.95-3.48-.22-.36a9.4 9.4 0 0 1-1.44-5.02c0-5.2 4.24-9.44 9.45-9.44 2.52 0 4.9.99 6.68 2.77a9.38 9.38 0 0 1 2.76 6.68c0 5.21-4.24 9.43-9.45 9.43zm8.04-17.47A11.3 11.3 0 0 0 12.04.7C5.78.7.68 5.8.68 12.06c0 2 .52 3.96 1.52 5.68L.6 23.3l5.69-1.49a11.33 11.33 0 0 0 5.75 1.47h.01c6.26 0 11.36-5.1 11.36-11.36 0-3.03-1.18-5.89-3.32-8.03z"/></svg></span>
                        <div><small>WhatsApp</small><a href="https://wa.me/{{ $cv['whatsapp']['number'] }}?text={{ rawurlencode($cv['whatsapp']['message']) }}" target="_blank" rel="noopener">Chat with me on WhatsApp</a></div>
                    </li>
                    <li>
                        <span class="ci" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" fill="currentColor" aria-hidden="true"><path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9.75h4v11H3zM9.5 9.75h3.8v1.6h.06c.53-1 1.83-2.05 3.77-2.05 4.03 0 4.77 2.6 4.77 6v5.45h-4v-4.83c0-1.15-.02-2.63-1.6-2.63-1.6 0-1.85 1.25-1.85 2.55v4.91h-4z"/></svg></span>
                        <div><small>LinkedIn</small><button type="button" class="link-btn" data-li-open>{{ $cv['linkedin']['handle'] }}</button></div>
                    </li>
                    <li>
                        <span class="ci" aria-hidden="true"><svg viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s7-6.1 7-12a7 7 0 0 0-14 0c0 5.9 7 12 7 12z"/><circle cx="12" cy="10" r="2.5"/></svg></span>
                        <div><small>Location</small><span>{{ $cv['contact']['location'] }}</span></div>
                    </li>
                </ul>

                @if (count($cv['socials']))
                    <div class="socials">
                        @foreach ($cv['socials'] as $s)
                            <a href="{{ $s['url'] }}" target="_blank" rel="noopener" class="chip">{{ $s['label'] }} ↗</a>
                        @endforeach
                    </div>
                @endif
            </div>

            <form class="contact-form" id="contactForm" method="POST" action="{{ route('cv.contact') }}" novalidate>
                @csrf

                @if (session('status'))
                    <div class="alert alert-ok" role="status">{{ session('status') }}</div>
                @endif
                @if (session('mail_error'))
                    <div class="alert alert-err" role="alert">{{ session('mail_error') }}</div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-err" role="alert">Please check the highlighted fields and try again.</div>
                @endif

                <div class="field @if ($errors->has('name')) has-error @endif">
                    <label for="name">Your name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Jane Doe" required autocomplete="name">
                    @if ($errors->has('name'))<small class="err">{{ $errors->first('name') }}</small>@endif
                </div>

                <div class="field @if ($errors->has('email')) has-error @endif">
                    <label for="email">Email address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" placeholder="jane@company.com" required autocomplete="email">
                    @if ($errors->has('email'))<small class="err">{{ $errors->first('email') }}</small>@endif
                </div>

                <div class="field @if ($errors->has('message')) has-error @endif">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" placeholder="Tell me about your project or role…" required>{{ old('message') }}</textarea>
                    @if ($errors->has('message'))<small class="err">{{ $errors->first('message') }}</small>@endif
                </div>

                <div class="hp" aria-hidden="true">
                    <label for="website">Website</label>
                    <input id="website" name="website" type="text" tabindex="-1" autocomplete="off">
                </div>

                <button type="submit" class="btn btn-primary btn-block" id="contactSubmit">Send message <span aria-hidden="true">→</span></button>
            </form>
        </div>
    </div>
</section>
