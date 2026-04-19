<?php get_header(); ?>

<div class="container">
    <div class="row" style="display: grid; grid-template-columns: 1fr 320px; gap: 40px;">
        <div class="main-content">
            <h1 class="archive-title" style="margin-bottom: 30px;">
                <?php single_cat_title(); ?>
            </h1>
            
            <?php if (category_description()) : ?>
                <div class="category-description" style="margin-bottom: 30px;">
                    <?php echo category_description(); ?>
                </div>
            <?php endif; ?>
            
            <div class="grid-3">
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                    <article class="post-card">
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
                            </div>
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                        </div>
                    </article>
                <?php endwhile; endif; ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination" style="margin-top: 40px; text-align: center;">
                <?php 
                the_posts_pagination(array(
                    'mid_size' => 2,
                    'prev_text' => '← Previous',
                    'next_text' => 'Next →',
                ));
                ?>
            </div>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
