<?php get_header(); ?>
<div class="container">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <article class="single-article" style="max-width:700px;margin:3rem auto 2rem auto;">
            <h1 class="article-title" style="font-size:2.2rem;font-weight:700;margin-bottom:1rem;"><?php the_title(); ?></h1>
            <div class="article-meta" style="color:#888;font-size:1rem;margin-bottom:2rem;">
                <span><?php echo get_the_date(); ?></span>
                <span>·</span>
                <span><?php the_author(); ?></span>
            </div>
            <div class="article-content" style="font-size:1.15rem;line-height:1.8;">
                <?php the_content(); ?>
            </div>
            <div class="article-footer" style="margin-top:2.5rem;display:flex;flex-wrap:wrap;gap:1.5rem;align-items:center;">
                <div class="article-tags">
                    <?php $tags = get_the_tags(); if ($tags): ?>
                        <?php foreach ($tags as $tag): ?>
                            <a href="<?php echo get_tag_link($tag->term_id); ?>" class="tag-badge"><?php echo $tag->name; ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <div class="article-categories">
                    <?php $cats = get_the_category(); if ($cats): ?>
                        <?php foreach ($cats as $cat): ?>
                            <a href="<?php echo get_category_link($cat->term_id); ?>" class="category-badge"><?php echo $cat->name; ?></a>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
                <a href="<?php echo esc_url(home_url('/')); ?>" class="card-link" style="margin-left:auto;">← Back to articles</a>
            </div>
        </article>
        <?php comments_template(); ?>
    <?php endwhile; endif; ?>
</div>
<?php get_footer(); ?> 