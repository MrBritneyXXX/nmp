<?php get_header(); ?>

<section class="hero-section hero-main">
    <div class="container hero-center">
        <h1 class="hero-title">NewMathPhys.com</h1>
        <div class="hero-subtitle">Методы математической физики</div>
    </div>
</section>

<div class="container">
    <div class="articles-grid">
        <?php
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $query = new WP_Query(array(
            'post_type' => 'post',
            'posts_per_page' => 10,
            'paged' => $paged
        ));
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); ?>
            <div class="article-card" data-aos="fade-up">
                <?php if (has_post_thumbnail()): ?>
                    <div class="card-img">
                        <?php the_post_thumbnail('medium_large'); ?>
                    </div>
                <?php endif; ?>
                <div class="card-category">
                    <?php
                    $category = get_the_category();
                    if ($category) {
                        echo '<a href="' . esc_url(get_category_link($category[0]->term_id)) . '" class="category-badge">' . esc_html($category[0]->name) . '</a>';
                    }
                    ?>
                </div>
                <div class="card-title"><?php the_title(); ?></div>
                <div class="card-text"><?php echo wp_trim_words(get_the_excerpt(), 22); ?></div>
                <div class="card-date"><?php echo get_the_date(); ?></div>
                <a class="card-link" href="<?php the_permalink(); ?>">Read more</a>
            </div>
        <?php endwhile; endif; wp_reset_postdata(); ?>
    </div>
    <?php
    // Пагинация
    the_posts_pagination(array(
        'mid_size' => 2,
        'prev_text' => __('← Previous', 'newmathphys'),
        'next_text' => __('Next →', 'newmathphys'),
    ));
    ?>
</div>

<?php get_footer(); ?> 