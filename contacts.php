<?php
/**
 * Template Name: Contacts
 * 
 * This is the template that displays the contacts page.
 */

get_header(); ?>

<div class="contacts-page">
    <div class="container">
        <div class="contacts-grid">
            <div class="contact-info">
                <h2><?php _e('Contact Information', 'newmathphys'); ?></h2>
                <p><?php _e('Get in touch with us using any of the following methods:', 'newmathphys'); ?></p>
                
                <div class="contact-methods">
                    <a href="mailto:info@newmathphys.com" class="contact-method">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div class="contact-details">
                            <h3><?php _e('Email', 'newmathphys'); ?></h3>
                            <p>info@newmathphys.com</p>
                        </div>
                    </a>
                    
                    <a href="https://t.me/newmathphys" class="contact-method">
                        <div class="contact-icon">
                            <i class="fab fa-telegram"></i>
                        </div>
                        <div class="contact-details">
                            <h3><?php _e('Telegram', 'newmathphys'); ?></h3>
                            <p>@newmathphys</p>
                        </div>
                    </a>
                </div>
            </div>
            
            <div class="contact-form">
                <h2><?php _e('Send us a Message', 'newmathphys'); ?></h2>
                <?php echo do_shortcode('[contact-form-7 id="1" title="Contact form 1"]'); ?>
            </div>
        </div>
    </div>
</div>

<?php get_footer(); ?> 