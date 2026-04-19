<?php get_header(); ?>

<div class="container">
    <?php while (have_posts()) : the_post(); ?>
        <article class="page-content" style="max-width: 800px; margin: 0 auto;">
            <h1><?php the_title(); ?></h1>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
    <?php endwhile; ?>
</div>

<?php get_footer(); ?>
