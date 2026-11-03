/* Custom Closet Guys test site: shared behaviour. No dependencies. */
(function () {
  // Mobile nav
  var toggle = document.querySelector('.nav-toggle');
  var nav = document.querySelector('.nav');
  if (toggle && nav) {
    toggle.addEventListener('click', function () {
      var open = nav.classList.toggle('open');
      toggle.setAttribute('aria-expanded', open ? 'true' : 'false');
    });
  }

  // Header links to home page sections: close the mobile menu after a tap.
  if (nav) {
    nav.addEventListener('click', function (e) {
      if (e.target.closest('a')) { nav.classList.remove('open'); if (toggle) toggle.setAttribute('aria-expanded', 'false'); }
    });
  }

  // Arriving from another page on a #section link: land on the section again once fonts and
  // images have loaded, since they push it down after the browser's first jump.
  if (location.hash && /^#[\w-]+$/.test(location.hash)) {
    var userMoved = false;
    ['wheel', 'touchstart', 'keydown'].forEach(function (ev) {
      window.addEventListener(ev, function () { userMoved = true; }, { once: true, passive: true });
    });
    var landOnHash = function () {
      if (userMoved) return; // never pull the page away from someone already scrolling
      var el = document.getElementById(location.hash.slice(1));
      if (el) el.scrollIntoView();
    };
    window.addEventListener('load', function () {
      landOnHash();
      setTimeout(landOnHash, 400);
      setTimeout(landOnHash, 1200);
    });
    if (document.fonts && document.fonts.ready) document.fonts.ready.then(landOnHash);
  }

  // Toggle chips (feature picks in the studio preview)
  document.querySelectorAll('[data-chips] .chip').forEach(function (chip) {
    chip.addEventListener('click', function () {
      chip.classList.toggle('on');
      chip.setAttribute('aria-pressed', chip.classList.contains('on') ? 'true' : 'false');
    });
  });

  // Single-choice pills (space type, gallery filters)
  document.querySelectorAll('[data-pills]').forEach(function (group) {
    group.addEventListener('click', function (e) {
      var pill = e.target.closest('.pill');
      if (!pill) return;
      group.querySelectorAll('.pill').forEach(function (p) { p.classList.toggle('on', p === pill); });
      group.dispatchEvent(new CustomEvent('pick', { detail: pill.dataset.value }));
    });
  });

  // Photo upload preview (stays in the browser until the real designer is connected)
  document.querySelectorAll('.upload input[type=file]').forEach(function (input) {
    input.addEventListener('change', function () {
      var file = input.files && input.files[0];
      if (!file) return;
      var box = input.closest('.upload');
      var img = box.querySelector('img') || box.insertBefore(document.createElement('img'), box.firstChild);
      img.src = URL.createObjectURL(file);
      img.alt = 'Your uploaded space';
      var tag = box.querySelector('.tag');
      if (tag) tag.textContent = 'Your photo';
    });
  });

  // Studio space switch: closet vs garage feature lists
  var space = document.querySelector('[data-space]');
  if (space) {
    space.addEventListener('pick', function (e) {
      document.querySelectorAll('[data-for-space]').forEach(function (el) {
        el.hidden = el.dataset.forSpace !== e.detail;
      });
    });
  }

  // Forms: show a confirmation. Wire to WordPress / email on the live build.
  document.querySelectorAll('form[data-demo]').forEach(function (form) {
    form.addEventListener('submit', function (e) {
      e.preventDefault();
      var done = form.parentElement.querySelector('.form-done');
      if (done) { done.classList.add('show'); done.focus && done.focus(); }
      form.reset();
    });
  });

  // Gallery filters and lightbox
  var gal = document.querySelector('[data-gallery]');
  if (gal) {
    var filters = document.querySelector('[data-filters]');
    if (filters) {
      filters.addEventListener('pick', function (e) {
        gal.querySelectorAll('figure').forEach(function (f) {
          f.hidden = !(e.detail === 'all' || f.dataset.type === e.detail);
        });
      });
    }
    var lb = document.querySelector('.lightbox');
    gal.addEventListener('click', function (e) {
      var b = e.target.closest('button');
      if (!b || !lb) return;
      var img = b.querySelector('img');
      lb.querySelector('img').src = img.src;
      lb.querySelector('img').alt = img.alt;
      lb.classList.add('open');
    });
    if (lb) {
      lb.addEventListener('click', function (e) { if (e.target === lb || e.target.tagName === 'BUTTON') lb.classList.remove('open'); });
      document.addEventListener('keydown', function (e) { if (e.key === 'Escape') lb.classList.remove('open'); });
    }
  }

  // Accessories page
  var accRoot = document.querySelector('[data-accessories]');
  if (accRoot && window.CCG_ACCESSORIES) {
    var data = window.CCG_ACCESSORIES;
    var jump = document.querySelector('[data-jump]');
    data.categories.forEach(function (cat) {
      var items = data.products.filter(function (p) { return p.category === cat.id; });
      if (!items.length) return;
      if (jump) {
        var a = document.createElement('a');
        a.className = 'pill'; a.href = '#' + cat.id; a.textContent = cat.name + ' (' + items.length + ')';
        jump.appendChild(a);
      }
      var sec = document.createElement('section');
      sec.className = 'acc-cat'; sec.id = cat.id;
      sec.innerHTML = '<header><h2 style="font-size:32px"></h2><p></p></header><div class="acc-grid"></div>';
      sec.querySelector('h2').textContent = cat.name;
      sec.querySelector('p').textContent = cat.blurb;
      var grid = sec.querySelector('.acc-grid');
      items.forEach(function (p) {
        var card = document.createElement('a');
        card.className = 'product'; card.href = p.url; card.target = '_blank';
        card.rel = 'sponsored noopener';
        card.innerHTML = '<div class="img"><img loading="lazy" alt=""></div><div class="body"><h3></h3><p></p><span class="link-arrow go">View on Amazon</span></div>';
        card.querySelector('img').src = p.image;
        card.querySelector('img').alt = p.name;
        card.querySelector('h3').textContent = p.name;
        card.querySelector('p').textContent = p.note;
        grid.appendChild(card);
      });
      accRoot.appendChild(sec);
    });
  }

  // Live designer: replaces the concept preview once a designer URL is set.
  var slot = document.querySelector('[data-designer]');
  if (slot && window.CCG_DESIGNER_URL) {
    try {
      var dUrl = new URL(window.CCG_DESIGNER_URL, location.href);
      dUrl.searchParams.set('embed', '1');
      var frame = document.createElement('iframe');
      frame.src = dUrl.toString();
      frame.title = 'Closet designer';
      frame.style.cssText = 'display:block;width:100%;height:1100px;border:0;background:transparent';
      slot.innerHTML = '';
      slot.appendChild(frame);
      window.addEventListener('message', function (e) {
        if (e.origin === dUrl.origin && e.data && e.data.type === 'designer-height') {
          frame.style.height = Math.max(600, Number(e.data.height) || 0) + 'px';
        }
      });
    } catch (err) { /* bad URL: keep the concept preview */ }
  }

  // Footer year
  document.querySelectorAll('[data-year]').forEach(function (el) { el.textContent = new Date().getFullYear(); });
})();
