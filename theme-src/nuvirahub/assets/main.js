/**
 * Nuvirahub theme — interactive enhancements
 * Phase A: gallery + animations
 */
(function () {
  'use strict';

  const $  = (sel, ctx = document) => ctx.querySelector(sel);
  const $$ = (sel, ctx = document) => Array.from(ctx.querySelectorAll(sel));
  const reduceMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;

  /* ---------- 0a. Light / dark theme toggle ---------- */
  (function () {
    const root = document.documentElement;
    const btn = $('#nv-theme-toggle');
    const meta = $('#nv-theme-color');
    const apply = (theme) => {
      root.setAttribute('data-theme', theme);
      if (btn) btn.setAttribute('aria-label',
        theme === 'light' ? 'Switch to dark theme' : 'Switch to light theme');
      if (meta) meta.setAttribute('content', theme === 'light' ? '#f5f7fc' : '#05080f');
    };
    // Ensure an explicit value (the inline head script normally sets this).
    apply(root.getAttribute('data-theme') || 'dark');
    if (btn) {
      btn.addEventListener('click', () => {
        const next = root.getAttribute('data-theme') === 'light' ? 'dark' : 'light';
        apply(next);
        try { localStorage.setItem('nv-theme', next); } catch (e) {}
      });
    }
    // Follow OS changes only when the user hasn't chosen explicitly.
    const mq = window.matchMedia('(prefers-color-scheme: light)');
    mq.addEventListener && mq.addEventListener('change', (e) => {
      let saved = null;
      try { saved = localStorage.getItem('nv-theme'); } catch (err) {}
      if (!saved) apply(e.matches ? 'light' : 'dark');
    });
  })();

  /* ---------- 0b. Mini-cart drawer (WooCommerce) ---------- */
  (function () {
    const toggle  = $('#nv-cart-toggle');
    const drawer  = $('#nv-cart-drawer');
    const overlay = $('#nv-cart-overlay');
    const closeBtn = $('#nv-cart-close');
    if (!toggle || !drawer || !overlay) return;

    const open = () => {
      drawer.classList.add('open');
      overlay.hidden = false;
      requestAnimationFrame(() => overlay.classList.add('show'));
      drawer.setAttribute('aria-hidden', 'false');
      document.body.classList.add('nv-cart-locked');
    };
    const close = () => {
      drawer.classList.remove('open');
      overlay.classList.remove('show');
      drawer.setAttribute('aria-hidden', 'true');
      document.body.classList.remove('nv-cart-locked');
      setTimeout(() => { overlay.hidden = true; }, 300);
    };

    toggle.addEventListener('click', (e) => {
      e.preventDefault();
      drawer.classList.contains('open') ? close() : open();
    });
    overlay.addEventListener('click', close);
    if (closeBtn) closeBtn.addEventListener('click', close);
    document.addEventListener('keydown', (e) => { if (e.key === 'Escape') close(); });

    // When WooCommerce refreshes fragments after add-to-cart, pop the drawer open.
    document.body.addEventListener('added_to_cart', open);
    // jQuery-triggered event fallback (WooCommerce fires via jQuery)
    if (window.jQuery) {
      window.jQuery(document.body).on('added_to_cart', open);
    }
  })();

  /* ---------- 0. Page loader fade-out ---------- */
  const loader = $('#nv-loader');
  if (loader) {
    const hide = () => {
      loader.classList.add('done');
      setTimeout(() => loader.remove(), 600);
    };
    if (document.readyState === 'complete') hide();
    else window.addEventListener('load', hide);
    // Safety fallback — never block the page longer than 3s
    setTimeout(hide, 3000);
  }

  /* ---------- 1. Sticky nav style on scroll ---------- */
  const nav = $('#nv-nav');
  if (nav) {
    const onScroll = () => nav.classList.toggle('scrolled', window.scrollY > 20);
    window.addEventListener('scroll', onScroll, { passive: true });
    onScroll();
  }

  /* ---------- 2. Mobile menu toggle ---------- */
  const toggle = $('#nv-toggle');
  const panel  = $('#nv-menu-panel');
  if (toggle && panel) {
    const setOpen = (open) => {
      panel.classList.toggle('open', open);
      document.body.classList.toggle('nv-menu-open', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    };
    toggle.addEventListener('click', () => setOpen(!panel.classList.contains('open')));
    panel.addEventListener('click', (e) => {
      if (e.target.tagName === 'A') setOpen(false);
    });
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') setOpen(false);
    });
    // Reset state if resized back to desktop
    window.addEventListener('resize', () => {
      if (window.innerWidth > 880) setOpen(false);
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
    }, { threshold: 0, rootMargin: '0px 0px -40px 0px' });
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
      }, { threshold: 0, rootMargin: '0px 0px -40px 0px' });
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

  /* ---------- 10. Swipe carousels (testimonials, founders) ---------- */
  $$('.nv-swipe-carousel').forEach((wrap) => {
    const track = $('.nv-swipe-track', wrap);
    if (!track) return;
    const slides = Array.prototype.slice.call(track.children);
    if (slides.length < 2) return;
    let idx = 0, autoTimer = null;

    // Dots
    const dots = document.createElement('div');
    dots.className = 'nv-carousel-dots';
    slides.forEach((_, i) => {
      const dot = document.createElement('button');
      dot.className = 'nv-carousel-dot';
      dot.setAttribute('aria-label', `Go to slide ${i + 1}`);
      dot.addEventListener('click', () => { go(i); restart(); });
      dots.appendChild(dot);
    });
    wrap.appendChild(dots);
    const dotEls = $$('.nv-carousel-dot', dots);

    // Prev / next arrows
    [-1, 1].forEach((dir) => {
      const btn = document.createElement('button');
      btn.className = 'nv-carousel-arrow ' + (dir < 0 ? 'prev' : 'next');
      btn.setAttribute('aria-label', dir < 0 ? 'Previous' : 'Next');
      btn.innerHTML = `<svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round"><polyline points="${dir < 0 ? '15 18 9 12 15 6' : '9 18 15 12 9 6'}"/></svg>`;
      btn.addEventListener('click', () => { go(idx + dir); restart(); });
      wrap.appendChild(btn);
    });

    function go(i) {
      idx = (i + slides.length) % slides.length;
      track.style.transform = `translateX(-${idx * 100}%)`;
      slides.forEach((s, si) => s.classList.toggle('active', si === idx));
      dotEls.forEach((d, di) => d.classList.toggle('active', di === idx));
    }
    function tick() { go(idx + 1); }
    function start() { if (!reduceMotion) autoTimer = setInterval(tick, 6000); }
    function stop()  { if (autoTimer) { clearInterval(autoTimer); autoTimer = null; } }
    function restart() { stop(); start(); }

    // Drag / swipe (mouse + touch via pointer events)
    let startX = null, dragX = 0, dragging = false;
    track.addEventListener('pointerdown', (e) => {
      if (e.pointerType === 'mouse' && e.button !== 0) return;
      startX = e.clientX; dragX = 0; dragging = true;
      track.classList.add('dragging');
      stop();
    });
    window.addEventListener('pointermove', (e) => {
      if (!dragging) return;
      dragX = e.clientX - startX;
      track.style.transform = `translateX(calc(-${idx * 100}% + ${dragX}px))`;
    });
    const endDrag = () => {
      if (!dragging) return;
      dragging = false;
      track.classList.remove('dragging');
      const threshold = (wrap.clientWidth || 1) * 0.15;
      if (Math.abs(dragX) > threshold) go(idx + (dragX < 0 ? 1 : -1));
      else go(idx);
      start();
    };
    window.addEventListener('pointerup', endDrag);
    window.addEventListener('pointercancel', endDrag);

    wrap.addEventListener('mouseenter', stop);
    wrap.addEventListener('mouseleave', () => { if (!dragging) start(); });
    go(0); start();
  });

  /* ---------- 10b. Shop catalogue: filter + search + sort + wishlist (E2/E3) ---------- */
  (function () {
    const tabs    = $$('.nv-shop-filter');
    const cards   = $$('.nv-shop-card');
    const empty   = $('.nv-shop-empty');
    const search  = $('#nv-shop-search');
    const sort    = $('#nv-shop-sort');
    const shown$  = $('#nv-shop-shown');
    const reset   = $('#nv-shop-reset');
    if (!cards.length) return;

    const state = { cat: 'all', q: '', sort: 'featured' };
    const total = cards.length;

    const apply = () => {
      let shown = 0;
      cards.forEach((card) => {
        const catOk = state.cat === 'all' || card.dataset.cat === state.cat;
        const qOk   = !state.q || (card.dataset.search || '').indexOf(state.q) !== -1;
        const match = catOk && qOk;
        card.style.transition = 'opacity .3s ease, transform .3s ease';
        if (match) {
          shown++;
          card.style.display = '';
          requestAnimationFrame(() => { card.style.opacity = '1'; card.style.transform = ''; });
        } else {
          card.style.opacity = '0';
          card.style.transform = 'scale(.96)';
          setTimeout(() => { card.style.display = 'none'; }, 300);
        }
      });
      // sort: rewrite flex `order` so we don't reflow the DOM
      const sorted = cards.slice().sort((a, b) => {
        switch (state.sort) {
          case 'price-asc':  return parseFloat(a.dataset.price) - parseFloat(b.dataset.price);
          case 'price-desc': return parseFloat(b.dataset.price) - parseFloat(a.dataset.price);
          case 'name-asc':   return (a.dataset.name || '').localeCompare(b.dataset.name || '');
          case 'featured':
          default: {
            const r = (+a.dataset.featRank) - (+b.dataset.featRank);
            return r !== 0 ? r : (+a.dataset.origIndex) - (+b.dataset.origIndex);
          }
        }
      });
      sorted.forEach((c, i) => { c.style.order = i + 1; });
      if (shown$) shown$.textContent = String(shown);
      if (empty)  empty.hidden = shown !== 0;
    };

    tabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        tabs.forEach((t) => t.classList.remove('active'));
        tab.classList.add('active');
        state.cat = tab.dataset.filter || 'all';
        apply();
      });
    });
    if (search) {
      search.addEventListener('input', () => {
        state.q = search.value.trim().toLowerCase();
        apply();
      });
    }
    if (sort) {
      sort.addEventListener('change', () => {
        state.sort = sort.value;
        apply();
      });
    }
    if (reset) {
      reset.addEventListener('click', () => {
        tabs.forEach((t) => t.classList.toggle('active', t.dataset.filter === 'all'));
        if (search) search.value = '';
        if (sort)   sort.value = 'featured';
        state.cat = 'all'; state.q = ''; state.sort = 'featured';
        apply();
      });
    }

    void total;
  })();

  /* ---------- 10c. Wishlist hearts (E3/E4) — works on any page ---------- */
  (function () {
    const buttons = $$('.nv-shop-wishlist');
    if (!buttons.length) return;
    const KEY = 'nv-wishlist';
    const load = () => {
      try { return JSON.parse(localStorage.getItem(KEY) || '[]'); }
      catch (e) { return []; }
    };
    const save = (list) => {
      try { localStorage.setItem(KEY, JSON.stringify(list)); } catch (e) {}
    };
    const refresh = () => {
      const list = load();
      $$('.nv-shop-wishlist').forEach((btn) => {
        const on = list.indexOf(btn.dataset.slug) !== -1;
        btn.classList.toggle('on', on);
        btn.setAttribute('aria-pressed', on ? 'true' : 'false');
        btn.setAttribute('title', on ? 'Remove from wishlist' : 'Add to wishlist');
      });
    };
    buttons.forEach((btn) => {
      btn.addEventListener('click', (e) => {
        e.preventDefault(); e.stopPropagation();
        const list = load();
        const slug = btn.dataset.slug;
        const i = list.indexOf(slug);
        if (i === -1) list.push(slug); else list.splice(i, 1);
        save(list);
        refresh();
        btn.animate(
          [{ transform: 'scale(1)' }, { transform: 'scale(1.25)' }, { transform: 'scale(1)' }],
          { duration: 320, easing: 'cubic-bezier(.2,.7,.2,1)' }
        );
      });
    });
    refresh();
  })();

  /* ---------- 10d. Product detail page (E4) ---------- */
  (function () {
    const page = $('.nv-product-page');
    if (!page) return;

    const brand    = page.dataset.brand || '';
    const currency = page.dataset.currency || '€';
    const waBase   = page.dataset.waBase || '';
    const name     = page.dataset.name || '';

    const opts        = $$('.nv-product-opt', page);
    const qty         = $('#nv-product-qty');
    const stepUp      = $('.nv-step-up', page);
    const stepDown    = $('.nv-step-down', page);
    const priceEl     = $('#nv-product-price');
    const weightEl    = $('#nv-product-weight');
    const subtotalEl  = $('#nv-product-subtotal');
    const stickyPrice = $('#nv-stickybar-price');
    const orderBtn    = $('#nv-product-order');
    const stickyOrder = $('#nv-stickybar-order');

    // Current selection: from the active option pill, or fall back to the inline price.
    const initOpt = opts.find((o) => o.classList.contains('active')) || opts[0];
    let state = {
      weight: initOpt ? initOpt.dataset.weight : (weightEl ? weightEl.textContent : ''),
      price:  initOpt ? parseFloat(initOpt.dataset.price) : parseFloat((priceEl?.textContent || '').replace(/[^0-9.]/g, '')) || 0,
      qty:    parseInt(qty?.value || '1', 10) || 1,
    };

    const fmt = (n) => currency + n.toFixed(2);
    const buildWa = () => {
      const subtotal = state.price * state.qty;
      const msg =
        `Hi ${brand}! I'd like to order:\n\n` +
        `${name}\n` +
        `Weight: ${state.weight}\n` +
        `Quantity: ${state.qty}\n` +
        `Unit price: ${fmt(state.price)}\n` +
        `Subtotal: ${fmt(subtotal)}\n\n` +
        `Please confirm availability and delivery time. Thanks!`;
      return waBase + encodeURIComponent(msg);
    };

    const render = () => {
      const subtotal = state.price * state.qty;
      if (priceEl)     priceEl.textContent     = fmt(state.price);
      if (weightEl)    weightEl.textContent    = state.weight;
      if (subtotalEl)  subtotalEl.textContent  = fmt(subtotal);
      if (stickyPrice) stickyPrice.textContent = fmt(subtotal);
      const href = buildWa();
      if (orderBtn)    orderBtn.href    = href;
      if (stickyOrder) stickyOrder.href = href;
    };

    // Weight option pills
    opts.forEach((opt) => {
      opt.addEventListener('click', () => {
        opts.forEach((o) => {
          o.classList.remove('active');
          o.setAttribute('aria-checked', 'false');
        });
        opt.classList.add('active');
        opt.setAttribute('aria-checked', 'true');
        state.weight = opt.dataset.weight;
        state.price  = parseFloat(opt.dataset.price) || 0;
        render();
      });
    });

    // Qty stepper
    const setQty = (n) => {
      n = Math.max(1, Math.min(99, n | 0));
      state.qty = n;
      if (qty) qty.value = String(n);
      render();
    };
    if (stepUp)   stepUp.addEventListener('click',   () => setQty(state.qty + 1));
    if (stepDown) stepDown.addEventListener('click', () => setQty(state.qty - 1));
    if (qty) qty.addEventListener('input', () => setQty(parseInt(qty.value || '1', 10)));

    // Tabs
    const tabs   = $$('.nv-product-tab', page);
    const panels = $$('.nv-product-tabpanel', page);
    tabs.forEach((tab) => {
      tab.addEventListener('click', () => {
        const id = tab.dataset.tab;
        tabs.forEach((t) => {
          const on = t === tab;
          t.classList.toggle('active', on);
          t.setAttribute('aria-selected', on ? 'true' : 'false');
        });
        panels.forEach((p) => {
          const on = p.dataset.panel === id;
          p.classList.toggle('active', on);
          p.hidden = !on;
        });
      });
    });

    // Rating link near the title jumps to the Reviews tab + smooth scroll (E5)
    const ratingLink = $('.nv-product-rating-link', page);
    if (ratingLink) {
      ratingLink.addEventListener('click', (e) => {
        const tab = $('#nv-tab-reviews', page);
        if (tab) { e.preventDefault(); tab.click(); tab.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
      });
    }
    // Open Reviews tab if the URL has #reviews
    if (location.hash === '#reviews') {
      const tab = $('#nv-tab-reviews', page);
      if (tab) setTimeout(() => { tab.click(); tab.scrollIntoView({ behavior: 'smooth', block: 'start' }); }, 100);
    }

    // Gallery thumbnails
    const thumbs = $$('.nv-product-thumb', page);
    const mainImg = $('.nv-product-main-img', page);
    thumbs.forEach((t) => {
      t.addEventListener('click', () => {
        thumbs.forEach((x) => x.classList.remove('active'));
        t.classList.add('active');
        if (mainImg && t.dataset.img) mainImg.src = t.dataset.img;
      });
    });

    // Share button (Web Share API → copy-link fallback → toast)
    const shareBtn = $('.nv-product-share', page);
    if (shareBtn) {
      shareBtn.addEventListener('click', async () => {
        const url = location.href;
        if (navigator.share) {
          try { await navigator.share({ title: name, text: `${name} — ${brand}`, url }); return; }
          catch (e) { /* user cancelled — fall through */ }
        }
        try { await navigator.clipboard.writeText(url); toast('Link copied to clipboard'); }
        catch (e) { toast('Could not copy link'); }
      });
    }
    function toast(msg) {
      let t = document.querySelector('.nv-toast');
      if (!t) {
        t = document.createElement('div');
        t.className = 'nv-toast';
        document.body.appendChild(t);
      }
      t.textContent = msg;
      t.classList.add('show');
      clearTimeout(toast._t);
      toast._t = setTimeout(() => t.classList.remove('show'), 2200);
    }

    render();
  })();

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
        <a class="nv-lightbox-link" target="_blank" rel="noopener" hidden></a>
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
  const lbLink   = $('.nv-lightbox-link', lightbox);

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
    if (data.link) {
      lbLink.href = data.link;
      lbLink.textContent = (data.linkLabel || 'Visit project') + ' ↗';
      lbLink.hidden = false;
    } else {
      lbLink.hidden = true;
      lbLink.removeAttribute('href');
    }
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
        link:      item.dataset.link      || '',
        linkLabel: item.dataset.linkLabel || '',
      });
    });
  });

})();
