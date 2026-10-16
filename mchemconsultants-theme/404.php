<?php
/**
 * MChem Consultants - 404.php
 * @package mchemconsultants
 */
get_header();
?>
<div class="mchem-container" style="text-align:center;padding-block:var(--mchem-space-3xl);padding-top:calc(var(--mchem-space-3xl)+80px)">
    <span style="font-size:6rem;font-weight:800;color:var(--mchem-gold);opacity:.15;display:block">404</span>
    <h1 style="font-size:clamp(1.8rem,4vw,2.8rem);margin-bottom:1rem"><?php esc_html_e("Page Not Found","mchemconsultants"); ?></h1>
    <p style="color:var(--mchem-text-muted);margin-bottom:2rem"><?php esc_html_e("The page you're looking for doesn't exist. Let's get you back on track.","mchemconsultants"); ?></p>
    <a href="<?php echo esc_url(home_url("/")); ?>" class="mchem-btn mchem-btn--primary"><?php esc_html_e("Back to Home","mchemconsultants"); ?></a>
</div>
<?php get_footer();
