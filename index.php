<?php
/**
 * The main template file
 * 
 * This is the most generic template file. It is used as a fallback
 * when a more specific template (like single.php, page.php, etc.) is not available.
 *
 * @package TechSurfex
 */

get_header(); ?>

<div class="container">
    <div class="row" style="display: grid; grid-template-columns: 1fr 320px; gap: 40px;">
        <div class="main-content">
            <?php if (have_posts()) : ?>
                <h1 class="archive-title" style="margin-bottom: 30px;">
                    <?php
                    if (is_home() && !is_front_page()) {
                        single_post_title();
                    } else {
                        _e('Latest Posts', 'techsurfex');
                    }
                    ?>
                </h1>
                
                <div class="grid-3">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="post-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('post-card', array('loading' => 'lazy')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="post-content">
                                <div class="post-meta">
                                    <span><?php echo get_the_date(); ?></span>
                                    <span>• <?php echo get_comments_number(); ?> <?php _e('comments', 'techsurfex'); ?></span>
                                </div>
                                <h2 class="post-title">
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                </h2>
                                <div class="post-excerpt">
                                    <?php echo wp_trim_words(get_the_excerpt(), 18); ?>
                                </div>
                                <a href="<?php the_permalink(); ?>" class="read-more" style="color: var(--accent); text-decoration: none; font-weight: 500;">
                                    <?php _e('Read More →', 'techsurfex'); ?>
                                </a>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
                
                <!-- Pagination -->
                <div class="pagination" style="margin-top: 40px; text-align: center;">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => __('← Previous', 'techsurfex'),
                        'next_text' => __('Next →', 'techsurfex'),
                        'screen_reader_text' => __('Posts navigation', 'techsurfex'),
                    ));
                    ?>
                </div>
                
            <?php else : ?>
                <div class="no-posts" style="text-align: center; padding: 60px 20px;">
                    <h2><?php _e('No posts found', 'techsurfex'); ?></h2>
                    <p><?php _e('Sorry, no content matches your criteria. Try searching?', 'techsurfex'); ?></p>
                    <?php get_search_form(); ?>
                </div>
            <?php endif; ?>
        </div><!-- .main-content -->
        
        <?php get_sidebar(); ?>
    </div><!-- .row -->
</div><!-- .container -->

<?php get_footer(); ?>
