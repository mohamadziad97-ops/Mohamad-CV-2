(function () {
    'use strict';

    var root = document.documentElement;

    // ---- Theme toggle ----
    var toggle = document.getElementById('themeToggle');
    if (toggle) {
        toggle.addEventListener('click', function () {
            var next = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
            root.setAttribute('data-theme', next);
            try { localStorage.setItem('cv-theme', next); } catch (e) {}
        });
    }

    // ---- Sticky nav ----
    var nav = document.querySelector('.nav');
    var onScroll = function () { nav && nav.classList.toggle('scrolled', window.scrollY > 20); };
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();

    // ---- Mobile menu ----
    var menuBtn = document.getElementById('menuToggle');
    var links = document.getElementById('navLinks');
    if (menuBtn && links) {
        menuBtn.addEventListener('click', function () {
            var open = links.classList.toggle('open');
            menuBtn.setAttribute('aria-expanded', open ? 'true' : 'false');
        });
        links.addEventListener('click', function (e) {
            if (e.target.tagName === 'A') {
                links.classList.remove('open');
                menuBtn.setAttribute('aria-expanded', 'false');
            }
        });
    }

    // ---- Reveal on scroll ----
    var revealEls = document.querySelectorAll('.reveal');
    if (!('IntersectionObserver' in window)) {
        revealEls.forEach(function (el) { el.classList.add('in'); });
    } else {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    entry.target.classList.add('in');
                    io.unobserve(entry.target);
                }
            });
        }, { threshold: 0.12, rootMargin: '0px 0px -40px 0px' });
        revealEls.forEach(function (el) { io.observe(el); });
    }

    // ---- Animated counters ----
    var counters = document.querySelectorAll('[data-count]');
    var animate = function (el) {
        var raw = el.getAttribute('data-count');
        var match = raw.match(/^(\d+)(.*)$/);
        if (!match) return;
        var target = parseInt(match[1], 10), suffix = match[2], start = null, dur = 1400;
        var step = function (ts) {
            if (!start) start = ts;
            var p = Math.min((ts - start) / dur, 1);
            var eased = 1 - Math.pow(1 - p, 3);
            el.textContent = Math.round(target * eased) + suffix;
            if (p < 1) requestAnimationFrame(step);
        };
        requestAnimationFrame(step);
    };
    if ('IntersectionObserver' in window && !window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        var co = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) { animate(entry.target); co.unobserve(entry.target); }
            });
        }, { threshold: 0.6 });
        counters.forEach(function (el) { co.observe(el); });
    }

    // ---- Active nav link ----
    var sections = document.querySelectorAll('main section[id]');
    var navAnchors = document.querySelectorAll('.nav-links a');
    if ('IntersectionObserver' in window) {
        var so = new IntersectionObserver(function (entries) {
            entries.forEach(function (entry) {
                if (entry.isIntersecting) {
                    navAnchors.forEach(function (a) {
                        a.classList.toggle('active', a.getAttribute('href') === '#' + entry.target.id);
                    });
                }
            });
        }, { rootMargin: '-45% 0px -50% 0px' });
        sections.forEach(function (s) { so.observe(s); });
    }
    // ---- LinkedIn pop-up ----
    var li = document.getElementById('liModal');
    if (li && typeof li.showModal === 'function') {
        var openLi = function () {
            if (!li.open) li.showModal();
            try { localStorage.setItem('cv-li-seen', '1'); } catch (e) {}
        };
        document.querySelectorAll('[data-li-open]').forEach(function (b) {
            b.addEventListener('click', openLi);
        });
        li.querySelectorAll('[data-li-close]').forEach(function (b) {
            b.addEventListener('click', function () { li.close(); });
        });
        li.addEventListener('click', function (e) { if (e.target === li) li.close(); }); // click outside card
        var copyBtn = li.querySelector('[data-li-copy]');
        if (copyBtn) copyBtn.addEventListener('click', function () {
            var url = copyBtn.getAttribute('data-li-copy');
            var done = function () { copyBtn.textContent = 'Copied!'; setTimeout(function () { copyBtn.textContent = 'Copy'; }, 1800); };
            if (navigator.clipboard) navigator.clipboard.writeText(url).then(done, function () {}); else done();
        });
        // Open once automatically for first-time visitors
        var delay = parseInt(li.getAttribute('data-delay'), 10) || 0;
        var seen = false;
        try { seen = localStorage.getItem('cv-li-seen') === '1'; } catch (e) {}
        if (delay > 0 && !seen) setTimeout(function () { if (!document.querySelector('dialog[open]')) openLi(); }, delay * 1000);
    } else if (li) {
        // Very old browsers: just open the profile in a new tab
        document.querySelectorAll('[data-li-open]').forEach(function (b) {
            b.addEventListener('click', function () { window.open(li.querySelector('.btn-li').href, '_blank', 'noopener'); });
        });
    }
})();

// ---- Contact form: prevent double-submit ----
(function () {
    var f = document.getElementById('contactForm'), b = document.getElementById('contactSubmit');
    if (!f || !b) return;

    // Static build (GitHub Pages): no server, so open the visitor's email app instead
    var to = f.getAttribute('data-mailto');
    if (to) {
        f.addEventListener('submit', function (ev) {
            ev.preventDefault();
            var v = function (id) { return document.getElementById(id).value.trim(); };
            if (v('website')) return;                 // honeypot
            if (!f.checkValidity()) { f.reportValidity(); return; }
            var name = v('name'), email = v('email'), msg = v('message');
            window.location.href = 'mailto:' + to
                + '?subject=' + encodeURIComponent('CV website: message from ' + name)
                + '&body=' + encodeURIComponent(msg + '\n\n— ' + name + ' (' + email + ')');
        });
        return;
    }

    f.addEventListener('submit', function () { b.disabled = true; b.style.opacity = '.7'; b.textContent = 'Sending…'; });
})();
