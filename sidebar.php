<?php
if (!is_active_sidebar('sidebar-1')) {
    return;
}
?>

<aside class="widget-area">
    <div class="widget widget_search">
        <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="input-group">
                <input type="search" class="form-control" placeholder="<?php echo esc_attr_x('Search...', 'placeholder', 'newmathphys'); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                <button class="btn btn-primary" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </form>
    </div>

    <div class="widget widget_categories">
        <h3 class="widget-title"><?php _e('Categories', 'newmathphys'); ?></h3>
        <ul>
            <?php
            wp_list_categories(array(
                'title_li' => '',
                'show_count' => true,
            ));
            ?>
        </ul>
    </div>

    <div class="widget widget_recent_entries">
        <h3 class="widget-title"><?php _e('Recent Articles', 'newmathphys'); ?></h3>
        <ul>
            <?php
            $recent_posts = wp_get_recent_posts(array(
                'numberposts' => 5,
                'post_status' => 'publish'
            ));
            foreach ($recent_posts as $post) : ?>
                <li>
                    <a href="<?php echo get_permalink($post['ID']); ?>">
                        <?php echo $post['post_title']; ?>
                    </a>
                    <span class="post-date">
                        <?php echo get_the_date('', $post['ID']); ?>
                    </span>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="widget widget_tag_cloud">
        <h3 class="widget-title"><?php _e('Tags', 'newmathphys'); ?></h3>
        <?php
        wp_tag_cloud(array(
            'smallest' => 0.8,
            'largest' => 1.2,
            'unit' => 'rem',
            'number' => 20,
        ));
        ?>
    </div>

    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <?php dynamic_sidebar('sidebar-1'); ?>
    <?php endif; ?>
</aside> 