<?php
$TITLE     = 'What We Do - Services, Process & Pricing | Malkia Web Factory';
$DESC      = 'What we do, our process, pricing packages, and frequently asked questions at Malkia Web Factory.';
$CANONICAL = 'resume.php';
$ACTIVE    = 'services';
$JSONLD    = json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => [
        ['@type'=>'Question','name'=>"I'm not technical - do I need to know anything about web design?",'acceptedAnswer'=>['@type'=>'Answer','text'=>'Not at all. We handle everything - design, structure, code, hosting setup, SEO. You just share your content and feedback.']],
        ['@type'=>'Question','name'=>'How long does a project usually take?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Starter sites take 1–2 weeks. Standard sites take 2–4 weeks. Larger lab or institution sites take 4–8 weeks depending on scope.']],
        ['@type'=>'Question','name'=>'Can I update the website myself after launch?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Yes. Standard and Advanced packages include a simple CMS dashboard so you can add publications, news, and team members on your own.']],
        ['@type'=>'Question','name'=>'Do you provide hosting?','acceptedAnswer'=>['@type'=>'Answer','text'=>'Yes. We can host your website for you, or guide you in setting up your own reliable, low-cost hosting. Either way, you retain full ownership.']],
        ['@type'=>'Question','name'=>'What if I already have a website?','acceptedAnswer'=>['@type'=>'Answer','text'=>'We can rebuild, restructure, or migrate your existing content. Most sites we work on are redesigns of outdated or abandoned pages.']],
        ['@type'=>'Question','name'=>'Do you work with non-English content?','acceptedAnswer'=>['@type'=>'Answer','text'=>"Yes. We've built multilingual sites and can structure content for international audiences."]],
    ],
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
            <!-- Page header-->
            <header class="py-5 bg-navy">
                <div class="container px-5 text-center">
                    <div class="section-eyebrow mb-2">Services</div>
                    <h1 class="fw-bolder text-white mb-3">What we do &amp; how we work</h1>
                    <p class="lead text-white-50 mb-0">From first conversation to launch - clear process, honest pricing, real answers.</p>
                </div>
            </header>
            <!-- What we do-->
            <section class="py-5 bg-white">
                <div class="container px-5">
                    <div class="text-center mb-5">
                        <div class="section-eyebrow mb-2">What We Do</div>
                        <h2 class="fw-bolder text-primary">We turn your mission into a structured, easy-to-navigate website</h2>
                        <p class="text-muted mx-auto" style="max-width: 720px;">Most organizations either don't have a website or rely on outdated pages that don't reflect the quality of their work. We fix that - turning your mission, projects, and profile into a clear digital home.</p>
                    </div>
                    <div class="row gy-4">
                        <div class="col-md-6 col-lg-3 text-center">
                            <div class="feature mk mb-3 mx-auto"><i class="bi bi-layout-text-window-reverse"></i></div>
                            <h6 class="fw-bolder">Clearly presents your work</h6>
                            <p class="text-muted small">Publications, projects, and mission organized so visitors understand what you do.</p>
                        </div>
                        <div class="col-md-6 col-lg-3 text-center">
                            <div class="feature mk mb-3 mx-auto"><i class="bi bi-graph-up-arrow"></i></div>
                            <h6 class="fw-bolder">Visibility &amp; credibility</h6>
                            <p class="text-muted small">SEO-optimized structure helps partners, funders, and press find you.</p>
                        </div>
                        <div class="col-md-6 col-lg-3 text-center">
                            <div class="feature mk mb-3 mx-auto"><i class="bi bi-search-heart"></i></div>
                            <h6 class="fw-bolder">Easy for funders to find you</h6>
                            <p class="text-muted small">A professional presence that signals quality, focus, and longevity.</p>
                        </div>
                        <div class="col-md-6 col-lg-3 text-center">
                            <div class="feature mk mb-3 mx-auto"><i class="bi bi-code-slash"></i></div>
                            <h6 class="fw-bolder">Custom code, no bloat</h6>
                            <p class="text-muted small">Hand-built, fast, and maintainable - no page builders, no template debt.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Process-->
            <section class="py-5">
                <div class="container px-5">
                    <div class="text-center mb-5">
                        <div class="section-eyebrow mb-2">Process</div>
                        <h2 class="fw-bolder text-primary">How it works</h2>
                    </div>
                    <div class="row gy-4">
                        <div class="col-md-6 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 rounded-4 p-4">
                                <div class="step-num mb-3">01</div>
                                <h5 class="fw-bolder">We talk</h5>
                                <p class="text-muted mb-0 small">You tell us about your work, your audience, and what you need. We figure out the right approach together.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 rounded-4 p-4">
                                <div class="step-num mb-3">02</div>
                                <h5 class="fw-bolder">We organize</h5>
                                <p class="text-muted mb-0 small">We take your content - projects, publications, team profiles, and mission - and structure it so visitors can navigate it.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 rounded-4 p-4">
                                <div class="step-num mb-3">03</div>
                                <h5 class="fw-bolder">We build</h5>
                                <p class="text-muted mb-0 small">We code the site, make it responsive, and optimize it for speed. You review and we adjust until you're happy.</p>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-3">
                            <div class="card border-0 shadow-sm h-100 rounded-4 p-4">
                                <div class="step-num mb-3">04</div>
                                <h5 class="fw-bolder">We launch</h5>
                                <p class="text-muted mb-0 small">Final checks, SEO setup, and deployment. We hand everything over and stick around for support.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Pricing-->
            <section class="py-5 bg-white">
                <div class="container px-5">
                    <div class="text-center mb-5">
                        <div class="section-eyebrow mb-2">Services &amp; Pricing</div>
                        <h2 class="fw-bolder text-primary">Pick the package that fits your work</h2>
                    </div>
                    <div class="row gy-4 justify-content-center">
                        <div class="col-lg-4">
                            <div class="card price-card border-0 shadow-sm h-100 rounded-4 p-4">
                                <div class="text-muted text-uppercase small fw-bolder">One-Page Site</div>
                                <h4 class="fw-bolder mt-1">Starter</h4>
                                <div class="price-tag fs-3 my-3">$300 – $500</div>
                                <ul class="list-unstyled text-muted mb-4">
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Clean profile or org site</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Projects or publications section</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Mobile responsive</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Basic SEO</li>
                                </ul>
                                <a class="btn btn-outline-dark mt-auto fw-bolder" href="contact.php">Get started</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card price-card popular border-0 shadow h-100 rounded-4 p-4 position-relative">
                                <span class="badge bg-gradient-primary-to-secondary text-white position-absolute top-0 start-50 translate-middle px-3 py-2">Most popular</span>
                                <div class="text-muted text-uppercase small fw-bolder">Multi-Page Site</div>
                                <h4 class="fw-bolder mt-1">Standard</h4>
                                <div class="price-tag fs-3 my-3">$800 – $1,500</div>
                                <ul class="list-unstyled text-muted mb-4">
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Home, About, Work, Publications</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Structured content</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>CMS dashboard</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Full SEO optimization</li>
                                </ul>
                                <a class="btn btn-primary mt-auto fw-bolder" href="contact.php">Get started</a>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="card price-card border-0 shadow-sm h-100 rounded-4 p-4">
                                <div class="text-muted text-uppercase small fw-bolder">Labs &amp; Institutions</div>
                                <h4 class="fw-bolder mt-1">Advanced</h4>
                                <div class="price-tag fs-3 my-3">Custom</div>
                                <ul class="list-unstyled text-muted mb-4">
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Full website system</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Team pages</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Projects &amp; impact</li>
                                    <li class="mb-2"><i class="bi bi-check2 text-gold me-2"></i>Custom features</li>
                                </ul>
                                <a class="btn btn-outline-dark mt-auto fw-bolder" href="contact.php">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- FAQ-->
            <section class="py-5">
                <div class="container px-5">
                    <div class="text-center mb-5">
                        <div class="section-eyebrow mb-2">FAQ</div>
                        <h2 class="fw-bolder text-primary">Common questions</h2>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="accordion" id="faqAccordion">
                                <div class="accordion-item border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">I'm not technical - do I need to know anything about web design?</button></h2>
                                    <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted">Not at all. We handle everything - design, structure, code, hosting setup, SEO. You just share your content and feedback.</div></div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">How long does a project usually take?</button></h2>
                                    <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted">Starter sites take 1–2 weeks. Standard sites take 2–4 weeks. Larger lab or institution sites take 4–8 weeks depending on scope.</div></div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">Can I update the website myself after launch?</button></h2>
                                    <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted">Yes. Standard and Advanced packages include a simple CMS dashboard so you can add publications, news, and team members on your own.</div></div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">Do you provide hosting?</button></h2>
                                    <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted">Yes, we do. We can host your website for you and ensure it runs smoothly. Alternatively, if you prefer full control, we'll guide you step-by-step in setting up your own reliable, low-cost hosting. Either way, you retain full ownership of your platform.</div></div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm mb-3 rounded-4 overflow-hidden">
                                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">What if I already have a website?</button></h2>
                                    <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted">We can rebuild, restructure, or migrate your existing content. Most sites we work on are redesigns of outdated or abandoned pages.</div></div>
                                </div>
                                <div class="accordion-item border-0 shadow-sm rounded-4 overflow-hidden">
                                    <h2 class="accordion-header"><button class="accordion-button collapsed fw-bolder" type="button" data-bs-toggle="collapse" data-bs-target="#faq6">Do you work with non-English content?</button></h2>
                                    <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion"><div class="accordion-body text-muted">Yes. We've built multilingual sites and can structure content for international audiences.</div></div>
                                </div>
                            </div>
                        </div>
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
