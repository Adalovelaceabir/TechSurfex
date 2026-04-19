<?php get_header(); ?>

<div class="container" style="text-align: center; padding: 80px 20px;">
    <h1 style="font-size: 80px; color: var(--accent);">404</h1>
    <h2>Page Not Found</h2>
    <p>Oops! The page you're looking for doesn't exist or has been moved.</p>
    <a href="<?php echo esc_url(home_url('/')); ?>" class="home-button" style="display: inline-block; margin-top: 20px; padding: 12px 24px; background: var(--accent); color: white; text-decoration: none; border-radius: 8px;">
        ← Back to Homepage
    </a>
</div>

<?php get_footer(); ?>
