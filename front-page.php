<?php
/**
 * Front Page Template
 * Template Name: Homepage
 */

get_header();

// Breaking News Query (Category: breaking-news)
$breaking_args = array(
    'post_type' => 'post',
    'posts_per_page' => 5,
    'category_name' => 'breaking-news',
    'meta_key' => 'post_views',
    'orderby' => 'date',
    'order' => 'DESC'
);
$breaking_query = new WP_Query($breaking_args);
?>

<!-- Breaking News Slider -->
<?php if ($breaking_query->have_posts()) : ?>
<section class="breaking-slider">
    <div class="container">
        <div class="slider-container">
            <div class="swiper breakingSwiper">
                <div class="swiper-wrapper">
                    <?php while ($breaking_query->have_posts()) : $breaking_query->the_post(); ?>
                    <div class="swiper-slide" style="background-image: url('<?php echo get_the_post_thumbnail_url(get_the_ID(), 'slider-image') ?: 'https://via.placeholder.com/1920x800?text=TechSurfex'; ?>');">
                        <div class="slide-content">
                            <span class="slide-category">Breaking</span>
                            <h2 class="slide-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            <div class="slide-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></div>
                        </div>
                    </div>
                    <?php endwhile; ?>
                </div>
                <div class="swiper-button-next"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
    </div>
</section>
<?php wp_reset_postdata(); endif; ?>

<div class="container">
    <div class="content-area">
        <div class="row" style="display: grid; grid-template-columns: 1fr 320px; gap: 40px;">
            <div class="main-content">
                
                <!-- Latest Posts -->
                <section class="latest-posts">
                    <h2 class="section-title">Latest Tech News</h2>
                    <div class="grid-3">
                        <?php 
                        $latest_args = array('posts_per_page' => 6);
                        $latest_query = new WP_Query($latest_args);
                        while ($latest_query->have_posts()) : $latest_query->the_post(); ?>
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
                                    <span>• <?php echo get_comments_number(); ?> comments</span>
                                </div>
                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                <div class="post-excerpt"><?php echo wp_trim_words(get_the_excerpt(), 15); ?></div>
                            </div>
                        </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </section>
                
                <!-- Trending News -->
                <section class="trending-news">
                    <h2 class="section-title">Trending Now 🔥</h2>
                    <div class="grid-3">
                        <?php 
                        $trending_query = techsurfex_get_trending_posts(6);
                        while ($trending_query->have_posts()) : $trending_query->the_post(); ?>
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
                                    <span>👁️ <?php echo get_post_meta(get_the_ID(), 'post_views', true) ?: 0; ?> views</span>
                                </div>
                                <h3 class="post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                            </div>
                        </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </section>
                
                <!-- Featured Categories -->
                <section class="featured-categories">
                    <h2 class="section-title">Featured Categories</h2>
                    <?php 
                    $categories = array('Smartphones', 'AI & Technology', 'Gadgets', 'Reviews', 'How-To Guides');
                    foreach ($categories as $cat_name) :
                        $category = get_term_by('name', $cat_name, 'category');
                        if ($category) :
                            $cat_args = array(
                                'posts_per_page' => 3,
                                'cat' => $category->term_id
                            );
                            $cat_query = new WP_Query($cat_args);
                    ?>
                    <div class="category-section" style="margin-bottom: 40px;">
                        <h3 style="margin-bottom: 20px; color: var(--accent);"><?php echo $cat_name; ?></h3>
                        <div class="grid-3">
                            <?php while ($cat_query->have_posts()) : $cat_query->the_post(); ?>
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
                                </div>
                            </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                    <?php wp_reset_postdata(); endif; endforeach; ?>
                </section>
                
                <!-- Ad Slot -->
                <div class="ad-slot">
                    <p>Advertisement</p>
                    <div id="google-adsense-slot" style="min-height: 250px;">
                        <!-- Your AdSense code will go here -->
                        <img src="https://via.placeholder.com/728x90?text=Advertisement" alt="Ad" style="max-width: 100%;">
                    </div>
                </div>
                
            </div><!-- .main-content -->
            
            <?php get_sidebar(); ?>
        </div><!-- .row -->
    </div><!-- .content-area -->
</div><!-- .container -->

<?php get_footer(); ?>
