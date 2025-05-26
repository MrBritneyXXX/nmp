<?php
get_header();
?>

<div class="container py-5">
    <div class="row">
        <div class="col-md-8">
            <?php if (have_posts()) : ?>
                <header class="page-header mb-4">
                    <h1 class="page-title">
                        <?php
                        $term = get_queried_object();
                        printf(
                            __('Статьи в категории %s', 'newmathphys'),
                            '<span class="text-primary">' . esc_html($term->name) . '</span>'
                        );
                        ?>
                    </h1>
                    <?php if ($term->description) : ?>
                        <div class="term-description mt-3">
                            <?php echo wp_kses_post($term->description); ?>
                        </div>
                    <?php endif; ?>
                </header>

                <div class="articles-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('article-card mb-4'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="article-thumbnail">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php the_post_thumbnail('medium', array('class' => 'img-fluid')); ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                            
                            <div class="article-content p-3">
                                <header class="entry-header">
                                    <h2 class="entry-title h4">
                                        <a href="<?php the_permalink(); ?>" class="text-decoration-none">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>
                                </header>

                                <div class="entry-summary mt-3">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="entry-footer mt-3">
                                    <div class="entry-meta text-muted small">
                                        <span class="posted-on">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            <?php echo get_the_date(); ?>
                                        </span>
                                        <?php if (has_category()) : ?>
                                            <span class="categories ms-3">
                                                <i class="fas fa-folder me-1"></i>
                                                <?php the_category(', '); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <div class="pagination-container mt-4">
                    <?php
                    the_posts_pagination(array(
                        'mid_size' => 2,
                        'prev_text' => '<i class="fas fa-chevron-left"></i>',
                        'next_text' => '<i class="fas fa-chevron-right"></i>',
                        'class' => 'pagination justify-content-center'
                    ));
                    ?>
                </div>

            <?php else : ?>
                <div class="alert alert-info">
                    <?php _e('В данной категории статей не найдено.', 'newmathphys'); ?>
                </div>
            <?php endif; ?>
        </div>

        <div class="col-md-4">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

<?php
get_footer();
?> 