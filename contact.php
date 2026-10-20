<?php
$TITLE     = 'Contact - Start your website | Malkia Web Factory';
$DESC      = "Get in touch with Malkia Web Factory. Tell us about your project and we'll reply within 24 hours.";
$CANONICAL = 'contact.php';
$ACTIVE    = 'contact';
$JSONLD    = json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'ContactPage',
    'name'     => 'Contact Malkia Web Factory',
    'url'      => 'https://malkiafactory.com/contact.php',
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
                    <div class="section-eyebrow mb-2">Contact</div>
                    <h1 class="fw-bolder text-white mb-3">Start your website</h1>
                    <p class="lead text-white-50 mb-0">Tell us a bit about your work and we'll get back within 24 hours with a clear plan.</p>
                </div>
            </header>
            <!-- Contact-->
            <section class="py-5 bg-white">
                <div class="container px-5">
                    <div class="row gx-5">
                        <!-- Contact details-->
                        <div class="col-lg-5 mb-5 mb-lg-0">
                            <h2 class="fw-bolder text-primary mb-4">Get in touch</h2>
                            <p class="text-muted mb-4">Whether you're a researcher, an NGO, or a mission-driven organization, we'd love to hear about your project.</p>
                            <div class="d-flex mb-4">
                                <div class="contact-icon me-3"><i class="bi bi-envelope"></i></div>
                                <div>
                                    <h6 class="fw-bolder mb-1">Email</h6>
                                    <a class="text-decoration-none text-muted" href="mailto:hello@malkiafactory.com">hello@malkiafactory.com</a>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="contact-icon me-3"><i class="bi bi-globe"></i></div>
                                <div>
                                    <h6 class="fw-bolder mb-1">Website</h6>
                                    <a class="text-decoration-none text-muted" href="https://malkiafactory.com" target="_blank" rel="noopener">malkiafactory.com</a>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="contact-icon me-3"><i class="bi bi-clock"></i></div>
                                <div>
                                    <h6 class="fw-bolder mb-1">Response time</h6>
                                    <span class="text-muted">Within 24 hours</span>
                                </div>
                            </div>
                            <div class="d-flex mb-4">
                                <div class="contact-icon me-3"><i class="bi bi-linkedin"></i></div>
                                <div>
                                    <h6 class="fw-bolder mb-1">LinkedIn</h6>
                                    <a class="text-decoration-none text-muted" href="https://www.linkedin.com/company/malkia-web-factory" target="_blank" rel="noopener">Malkia Web Factory</a>
                                </div>
                            </div>
                        </div>
                        <!-- Contact form-->
                        <div class="col-lg-7">
                            <div class="card border-0 shadow-sm rounded-4 p-4 p-md-5">
                                <div id="formAlert"></div>
                                <form id="contactForm" action="send.php" method="post" novalidate>
                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <label class="form-label fw-bolder small" for="name">Name</label>
                                            <input class="form-control" id="name" name="name" type="text" placeholder="Your name" maxlength="100" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bolder small" for="email">Email</label>
                                            <input class="form-control" id="email" name="email" type="email" placeholder="you@example.com" maxlength="255" required />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bolder small" for="organization">Organization</label>
                                            <input class="form-control" id="organization" name="organization" type="text" placeholder="Organization (optional)" maxlength="150" />
                                        </div>
                                        <div class="col-md-6">
                                            <label class="form-label fw-bolder small" for="budget">Budget</label>
                                            <select class="form-select" id="budget" name="budget">
                                                <option value="">Select a range (optional)</option>
                                                <option>$300 – $500 (Starter)</option>
                                                <option>$800 – $1,500 (Standard)</option>
                                                <option>Custom (Advanced)</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label fw-bolder small" for="message">Tell us about your project</label>
                                            <textarea class="form-control" id="message" name="message" rows="5" maxlength="5000" placeholder="What do you do, who is your audience, and what do you need?" required></textarea>
                                        </div>
                                        <!-- Honeypot anti-spam field -->
                                        <input type="text" name="website" class="d-none" tabindex="-1" autocomplete="off" aria-hidden="true" />
                                        <div class="col-12">
                                            <button class="btn btn-primary btn-lg px-5 py-3 fw-bolder" id="submitBtn" type="submit">Send message</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <?php include __DIR__ . '/includes/footer.php'; ?>
        <script src="js/contact.js"></script>
    </body>
</html>
