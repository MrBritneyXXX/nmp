<?php get_header(); ?>
<div class="container">
    <div class="articles-grid">
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
            <div class="article-card">
                <?php if (has_post_thumbnail()): ?>
                    <div class="card-img">
                        <?php the_post_thumbnail('medium_large'); ?>
                    </div>
                <?php endif; ?>
                <div class="card-content">
                    <div class="card-title"><?php the_title(); ?></div>
                    <div class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 12); ?></div>
                    <div class="card-date"><?php echo get_the_date(); ?></div>
                    <a class="card-link" href="<?php the_permalink(); ?>">Read more</a>
                </div>
            </div>
        <?php endwhile; else: ?>
            <div class="no-results">
                <p><?php _e('No results found.', 'newmathphys'); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php get_footer(); ?> 