<aside class="sidebar">
    <!-- Trending Sidebar Widget -->
    <div class="widget">
        <h3 class="widget-title">🔥 Trending Now</h3>
        <ul style="list-style: none; padding: 0;">
            <?php 
            $trending_sidebar = techsurfex_get_trending_posts(5);
            while ($trending_sidebar->have_posts()) : $trending_sidebar->the_post(); ?>
            <li style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid var(--border);">
                <a href="<?php the_permalink(); ?>" style="text-decoration: none; color: var(--text-primary);">
                    <?php if (has_post_thumbnail()) : ?>
                    <img src="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" alt="<?php the_title(); ?>" style="width: 60px; height: 60px; object-fit: cover; border-radius: 8px; float: left; margin-right: 10px;">
                    <?php endif; ?>
                    <strong><?php the_title(); ?></strong><br>
                    <small style="color: var(--text-secondary);">👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: 0; ?> views</small>
                </a>
                <div style="clear: both;"></div>
            </li>
            <?php endwhile; wp_reset_postdata(); ?>
        </ul>
    </div>
    
    <!-- Ad Slot Sidebar -->
    <div class="widget">
        <div class="ad-slot">
            <p>Advertisement</p>
            <img src="https://via.placeholder.com/300x250?text=AdSense" alt="Ad" style="max-width: 100%;">
        </div>
    </div>
    
    <!-- Newsletter Widget -->
    <div class="widget">
        <h3 class="widget-title">📧 Newsletter</h3>
        <p>Get weekly tech insights straight to your inbox.</p>
        <form class="newsletter-form" style="flex-direction: column;" action="#" method="post">
            <input type="email" name="email" placeholder="Your email" style="width: 100%; margin-bottom: 10px;">
            <button type="submit" style="width: 100%;">Subscribe</button>
        </form>
    </div>
    
    <!-- Social Media Widget -->
    <div class="widget">
        <h3 class="widget-title">Follow Us</h3>
        <div class="social-links" style="display: flex; gap: 15px; font-size: 28px;">
            <a href="#" target="_blank">📘</a>
            <a href="#" target="_blank">🐦</a>
            <a href="#" target="_blank">📷</a>
            <a href="#" target="_blank">▶️</a>
            <a href="#" target="_blank">💼</a>
        </div>
    </div>
    
    <?php if (is_active_sidebar('sidebar-main')) : ?>
        <?php dynamic_sidebar('sidebar-main'); ?>
    <?php endif; ?>
</aside>
