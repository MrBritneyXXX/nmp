<?php
/**
 * The main template file
 */

get_header();
?>

<main id="primary" class="site-main">
    <div class="container">
        <?php
        if (have_posts()) :
            while (have_posts()) :
                the_post();
                ?>
                <article id="post-<?php the_ID(); ?>" <?php post_class('post-card fade-in'); ?>>
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="post-card__image">
                            <?php the_post_thumbnail('large'); ?>
                        </div>
                    <?php endif; ?>

                    <div class="post-card__content">
                        <header class="entry-header">
                            <?php the_title('<h2 class="post-card__title"><a href="' . esc_url(get_permalink()) . '">', '</a></h2>'); ?>
                            
                            <div class="entry-meta">
                                <span class="posted-on">
                                    <?php echo get_the_date(); ?>
                                </span>
                                <?php if (has_category()) : ?>
                                    <span class="cat-links">
                                        <?php the_category(', '); ?>
                                    </span>
                                <?php endif; ?>
                            </div>
                        </header>

                        <div class="post-card__excerpt">
                            <?php the_excerpt(); ?>
                        </div>

                        <footer class="entry-footer">
                            <a href="<?php the_permalink(); ?>" class="btn btn-primary">
                                <?php _e('Читать далее', 'newmathphys'); ?>
                            </a>
                        </footer>
                    </div>
                </article>
                <?php
            endwhile;

            the_posts_pagination(array(
                'prev_text' => __('Предыдущая', 'newmathphys'),
                'next_text' => __('Следующая', 'newmathphys'),
            ));

        else :
            ?>
            <div class="no-results">
                <h2><?php _e('Ничего не найдено', 'newmathphys'); ?></h2>
                <p><?php _e('Попробуйте поискать что-то другое.', 'newmathphys'); ?></p>
                <?php get_search_form(); ?>
            </div>
            <?php
        endif;
        ?>
    </div>
</main>

<?php
get_footer(); 