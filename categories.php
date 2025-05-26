<?php
/**
 * Template Name: Categories Page
 */

get_header();
?>

<div class="categories-page">
    <div class="container">
        <h1 class="page-title">Категории</h1>
        
        <div class="categories-grid">
            <a href="/category/mathematics" class="category-card">
                <div class="category-icon">∑</div>
                <div class="category-info">
                    <h2 class="category-name">Математика</h2>
                    <p class="category-description">Математические статьи и исследования</p>
                </div>
            </a>

            <a href="/category/physics" class="category-card">
                <div class="category-icon">⚛</div>
                <div class="category-info">
                    <h2 class="category-name">Физика</h2>
                    <p class="category-description">Физические теории и эксперименты</p>
                </div>
            </a>

            <a href="/category/interdisciplinary" class="category-card">
                <div class="category-icon">∞</div>
                <div class="category-info">
                    <h2 class="category-name">Смежные</h2>
                    <p class="category-description">Междисциплинарные исследования</p>
                </div>
            </a>
        </div>

        <div class="category-posts">
            <?php
            $categories = get_categories();
            foreach($categories as $category) {
                $args = array(
                    'category_name' => $category->slug,
                    'posts_per_page' => 5
                );
                $query = new WP_Query($args);
                
                if($query->have_posts()) : ?>
                    <div class="category-section">
                        <h2 class="category-title"><?php echo $category->name; ?></h2>
                        <div class="posts-grid">
                            <?php while($query->have_posts()) : $query->the_post(); ?>
                                <article class="post-card">
                                    <?php if(has_post_thumbnail()) : ?>
                                        <div class="post-thumbnail">
                                            <?php the_post_thumbnail('medium'); ?>
                                        </div>
                                    <?php endif; ?>
                                    <div class="post-content">
                                        <h3 class="post-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h3>
                                        <div class="post-excerpt">
                                            <?php the_excerpt(); ?>
                                        </div>
                                        <div class="post-meta">
                                            <span class="post-date"><?php echo get_the_date(); ?></span>
                                        </div>
                                    </div>
                                </article>
                            <?php endwhile; ?>
                        </div>
                    </div>
                <?php endif;
                wp_reset_postdata();
            }
            ?>
        </div>
    </div>
</div>

<?php get_footer(); ?> 