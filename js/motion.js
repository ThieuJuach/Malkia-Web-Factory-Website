// Malkia Web Factory — motion layer: scroll reveals, counters, card
// spotlight, hero parallax and navbar state. Loaded at the end of <body>
// (not deferred) so reveal classes apply before first paint. Without JS,
// or with reduced motion, all content simply shows.
(function () {
  const reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

  // ---- Navbar: add a shadow once the page scrolls ----
  const nav = document.querySelector(".navbar.sticky-top");
  if (nav) {
    const onScroll = () => nav.classList.toggle("mk-scrolled", window.scrollY > 10);
    onScroll();
    window.addEventListener("scroll", onScroll, { passive: true });
  }

  // ---- Counters: animate [data-count] from 0 when scrolled into view ----
  const counters = document.querySelectorAll("[data-count]");
  function runCounter(el) {
    const target = Number(el.dataset.count);
    const prefix = el.dataset.prefix || "";
    const suffix = el.dataset.suffix || "";
    if (reduceMotion) {
      el.textContent = prefix + target + suffix;
      return;
    }
    const duration = 1600;
    const start = performance.now();
    const tick = (now) => {
      const t = Math.min((now - start) / duration, 1);
      const eased = 1 - Math.pow(1 - t, 3);
      el.textContent = prefix + Math.round(target * eased) + suffix;
      if (t < 1) requestAnimationFrame(tick);
    };
    requestAnimationFrame(tick);
  }

  // ---- Card spotlight: gold glow follows the cursor ----
  document.querySelectorAll(".card, .mk-stat").forEach((card) => {
    card.classList.add("mk-spot");
    card.addEventListener("pointermove", (e) => {
      const r = card.getBoundingClientRect();
      card.style.setProperty("--mx", e.clientX - r.left + "px");
      card.style.setProperty("--my", e.clientY - r.top + "px");
    });
  });

  if (reduceMotion || !("IntersectionObserver" in window)) {
    counters.forEach(runCounter);
    return;
  }

  // ---- Hero parallax: orbs, browser and chips drift with the pointer ----
  const hero = document.querySelector(".mk-hero");
  if (hero && window.matchMedia("(pointer: fine)").matches) {
    let frame = 0;
    hero.addEventListener("pointermove", (e) => {
      cancelAnimationFrame(frame);
      frame = requestAnimationFrame(() => {
        const r = hero.getBoundingClientRect();
        hero.style.setProperty("--px", ((e.clientX - r.left) / r.width - 0.5) * 2);
        hero.style.setProperty("--py", ((e.clientY - r.top) / r.height - 0.5) * 2);
      });
    });
    hero.addEventListener("pointerleave", () => {
      hero.style.setProperty("--px", 0);
      hero.style.setProperty("--py", 0);
    });
  }

  // ---- Scroll reveals: fade-up, staggered among siblings ----
  document.documentElement.classList.add("mk-motion");
  const targets = document.querySelectorAll(
    "main > section .section-eyebrow, main > section h2, main > section h3, " +
    "main > section .lead, main > section .row > [class*='col'], " +
    "main > section .accordion-item, main > section .text-center > .btn, " +
    "main > header.bg-navy .container > *"
  );
  const seen = new Set();
  targets.forEach((el) => {
    // Skip nested matches (e.g. an h3 inside an already-revealed column).
    if (el.parentElement.closest(".mk-reveal")) return;
    const siblings = [...el.parentElement.children].filter((c) => c.classList.contains("mk-reveal"));
    el.style.setProperty("--rd", Math.min(siblings.length, 6) * 90 + "ms");
    el.classList.add("mk-reveal");
    seen.add(el);
  });

  const io = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        const el = entry.target;
        io.unobserve(el);
        if (el.hasAttribute("data-count")) {
          runCounter(el);
          return;
        }
        el.classList.add("mk-in");
        // Drop reveal classes afterwards so hover transitions (cards) are normal again.
        el.addEventListener("transitionend", function done(ev) {
          if (ev.target !== el) return;
          el.classList.remove("mk-reveal", "mk-in");
          el.style.removeProperty("--rd");
          el.removeEventListener("transitionend", done);
        });
      });
    },
    { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
  );
  seen.forEach((el) => io.observe(el));
  counters.forEach((el) => {
    // HTML holds the final value (no-JS fallback); start from zero here.
    el.textContent = (el.dataset.prefix || "") + "0" + (el.dataset.suffix || "");
    io.observe(el);
  });
})();
