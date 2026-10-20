<?php
/**
 * Shared navigation bar.
 * Set $ACTIVE (one of: home, services, work, contact) before including
 * to highlight the current page.
 */
$ACTIVE = $ACTIVE ?? '';
function nav_active(string $key, string $active): string {
    return $key === $active ? ' active' : '';
}
?>
<nav class="navbar navbar-expand-lg navbar-light bg-white py-3 shadow-sm sticky-top">
    <div class="container px-5">
        <a class="navbar-brand d-flex align-items-center gap-2" href="index.php">
            <img src="assets/logo.png" alt="Malkia Web Factory logo" />
            <span class="fw-bolder text-primary">Malkia <span class="text-gold">Web Factory</span></span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0 small fw-bolder">
                <li class="nav-item"><a class="nav-link<?= nav_active('home', $ACTIVE) ?>" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('services', $ACTIVE) ?>" href="resume.php">What We Do</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('work', $ACTIVE) ?>" href="projects.php">Our Work</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('story', $ACTIVE) ?>" href="story.php">Our Story</a></li>
                <li class="nav-item"><a class="nav-link<?= nav_active('contact', $ACTIVE) ?>" href="contact.php">Contact</a></li>
                <li class="nav-item ms-lg-3"><a class="btn btn-primary px-4" href="contact.php">Start Your Website</a></li>
            </ul>
        </div>
    </div>
</nav>
