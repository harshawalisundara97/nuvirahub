/**
 * Nuvirahub theme — interactive enhancements
 * Phase A: gallery + animations
 */
(function () {
  'use strict';

  const $  = (sel, ctx = document) => ctx.querySelector(sel);
  const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 1. Sticky nav style on scroll ---------- */
  const nav = $('#nv-nav');
  if (nav) {
    const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 20);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---------- 2. Mobile menu toggle ---------- */
  const toggle = $('#nv-toggle');
  const menu   = $('#primary-menu');
  if (toggle && menu) {
    toggle.addEventListener('click', () => menu.classList.toggle('open'));
    menu.addEventListener('click', (e) => {
      if (e.target.tagName === 'A') menu.classList.remove('open');
    });
  }

  /* ---------- 3. Scroll progress bar (A6) ---------- */
  const progressBar = document.createElement('div');
  progressBar.className = 'nv-scroll-progress';
  document.body.appendChild(progressBar);
  const updateProgress = () => {
    const h = document.documentElement;
    const pct = (h.scrollTop / (h.scrollHeight - h.clientHeight)) * 100;
    progressBar.style.transform = `scaleX(${pct / 100})`;
  };
  window.addEventListener('scroll', updateProgress, { passive: true });
  updateProgress();

  /* ---------- 4. Scroll reveal ---------- */
  const reveals = $$('.nv-reveal');
  if ('IntersectionObserver' in window && reveals.length) {
    const io = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          io.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    reveals.forEach((el) => io.observe(el));
  } else {
    reveals.forEach((el) => el.classList.add('in'));
  }

  /* ---------- 5. Staggered process steps (A7) ---------- */
  $$('.nv-process').forEach((proc) => {
    const steps = $$('.nv-step', proc);
    steps.forEach((step, i) => {
      step.style.transitionDelay = `${i * 0.12}s`;
      step.classList.add('nv-reveal-step');
    });
    if ('IntersectionObserver' in window) {
      const io = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
          if (entry.isIntersecting) {
            steps.forEach((s) => s.classList.add('in'));
            io.unobserve(entry.target);
          }
        });
      }, { threshold: 0.2 });
      io.observe(proc);
    } else {
      steps.forEach((s) => s.classList.add('in'));
    }
  });

  /* ---------- 6. Animated stat counters (A2) ---------- */
  const counters = $$('.nv-stat-num');
  if (counters.length && 'IntersectionObserver' in window) {
    const countIO = new IntersectionObserver((entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        const text = el.textContent.trim();
        const match = text.match(/^([0-9.]+)(.*)$/);
        if (!match) { countIO.unobserve(el); return; }
        const target = parseFloat(match[1]);
        const suffix = match[2];
        const duration = 1400;
        const start = performance.now();
        const step = (now) => {
          const t = Math.min((now - start) / duration, 1);
          const eased = 1 - Math.pow(1 - t, 3);
          const value = target * eased;
          el.textContent = (target % 1 === 0 ? Math.round(value) : value.toFixed(1)) + suffix;
          if (t < 1) requestAnimationFrame(step);
        };
        if (!reduceMotion) requestAnimationFrame(step);
        countIO.unobserve(el);
      });
    }, { threshold: 0.4 });
    counters.forEach((c) => {
      c.dataset.original = c.textContent;
      countIO.observe(c);
    });
  }

  /* ---------- 7. Hero mouse parallax (A3) ---------- */
  const hero = $('.nv-hero');
  if (hero && !reduceMotion) {
    const orbs = $$('.nv-orb', hero);
    const grid = $('.nv-hero-grid', hero);
    let mx = 0, my = 0, rafId = null;
    hero.addEventListener('mousemove', (e) => {
      const rect = hero.getBoundingClientRect();
      mx = ((e.clientX - rect.left) / rect.width - 0.5) * 2;
      my = ((e.clientY - rect.top) / rect.height - 0.5) * 2;
      if (!rafId) rafId = requestAnimationFrame(applyParallax);
    });
    function applyParallax() {
      orbs.forEach((orb, i) => {
        const depth = (i + 1) * 20;
        orb.style.transform = `translate3d(${mx * depth}px, ${my * depth}px, 0)`;
      });
      if (grid) grid.style.transform = `translate3d(${mx * -10}px, ${my * -10}px, 0)`;
      rafId = null;
    }
  }

  /* ---------- 8. Magnetic buttons (A4) ---------- */
  if (!reduceMotion) {
    $$('.nv-btn-primary, .nv-btn-ghost, .nv-cta').forEach((btn) => {
      btn.addEventListener('mousemove', (e) => {
        const rect = btn.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width / 2;
        const y = e.clientY - rect.top - rect.height / 2;
        btn.style.transform = `translate(${x * 0.18}px, ${y * 0.28}px)`;
      });
      btn.addEventListener('mouseleave', () => { btn.style.transform = ''; });
    });
  }

  /* ---------- 9. 3D tilt on hover (A5) ---------- */
  if (!reduceMotion && window.matchMedia('(hover: hover)').matches) {
    $$('.nv-pillar, .nv-glass, .nv-erp-module, .nv-launchpad-step, .nv-auth-card, .nv-freight-card, .nv-testimonial').forEach((card) => {
      card.style.transformStyle = 'preserve-3d';
      card.style.willChange = 'transform';
      card.addEventListener('mousemove', (e) => {
        const rect = card.getBoundingClientRect();
        const x = (e.clientX - rect.left) / rect.width - 0.5;
        const y = (e.clientY - rect.top) / rect.height - 0.5;
        card.style.transform = `perspective(900px) rotateX(${-y * 4}deg) rotateY(${x * 4}deg) translateY(-3px)`;
      });
      card.addEventListener('mouseleave', () => { card.style.transform = ''; });
    });
  }

  /* ---------- 10. Testimonial carousel (A9) ---------- */
  $$('.nv-testimonial-carousel').forEach((wrap) => {
    const track = $('.nv-testimonial-track', wrap);
    const slides = $$('.nv-testimonial', track);
    if (slides.length < 2) return;
    let idx = 0, autoTimer = null;

    // Build dots
    const dots = document.createElement('div');
    dots.className = 'nv-carousel-dots';
    slides.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.className = 'nv-carousel-dot';
      dot.setAttribute('aria-label', `Show testimonial ${i + 1}`);
      dot.addEventListener('click', () => { go(i); restart(); });
      dots.appendChild(dot);
    });
    wrap.appendChild(dots);
    const dotEls = $$('.nv-carousel-dot', dots);

    function go(i) {
      idx = (i + slides.length) % slides.length;
      track.style.transform = `translateX(-${idx * 100}%)`;
      dotEls.forEach((d, di) => d.classList.toggle('active', di === idx));
    }
    function tick() { go(idx + 1); }
    function start() { if (!reduceMotion) autoTimer = setInterval(tick, 5500); }
    function stop()  { if (autoTimer) { clearInterval(autoTimer); autoTimer = null; } }
    function restart() { stop(); start(); }
    wrap.addEventListener('mouseenter', stop);
    wrap.addEventListener('mouseleave', start);
    go(0); start();
  });

  /* ---------- 11. Portfolio filter + lightbox (A1) ---------- */
  const filters = $$('.nv-tabp');
  const items   = $$('.nv-portfolio[data-cats]');
  if (filters.length && items.length) {
    filters.forEach((tab) => {
      tab.addEventListener('click', () => {
        filters.forEach((t) => t.classList.remove('active'));
        tab.classList.add('active');
        const cat = tab.dataset.filter || 'all';
        items.forEach((item) => {
          const matches = cat === 'all' || (item.dataset.cats || '').split(' ').includes(cat);
          item.style.transition = 'opacity .4s ease, transform .4s ease';
          if (matches) {
            item.style.display = '';
            requestAnimationFrame(() => { item.style.opacity = '1'; item.style.transform = ''; });
          } else {
            item.style.opacity = '0';
            item.style.transform = 'scale(.95)';
            setTimeout(() => { item.style.display = 'none'; }, 400);
          }
        });
      });
    });
  }

  // Lightbox
  const lightbox = document.createElement('div');
  lightbox.className = 'nv-lightbox';
  lightbox.innerHTML = `
    <button class="nv-lightbox-close" aria-label="Close">×</button>
    <div class="nv-lightbox-content">
      <div class="nv-lightbox-visual"></div>
      <div class="nv-lightbox-body">
        <div class="nv-lightbox-tag"></div>
        <h2 class="nv-lightbox-title"></h2>
        <p class="nv-lightbox-desc"></p>
        <div class="nv-lightbox-tags"></div>
      </div>
    </div>
  `;
  document.body.appendChild(lightbox);
  const lbClose  = $('.nv-lightbox-close', lightbox);
  const lbVisual = $('.nv-lightbox-visual', lightbox);
  const lbTag    = $('.nv-lightbox-tag', lightbox);
  const lbTitle  = $('.nv-lightbox-title', lightbox);
  const lbDesc   = $('.nv-lightbox-desc', lightbox);
  const lbTags   = $('.nv-lightbox-tags', lightbox);

  function openLightbox(data) {
    if (data.image) {
      lbVisual.style.background = 'url(' + data.image + ') center/cover no-repeat #0a0f1e';
      lbVisual.textContent = '';
    } else {
      lbVisual.style.background = data.gradient || 'linear-gradient(135deg, rgba(108,99,255,.3), rgba(56,189,248,.2))';
      lbVisual.textContent = data.emoji || '✨';
    }
    lbTag.textContent = data.category || 'Project';
    lbTitle.textContent = data.title || '';
    lbDesc.textContent = data.desc || '';
    lbTags.innerHTML = (data.tags || []).map((t) => `<span class="nv-tag-pill">${t}</span>`).join('');
    lightbox.classList.add('open');
    document.body.style.overflow = 'hidden';
  }
  function closeLightbox() {
    lightbox.classList.remove('open');
    document.body.style.overflow = '';
  }
  lbClose.addEventListener('click', closeLightbox);
  lightbox.addEventListener('click', (e) => { if (e.target === lightbox) closeLightbox(); });
  document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeLightbox(); });

  items.forEach((item) => {
    item.style.cursor = 'pointer';
    item.addEventListener('click', () => {
      openLightbox({
        title:    item.dataset.title    || '',
        desc:     item.dataset.desc     || '',
        category: item.dataset.category || '',
        emoji:    item.dataset.emoji    || '',
        image:    item.dataset.image    || '',
        gradient: item.dataset.gradient || '',
        tags:     (item.dataset.tags || '').split('|').filter(Boolean),
      });
    });
  });

})();
