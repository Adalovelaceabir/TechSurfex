<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <header class="site-header">
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="<?php echo esc_url(home_url('/')); ?>">
                        <?php 
                        if (has_custom_logo()) {
                            the_custom_logo();
                        } else {
                            echo '<span>TechSurfex</span>';
                        }
                        ?>
                    </a>
                </div>
                
                <nav class="main-nav">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'menu_class' => 'primary-menu',
                        'walker' => new Mega_Menu_Walker(),
                        'fallback_cb' => false,
                        'depth' => 3
                    ));
                    ?>
                </nav>
                
                <div class="header-actions">
                    <button id="dark-mode-toggle" class="dark-toggle" aria-label="Dark/Light Mode">
                        🌓
                    </button>
                </div>
            </div>
        </div>
    </header>
    
    <main id="main" class="site-main">
