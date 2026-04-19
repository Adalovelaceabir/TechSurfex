<?php get_header(); ?>

<div class="container">
    <div class="row" style="display: grid; grid-template-columns: 1fr 320px; gap: 40px;">
        <div class="main-content">
            <?php while (have_posts()) : the_post(); ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                    <header class="entry-header">
                        <div class="post-categories">
                            <?php the_category(', '); ?>
                        </div>
                        <h1 class="entry-title"><?php the_title(); ?></h1>
                        <div class="entry-meta">
                            <span>By <?php the_author(); ?></span> • 
                            <span><?php echo get_the_date(); ?></span> • 
                            <span>👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: 0; ?> views</span>
                        </div>
                    </header>
                    
                    <?php if (has_post_thumbnail()) : ?>
                    <div class="post-thumbnail">
                        <?php the_post_thumbnail('featured-large', array('loading' => 'lazy')); ?>
                    </div>
                    <?php endif; ?>
                    
                    <div class="entry-content">
                        <?php the_content(); ?>
                    </div>
                    
                    <!-- Social Share Buttons -->
                    <div class="social-share" style="margin: 30px 0; padding: 20px; background: var(--bg-secondary); border-radius: 12px;">
                        <h4>Share this article:</h4>
                        <div class="social-links" style="display: flex; gap: 15px;">
                            <a href="https://twitter.com/share?url=<?php echo urlencode(get_permalink()); ?>&text=<?php echo urlencode(get_the_title()); ?>" target="_blank">🐦 Twitter</a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo urlencode(get_permalink()); ?>" target="_blank">📘 Facebook</a>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo urlencode(get_permalink()); ?>" target="_blank">💼 LinkedIn</a>
                            <a href="mailto:?subject=<?php echo urlencode(get_the_title()); ?>&body=<?php echo urlencode(get_permalink()); ?>">✉️ Email</a>
                        </div>
                    </div>
                    
                    <!-- Ad Inside Post -->
                    <div class="ad-slot">
                        <p>Advertisement</p>
                        <img src="https://via.placeholder.com/728x90?text=AdSense" alt="Ad">
                    </div>
                    
                    <!-- Comments -->
                    <?php if (comments_open() || get_comments_number()) : ?>
                        <?php comments_template(); ?>
                    <?php endif; ?>
                </article>
            <?php endwhile; ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
