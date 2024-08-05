<?php

defined('ABSPATH') || exit;

global $post;
?>
<div class="works-card">
    <div class="img-holder">
        <?php
        $thumbnail = get_field('img_on_home');
        if (!empty($thumbnail) && !empty($thumbnail['sizes']['full'])) {
            echo '<img src="' . $thumbnail['sizes']['full'] . '" alt="' . get_the_title() . '">';
        }
        ?>
    </div>
    <?php
    $main_title = get_the_title();
    $title_markup = '<h3 class="card-title">' . esc_html($main_title) . '</h3>';
    echo $title_markup;
    ?>
    <?php
    $portfolio_tags_ids = get_post_meta(get_the_ID(), 'works_post_tags', true);

    if (!empty($portfolio_tags_ids) && is_array($portfolio_tags_ids)) {
        echo '<ul class="list-tags">';

        foreach ($portfolio_tags_ids as $tag_id) {

            $term = get_term($tag_id);


            if ($term && !is_wp_error($term)) {

                echo '<li><span>' . esc_html($term->name) . '</span></li>';
            }
        }

        echo '</ul>';
    }
    ?>
    <a href="<?php echo esc_url(get_permalink()) ?>" class="card-link">
        <?php echo esc_attr(get_the_title()) ?>
    </a>
</div>