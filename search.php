<?php get_header(); ?>

<div class="container">
    <div class="row" style="display: grid; grid-template-columns: 1fr 320px; gap: 40px;">
        <div class="main-content">
            <h1 class="search-title">Search Results: <?php echo get_search_query(); ?></h1>
            
            <?php if (have_posts()) : ?>
                <div class="grid-3">
                    <?php while (have_posts()) : the_post(); ?>
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
                    <?php endwhile; ?>
                </div>
                <?php the_posts_pagination(); ?>
            <?php else : ?>
                <p>No results found. Try different keywords!</p>
                <?php get_search_form(); ?>
            <?php endif; ?>
        </div>
        
        <?php get_sidebar(); ?>
    </div>
</div>

<?php get_footer(); ?>
