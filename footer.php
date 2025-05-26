<?php
/**
 * The template for displaying the footer
 */
?>

    <footer id="colophon" class="site-footer">
        <div class="container">
            <div class="footer-widgets">
                <div class="row">
                    <div class="col-md-6">
                        <div class="footer-widget">
                            <h3><?php _e('О нас', 'newmathphys'); ?></h3>
                            <p><?php _e('NewMathPhys - научный портал, посвященный математике и физике. Мы публикуем статьи, исследования и новости из мира науки.', 'newmathphys'); ?></p>
                            
                            <div class="telegram-contact">
                                <h4><?php _e('Наш Telegram', 'newmathphys'); ?></h4>
                                <a href="https://t.me/newmathphys" class="tg-link" target="_blank">
                                    <i class="fab fa-telegram"></i>
                                    @newmathphys
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="footer-widget">
                            <h3><?php _e('Обратная связь', 'newmathphys'); ?></h3>
                            <?php echo do_shortcode('[contact_form]'); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="site-info">
                <p>&copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php _e('Все права защищены.', 'newmathphys'); ?></p>
            </div>
        </div>
    </footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html> 