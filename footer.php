    </main><!-- #main -->
    
    <!-- Newsletter Section -->
    <div class="container">
        <div class="newsletter-section">
            <h3>Subscribe to TechSurfex Newsletter</h3>
            <p>Get the latest tech news and gadget reviews delivered to your inbox</p>
            <form class="newsletter-form" action="#" method="post">
                <input type="email" name="email" placeholder="Your email address" required>
                <button type="submit">Subscribe →</button>
            </form>
        </div>
    </div>
    
    <footer class="site-footer">
        <div class="container">
            <div class="footer-grid">
                <?php if (is_active_sidebar('footer-widgets')) : ?>
                    <?php dynamic_sidebar('footer-widgets'); ?>
                <?php else : ?>
                    <div class="footer-widget">
                        <h4>About TechSurfex</h4>
                        <p>Your trusted source for technology news, gadget reviews, and how-to guides from Europe to the world.</p>
                        <div class="social-links">
                            <a href="#" target="_blank">📘</a>
                            <a href="#" target="_blank">🐦</a>
                            <a href="#" target="_blank">📷</a>
                            <a href="#" target="_blank">▶️</a>
                        </div>
                    </div>
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul>
                            <li><a href="<?php echo esc_url(home_url('/about')); ?>">About Us</a></li>
                            <li><a href="<?php echo esc_url(home_url('/contact')); ?>">Contact</a></li>
                            <li><a href="<?php echo esc_url(home_url('/privacy-policy')); ?>">Privacy Policy</a></li>
                            <li><a href="<?php echo esc_url(home_url('/advertise')); ?>">Advertise</a></li>
                        </ul>
                    </div>
                    <div class="footer-widget">
                        <h4>Categories</h4>
                        <ul>
                            <?php 
                            $categories = array('Smartphones', 'AI & Technology', 'Gadgets', 'Reviews', 'How-To Guides');
                            foreach ($categories as $cat) {
                                $category = get_term_by('name', $cat, 'category');
                                if ($category) {
                                    echo '<li><a href="' . get_category_link($category->term_id) . '">' . $cat . '</a></li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
            <div class="copyright" style="text-align: center; padding-top: 30px; border-top: 1px solid rgba(255,255,255,0.1);">
                <p>&copy; <?php echo date('Y'); ?> TechSurfex. All rights reserved. Powered by WordPress.</p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
