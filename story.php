<?php
$TITLE     = 'Our Story - Meet the team | Malkia Web Factory';
$DESC      = 'Meet the founders of Malkia Web Factory - Andrew Thieu Juach and Khot Garang - and the story behind why we build websites for mission-driven work.';
$CANONICAL = 'story.php';
$ACTIVE    = 'story';
$JSONLD    = json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'AboutPage',
    'name'     => 'Our Story - Malkia Web Factory',
    'url'      => 'https://malkiafactory.com/story.php',
    'about'    => [
        [
            '@type'    => 'Person',
            'name'     => 'Andrew Thieu Juach',
            'jobTitle' => 'Co-Founder & Lead Software Developer',
            'sameAs'   => 'https://www.linkedin.com/in/andrew-thieu-juach-0b5a00272/',
        ],
        [
            '@type'    => 'Person',
            'name'     => 'Khot Garang',
            'jobTitle' => 'Co-Founder & Business Development',
            'sameAs'   => 'https://www.linkedin.com/in/khot-garang-613477330/',
        ],
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
                    <div class="section-eyebrow mb-2">Our Story</div>
                    <h1 class="fw-bolder text-white mb-3">The people behind Malkia Web Factory</h1>
                    <p class="lead text-white-50 mb-0">Two co-founders, one belief: meaningful work deserves a website that does it justice.</p>
                </div>
            </header>
            <!-- Team-->
            <section class="py-5 bg-white">
                <div class="container px-5">
                    <div class="text-center mb-5">
                        <div class="section-eyebrow mb-2">The Team</div>
                        <h2 class="fw-bolder text-primary">Meet the founders</h2>
                    </div>
                    <div class="row gx-5 gy-4 justify-content-center">
                        <!-- Andrew -->
                        <div class="col-md-6 col-lg-5">
                            <div class="card border-0 shadow-sm h-100 rounded-4 text-center p-4">
                                <div class="card-body">
                                    <div class="feature mk mb-3 mx-auto" style="height:4rem;width:4rem;font-size:1.75rem;"><i class="bi bi-person-workspace"></i></div>
                                    <h5 class="fw-bolder mb-1">Andrew Juach</h5>
                                    <div class="text-gold fw-bold small text-uppercase mb-2" style="letter-spacing:.08em;">Founder &amp; Lead Software Developer</div>
                                    <p class="text-muted small mb-3">BSc. Applied Computer Technology Graduate</p>
                                    <a class="btn btn-outline-dark btn-sm px-3 fw-bolder" href="https://www.linkedin.com/in/andrew-thieu-juach-0b5a00272/" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i> LinkedIn</a>
                                </div>
                            </div>
                        </div>
                        <!-- Khot -->
                        <div class="col-md-6 col-lg-5">
                            <div class="card border-0 shadow-sm h-100 rounded-4 text-center p-4">
                                <div class="card-body">
                                    <div class="feature mk mb-3 mx-auto" style="height:4rem;width:4rem;font-size:1.75rem;"><i class="bi bi-briefcase"></i></div>
                                    <h5 class="fw-bolder mb-1">Khot Garang</h5>
                                    <div class="text-gold fw-bold small text-uppercase mb-2" style="letter-spacing:.08em;">Co-Founder &amp; Business Development</div>
                                    <p class="text-muted small mb-3">BSc. Computer Science Student</p>
                                    <a class="btn btn-outline-dark btn-sm px-3 fw-bolder" href="https://www.linkedin.com/in/khot-garang-613477330/" target="_blank" rel="noopener"><i class="bi bi-linkedin"></i> LinkedIn</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Our Story-->
            <section class="py-5 has-watermark" id="story">
                <div class="container px-5 position-relative">
                    <div class="row justify-content-center">
                        <div class="col-lg-9">
                            <div class="section-eyebrow mb-2 text-center">Our Story</div>
                            <h2 class="fw-bolder text-primary mb-4 text-center">How Malkia Web Factory began</h2>
                            <!--<p class="lead fw-normal text-muted mb-4">Malkia Web Factory started with a simple frustration shared over late-night conversations: too much important work goes unseen because it has nowhere good to live online.</p>
                            <!--<p class="text-muted mb-4">Andrew Thieu Juach and Khot Garang met as students navigating the same world of research, community projects, and organizations doing meaningful work. Andrew, an Applied Computer Technology graduate, spent his time building software and quietly helping friends, professors, and small organizations fix broken or outdated websites. Khot, a Computer Science student with a sharp eye for people and opportunity, kept noticing the same pattern from the other side — brilliant researchers and dedicated non-profits whose online presence didn't come close to reflecting the value of what they actually did.</p>-->
                            <!--<p class="text-muted mb-4">The two realized they were solving the same problem from different angles. Andrew could build fast, custom, maintainable websites without the bloat of page builders and templates. Khot understood how to listen to an organization's mission, translate it into a clear story, and connect the right people to the right work. Together, they saw a gap: mission-driven organizations — researchers, NGOs, non-profits, and refugee-led initiatives — needed a partner who could make them look as credible online as they were in reality.</p>-->
                            <p class="text-muted mb-4">So we founded Malkia Web Factory - a studio built on the belief that a website should be a faithful, professional home for meaningful work, not an afterthought. The name reflects that ambition: "Malkia" means <em>queen</em> in Swahili, a nod to craftsmanship, dignity, and building things that carry themselves with quality and last.</p>
                            <p class="text-muted mb-0">Today, that mission is the same as the day it started: turn complex, important work into clear, modern websites that are easy to navigate and built to last - so the right people can finally find you.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- CTA-->
            <section class="py-5 bg-navy">
                <div class="container px-5 text-center">
                    <h2 class="fw-bolder mb-3 text-white">Want to work with us?</h2>
                    <p class="lead text-white-50 mb-4">Tell us about your work and we'll get back within 24 hours with a clear plan.</p>
                    <a class="btn btn-primary btn-lg px-5 py-3 fw-bolder" href="contact.php">Start Your Website</a>
                </div>
            </section>
        </main>
        <?php include __DIR__ . '/includes/footer.php'; ?>
    </body>
</html>
