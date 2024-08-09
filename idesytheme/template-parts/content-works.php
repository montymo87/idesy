<?php

/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package idesy
 */

?>
<div class="col-6">
	<div class="works-item js-fade-el">
		<?php
		$title_before = get_field('works_post_title_before');

		if ($title_before) {
			echo '<h3 class="h3" data-before="' . esc_attr($title_before) . '"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_title() . '</a></h3>';
		} else {
			echo '<h3 class="h3"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">' . get_the_title() . '</a></h3>';
		}
		?>
		<div class="item-picture" style="background-image: url(<?= get_field('img_on_catalog')['sizes']['full'] ?>);"></div>
		<?php
		$portfolio_tags_ids = get_post_meta(get_the_ID(), 'works_post_tags', true);

		if (!empty($portfolio_tags_ids) && is_array($portfolio_tags_ids)) {
			echo '<ul class="list-tags">';

			foreach ($portfolio_tags_ids as $tag_id) {

				$term = get_term($tag_id);


				if ($term && !is_wp_error($term)) {

					echo '<li class="js-fade-el"><span>' . esc_html($term->name) . '</span></li>';
				}
			}

			echo '</ul>';
		}
		?>
		<a href="<?= esc_url(get_permalink()) ?>" class="item-link">
			<?php get_the_title(); ?>
		</a>
	</div>
</div>