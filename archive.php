<?php get_header(); ?>

<div class="container">
    <div class="row" style="display: grid; grid-template-columns: 1fr 320px; gap: 40px;">
        <div class="main-content">
            <h1 class="archive-title">
                <?php 
                if (is_day()) echo 'Archive: ' . get_the_date();
                elseif (is_month()) echo 'Archive: ' . get_the_date('F Y');
                elseif (is_year()) echo 'Archive: ' . get_the_date('Y');
                else echo 'Archives';
                ?>
            </h1>
            
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
                            <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            <div class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                        </div>
                    </article>
                <?php endwhile; endif; ?>
            </div>
            
            <?php the_posts_pagination(); ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
