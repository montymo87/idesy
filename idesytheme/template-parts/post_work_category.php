<?php

defined('ABSPATH') || exit;

global $post;
?>
<a href="<?php echo esc_url(get_permalink()) ?>" class="random-case">
    <div class="left-side js-anim-intro-el">
        <span>
            <?php
            $random_case_title = get_field('random-case_title', 'option');
            if ($random_case_title) {
                echo $random_case_title;
            }
            ?>
        </span>
        <span>
            <?= get_the_title(); ?>
        </span>
    </div>
    <div class="right-side js-anim-intro-el">
        <div class="img-holder">
            <img src="<?= get_field('img_on_catalog')['sizes']['full'] ?>" alt="<?php get_the_title(); ?>">
        </div>
    </div>
</a>