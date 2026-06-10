(function () {
  'use strict';

  // Sticky nav style on scroll
  var nav = document.getElementById('nv-nav');
  if (nav) {
    window.addEventListener('scroll', function () {
      if (window.scrollY > 20) {
        nav.classList.add('scrolled');
      } else {
        nav.classList.remove('scrolled');
      }
    });
  }

  // Mobile menu toggle (glass panel)
  var toggle = document.getElementById('nv-toggle');
  var panel = document.getElementById('nv-menu-panel');
  if (toggle && panel) {
    var setOpen = function (open) {
      panel.classList.toggle('open', open);
      toggle.classList.toggle('open', open);
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
      document.body.classList.toggle('nv-menu-open', open);
    };
    toggle.addEventListener('click', function () {
      setOpen(!panel.classList.contains('open'));
    });
    panel.addEventListener('click', function (e) {
      if (e.target.tagName === 'A') {
        setOpen(false);
      }
    });
    document.addEventListener('keydown', function (e) {
      if (e.key === 'Escape') {
        setOpen(false);
      }
    });
  }

  // Scroll reveal entrance animations
  var reveals = document.querySelectorAll('.nv-reveal');
  if ('IntersectionObserver' in window && reveals.length) {
    var observer = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          entry.target.classList.add('in');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });
    reveals.forEach(function (el) { observer.observe(el); });
  } else {
    reveals.forEach(function (el) { el.classList.add('in'); });
  }

  // Portfolio filter tabs (front-end only visual)
  var tabs = document.querySelectorAll('.nv-tabp');
  tabs.forEach(function (tab) {
    tab.addEventListener('click', function () {
      tabs.forEach(function (t) { t.classList.remove('active'); });
      tab.classList.add('active');
    });
  });
})();
