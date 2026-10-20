<?php
$TITLE     = 'Malkia Web Factory - Custom websites for meaningful work';
$DESC      = 'Malkia Web Factory designs and builds custom, professional websites for researchers, NGOs, non-profits, and mission-driven organizations.';
$CANONICAL = 'index.php';
$ACTIVE    = 'home';
$JSONLD    = json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'Organization',
    'name'     => 'Malkia Web Factory',
    'url'      => 'https://malkiafactory.com',
    'email'    => 'hello@malkiafactory.com',
    'logo'     => 'https://malkiafactory.com/assets/logo.png',
    'description' => 'Custom, professional websites for researchers, NGOs, non-profits, and mission-driven organizations.',
    'sameAs'   => ['https://www.linkedin.com/company/malkia-web-factory'],
], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include __DIR__ . '/includes/head.php'; ?>
    </head>
    <body class="d-flex flex-column h-100">
        <main class="flex-shrink-0">
            <?php include __DIR__ . '/includes/nav.php'; ?>
            <!-- Header / Landing-->
            <header class="mk-hero">
                <div class="mk-orb mk-orb-1"></div>
                <div class="mk-orb mk-orb-2"></div>
                <div class="mk-orb mk-orb-3"></div>
                <div class="mk-grid"></div>
                <div class="container px-5">
                    <div class="row gx-5 align-items-center">
                        <div class="col-xxl-6">
                            <div class="text-center text-xxl-start">
                                <div class="mk-pill mb-4 mk-rise" style="--i:0"><span class="mk-dot"></span>Custom-coded &middot; No templates &middot; Built to last</div>
                                <div class="fs-3 fw-light mk-muted mk-rise" style="--i:1">Turning complex work into</div>
                                <h1 class="display-3 fw-bolder mb-4 mk-rise" style="--i:2"><span class="text-shine d-inline">clear, professional websites</span></h1>
                                <p class="lead fw-normal mb-4 mk-rise" style="--i:3">We help researchers, NGOs, non-profits, and mission-driven organizations turn complex work into clear, modern websites that are easy to navigate and built to last.</p>
                                <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xxl-start mb-4 mk-rise" style="--i:4">
                                    <a class="btn btn-primary btn-lg px-5 py-3 me-sm-3 fs-6 fw-bolder" href="contact.php">Start Your Website <i class="bi bi-arrow-right"></i></a>
                                    <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="projects.php">See our work</a>
                                </div>
                                <div class="d-flex flex-wrap gap-4 justify-content-center justify-content-xxl-start mk-muted small mk-rise" style="--i:5">
                                    <span><i class="bi bi-check2 text-gold"></i> Custom-coded</span>
                                    <span><i class="bi bi-check2 text-gold"></i> No templates</span>
                                    <span><i class="bi bi-check2 text-gold"></i> Built to last</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6">
                            <!-- Motion graphic: scattered pieces assemble into a clean site, get "clicked", go live, repeat -->
                            <div class="mk-stage mt-5 mt-xxl-0 mk-rise" style="--i:3" aria-hidden="true">
                                <div class="mk-browser">
                                    <div class="mk-browser-bar"><span></span><span></span><span></span><div class="mk-url">your-work.org</div></div>
                                    <div class="mk-canvas">
                                        <div class="mk-block b-nav" style="--sx:-70px;--sy:-50px;--sr:-14deg;--d:0s"><img src="assets/logo.png" alt="" /><i></i><i></i><i></i></div>
                                        <div class="mk-block b-title" style="--sx:-110px;--sy:30px;--sr:18deg;--d:.08s"></div>
                                        <div class="mk-block b-line" style="--sx:60px;--sy:-70px;--sr:-24deg;--d:.16s"></div>
                                        <div class="mk-block b-short" style="--sx:-40px;--sy:90px;--sr:30deg;--d:.2s"></div>
                                        <div class="mk-block b-btn" style="--sx:90px;--sy:60px;--sr:-35deg;--d:.26s"></div>
                                        <div class="mk-block b-img" style="--sx:80px;--sy:-30px;--sr:12deg;--d:.12s"></div>
                                        <div class="mk-cards">
                                            <div class="mk-block b-card" style="--sx:-60px;--sy:70px;--sr:-20deg;--d:.3s"></div>
                                            <div class="mk-block b-card" style="--sx:10px;--sy:110px;--sr:26deg;--d:.36s"></div>
                                            <div class="mk-block b-card" style="--sx:70px;--sy:80px;--sr:-16deg;--d:.42s"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mk-cursor"><i class="bi bi-cursor-fill"></i></div>
                                <div class="mk-chip c1"><i class="bi bi-phone"></i> Mobile-first</div>
                                <div class="mk-chip c2"><i class="bi bi-graph-up-arrow"></i> SEO-ready</div>
                                <div class="mk-chip c3"><i class="bi bi-code-slash"></i> Custom code</div>
                                <div class="mk-chip c-live"><i class="bi bi-check-circle-fill"></i> Live &amp; built to last</div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Audience marquee -->
                <div class="mk-marquee" aria-label="Who we build for">
                    <div class="mk-marquee-track">
                        <div class="mk-marquee-group"><span>Researchers</span><span>Professors</span><span>NGOs</span><span>Non-profits</span><span>Refugee-led organizations</span><span>Labs</span><span>Institutions</span><span>Community-led organizations</span></div>
                        <div class="mk-marquee-group" aria-hidden="true"><span>Researchers</span><span>Professors</span><span>NGOs</span><span>Non-profits</span><span>Refugee-led organizations</span><span>Labs</span><span>Institutions</span><span>Community-led organizations</span></div>
                    </div>
                </div>
            </header>
            <!-- About-->
            <section class="py-5 bg-white has-watermark" id="about">
                <div class="container px-5 position-relative">
                    <div class="row gx-5 align-items-center">
                        <div class="col-lg-6 mb-5 mb-lg-0">
                            <div class="section-eyebrow mb-2">About</div>
                            <h2 class="fw-bolder text-primary mb-4">About Malkia Web Factory</h2>
                            <p class="lead fw-normal text-muted mb-4">Malkia Web Factory is a web development studio focused on helping organizations with meaningful work build a digital presence.</p>
                            <p class="text-muted mb-4">We understand the gap between meaningful work and the web. Whether you're a researcher, an NGO, or a community-led organization, the challenge is the same: important work that most websites fail to communicate clearly. Our job is to bridge that gap, structuring and presenting your work in a way that is both professional and accessible.</p>
                            <p class="text-muted mb-0">We work with researchers, professors, NGOs, non-profits, refugee-led organizations, and institutions, delivering websites that are simple, reliable, and built for long-term use.</p>
                        </div>
                        <div class="col-lg-6">
                            <div class="section-eyebrow mb-2">What We Do</div>
                            <h3 class="fw-bolder text-primary mb-4">We design and build custom websites for researchers, non-profits, and mission-driven organizations.</h3>
                            <div class="row gy-4">
                                <div class="col-md-6">
                                    <div class="feature mk mb-3"><i class="bi bi-layout-text-window-reverse"></i></div>
                                    <h6 class="fw-bolder">Clearly presents your work</h6>
                                    <p class="text-muted small mb-0">Publications, projects, and mission organized so visitors actually understand what you do.</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature mk mb-3"><i class="bi bi-graph-up-arrow"></i></div>
                                    <h6 class="fw-bolder">Improves visibility &amp; credibility</h6>
                                    <p class="text-muted small mb-0">SEO-optimized structure helps the right people find you - partners, funders, collaborators, and press.</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature mk mb-3"><i class="bi bi-search-heart"></i></div>
                                    <h6 class="fw-bolder">Easy for funders to find you</h6>
                                    <p class="text-muted small mb-0">A professional digital home that signals quality, focus, and longevity.</p>
                                </div>
                                <div class="col-md-6">
                                    <div class="feature mk mb-3"><i class="bi bi-code-slash"></i></div>
                                    <h6 class="fw-bolder">Custom code, no bloat</h6>
                                    <p class="text-muted small mb-0">Hand-built, fast, and maintainable - no page builders, no template debt.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Stats (figures come from the site's own copy: response time, process, pricing) -->
            <section class="py-5 mk-stats">
                <div class="container px-5 py-4">
                    <div class="text-center mb-5">
                        <div class="section-eyebrow mb-2">By the numbers</div>
                        <h2 class="fw-bolder text-white">Clear process, honest pricing</h2>
                    </div>
                    <div class="row gy-4">
                        <div class="col-6 col-lg-3"><div class="mk-stat"><div class="mk-stat-num text-shine" data-count="24" data-suffix="h">24h</div><div class="mk-stat-label">Reply to every enquiry</div></div></div>
                        <div class="col-6 col-lg-3"><div class="mk-stat"><div class="mk-stat-num text-shine" data-count="100" data-suffix="%">100%</div><div class="mk-stat-label">Hand-written code, no page builders</div></div></div>
                        <div class="col-6 col-lg-3"><div class="mk-stat"><div class="mk-stat-num text-shine" data-count="4">4</div><div class="mk-stat-label">Steps from first talk to launch</div></div></div>
                        <div class="col-6 col-lg-3"><div class="mk-stat"><div class="mk-stat-num text-shine" data-count="300" data-prefix="$">$300</div><div class="mk-stat-label">Starter sites from</div></div></div>
                    </div>
                </div>
            </section>
            <!-- Selected Work-->
            <section class="py-5" id="work">
                <div class="container px-5">
                    <div class="text-center mb-5">
                        <div class="section-eyebrow mb-2">Selected Work</div>
                        <h2 class="fw-bolder text-primary">Sites we've built for researchers, organizations, and institutions</h2>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-5 mb-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img class="card-img-top" src="assets/portfolio-rey-koslowski.jpg" alt="Rey Koslowski Website landing page screenshot" loading="lazy" />
                                <div class="card-body p-4">
                                    <h5 class="fw-bolder">Rey Koslowski Website</h5>
                                    <p class="text-muted">Academic profile with publications and research focus.</p>
                                    <a class="fw-bolder text-decoration-none text-gold" href="https://reykoslowski.com/" target="_blank" rel="noopener">Preview site <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 mb-4">
                            <div class="card border-0 shadow-sm h-100 rounded-4 overflow-hidden">
                                <img class="card-img-top" src="assets/portfolio-meisir.jpg" alt="Meisir Platform landing page screenshot" loading="lazy" />
                                <div class="card-body p-4">
                                    <h5 class="fw-bolder">Meisir Platform</h5>
                                    <p class="text-muted">Informational and structured content system.</p>
                                    <a class="fw-bolder text-decoration-none text-gold" href="https://meisir.org/" target="_blank" rel="noopener">Preview site <i class="bi bi-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="text-center mt-4">
                        <a class="btn btn-outline-dark px-5 py-3 fw-bolder" href="projects.php">See more selected work <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </section>
            <!-- CTA-->
            <section class="py-5 bg-navy">
                <div class="container px-5 text-center">
                    <h2 class="fw-bolder mb-3 text-white">Ready for a website that does justice to your work?</h2>
                    <p class="lead text-white-50 mb-4">Tell us a bit about your work and we'll get back within 24 hours with a clear plan.</p>
                    <a class="btn btn-primary btn-lg px-5 py-3 fw-bolder" href="contact.php">Start Your Website</a>
                </div>
            </section>
        </main>
        <?php include __DIR__ . '/includes/footer.php'; ?>
    </body>
</html>
