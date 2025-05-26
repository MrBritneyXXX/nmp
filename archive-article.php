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
                        if (is_tax('article_category')) {
                            single_term_title('Статьи в категории: ');
                        } else {
                            echo 'Все статьи';
                        }
                        ?>
                    </h1>
                </header>

                <div class="articles-grid">
                    <?php while (have_posts()) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('article-card'); ?>>
                            <?php if (has_post_thumbnail()) : ?>
                                <div class="article-thumbnail">
                                    <?php the_post_thumbnail('medium'); ?>
                                </div>
                            <?php endif; ?>
                            
                            <div class="article-content">
                                <header class="entry-header">
                                    <?php
                                    $categories = get_the_terms(get_the_ID(), 'article_category');
                                    if ($categories && !is_wp_error($categories)) :
                                        foreach ($categories as $category) : ?>
                                            <span class="category-badge"><?php echo esc_html($category->name); ?></span>
                                        <?php endforeach;
                                    endif;
                                    ?>
                                    
                                    <h2 class="entry-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                </header>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="entry-footer">
                                    <div class="entry-meta">
                                        <span class="posted-on">
                                            <?php echo get_the_date(); ?>
                                        </span>
                                    </div>
                                </footer>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>

                <?php the_posts_pagination(); ?>

            <?php else : ?>
                <p><?php _e('Статьи не найдены.', 'newmathphys'); ?></p>
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