<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package idesy
 */

get_header();
$properties = function_exists('get_fields') ? get_fields() : [];
?>
<main class="main" style="overflow: hidden;">
	<div class="post-page">
		<div class="container">
			<?php idesy_get_breadcrumbs(); ?>
		</div>
		<div class="page-intro">
			<div class="container container-small">
				<div class="left-side">
					<?php the_title('<h1 class="h1 js-fade-el">', '</h1>'); ?>
					<?php
					$portfolio_tags_ids = get_post_meta(get_the_ID(), 'works_post_tags', true);

					if (!empty($portfolio_tags_ids) && is_array($portfolio_tags_ids)) {
						echo '<ul class="list-tags ">';

						foreach ($portfolio_tags_ids as $tag_id) {

							$term = get_term($tag_id);


							if ($term && !is_wp_error($term)) {

								echo '<li class="js-fade-el"><span>' . esc_html($term->name) . '</span></li>';
							}
						}

						echo '</ul>';
					}
					?>
				</div>
				<div class="right-side">
					<span class="decor-text js-fade-el">아름다움은 <br> 보는 사람의 눈 <br> 보는 사람의 눈에</span>
					<div class="text-holder js-fade-el">
						<p>
							<?= $properties['works_post_main_text'] ?>
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="main-img" style="background-image: url('<?= $properties['works_post_main-img']['sizes']['full'] ?>');">
		</div>
		<div class="post-content">
			<?php
			if (have_rows('works_post_content')) :

				while (have_rows('works_post_content')) :
					the_row();

					if (get_row_layout() == 'first_template') :
						$first_col_text = get_sub_field('first_col_text');
						$second_col_text = get_sub_field('second_col_text');
			?>
						<div class="text-two-cols style-1">
							<div class="container container-small">
								<div class="row">
									<div class="col-6 js-fade-el">
										<div class="text-holder">
											<p>
												<?php echo $first_col_text; ?>
											</p>
										</div>
									</div>
									<div class="col-6 js-fade-el">
										<div class="text-holder">
											<p>
												<?php echo $second_col_text; ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					elseif (get_row_layout() == 'second_template') :
						$img = get_sub_field('img');
					?>
						<div class="img-full-width mt" style="background-image: url(<?php echo $img['sizes']['full']; ?>);">
						</div>
					<?php
					elseif (get_row_layout() == 'third_template') :
						$img_1 = get_sub_field('img_1');
						$img_2 = get_sub_field('img_2');

					?>
						<div class="images-block">
							<div class="container">
								<div class="row">
									<div class="col-6 js-fade-el">
										<div class="img-holder size-1">
											<img src="<?php echo $img_1['sizes']['full']; ?>" alt="<?php echo esc_attr($img_1['alt']); ?>">
										</div>
									</div>
									<div class="col-6 js-fade-el">
										<div class="img-holder size-1">
											<img src="<?php echo $img_2['sizes']['full']; ?>" alt="<?php echo esc_attr($img_1['alt']); ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					elseif (get_row_layout() == 'fourth_template') :
						$img = get_sub_field('img');
					?>
						<div class="images-block">
							<div class="container">
								<div class="row">
									<div class="col-12 js-fade-el">
										<div class="img-holder size-2">
											<img src="<?php echo $img['sizes']['full']; ?>" alt="<?php echo esc_attr($img['alt']); ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					elseif (get_row_layout() == 'fifth_template') :
						$img_1 = get_sub_field('img_1');
						$img_2 = get_sub_field('img_2');
						$img_3 = get_sub_field('img_3');
					?>
						<div class="images-block js-fade-el">
							<div class="container swiper swiper-mobile-gallery">
								<div class="row swiper-wrapper">
									<div class="col-4 swiper-slide">
										<div class="img-holder size-3">
											<img src="<?php echo $img_1['sizes']['full']; ?>" alt="<?php echo esc_attr($img_1['alt']); ?>">
										</div>
									</div>
									<div class="col-4 swiper-slide">
										<div class="img-holder size-3">
											<img src="<?php echo $img_2['sizes']['full']; ?>" alt="<?php echo esc_attr($img_2['alt']); ?>">
										</div>
									</div>
									<div class="col-4 swiper-slide">
										<div class="img-holder size-3">
											<img src="<?php echo $img_3['sizes']['full']; ?>" alt="<?php echo esc_attr($img_3['alt']); ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					elseif (get_row_layout() == 'sixth_template') :
						$text = get_sub_field('text');
					?>
						<div class="text-one-col">
							<div class="container">
								<div class="row">
									<div class="col-12 js-fade-el">
										<div class="text-holder">
											<p>
												<?php echo $text; ?>
											</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					elseif (get_row_layout() == 'seventh_template') :
						$img = get_sub_field('img');
						$text = get_sub_field('text');
					?>
						<div class="images-block">
							<div class="container">
								<div class="row">
									<div class="col-6 js-fade-el">
										<div class="img-holder size-1">
											<img src="<?php echo $img['sizes']['full']; ?>" alt="<?php echo esc_attr($img['alt']); ?>">
										</div>
									</div>
									<div class="col-6 text-col js-fade-el">
										<div class="text-holder">
											<?php echo $text; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					elseif (get_row_layout() == 'eighth_template') :
						$img = get_sub_field('img');
						$text = get_sub_field('text');
					?>
						<div class="images-block">
							<div class="container">
								<div class="row reversed">
									<div class="col-6 js-fade-el">
										<div class="img-holder size-1">
											<img src="<?php echo $img['sizes']['full']; ?>" alt="<?php echo esc_attr($img['alt']); ?>">
										</div>
									</div>
									<div class="col-6 text-col js-fade-el">
										<div class="text-holder">
											<?php echo $text; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php
					elseif (get_row_layout() == 'ninth_template') :
						$img_1 = get_sub_field('img_1');
						$img_2 = get_sub_field('img_2');
						$text = get_sub_field('text');
					?>
						<div class="images-block">
							<div class="container">
								<div class="row">
									<div class="col-4 js-fade-el">
										<div class="img-holder size-3">
											<img src="<?php echo $img_1['sizes']['full']; ?>" alt="<?php echo esc_attr($img_1['alt']); ?>">
										</div>
									</div>
									<div class="col-4 text-col style-2 js-fade-el">
										<div class="text-holder">
											<?php echo $text; ?>
										</div>
									</div>
									<div class="col-4 js-fade-el">
										<div class="img-holder size-3">
											<img src="<?php echo $img_2['sizes']['full']; ?>" alt="<?php echo esc_attr($img_2['alt']); ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
			<?php
					endif;


				endwhile;




			endif;
			?>
		</div>
		<div class="section_works">
			<div class="container">
				<div class="row">
					<?php
					$current_post_id = get_the_ID();

					$random_posts = get_posts([
						'numberposts' => 2,
						'orderby' => 'rand',
						'order' => 'DESC',
						'post_type' => 'works',
						'post_status' => 'publish',
						'suppress_filters' => true,
						'post__not_in' => [$current_post_id],
					], OBJECT);

					if (!empty($random_posts)) :
						foreach ($random_posts as $post) :
							setup_postdata($post);
							get_template_part('template-parts/content-works');
						endforeach;
						wp_reset_postdata();
					endif;
					?>
				</div>
			</div>
		</div>
		<div class="block-start">
			<div class="container">
				<span class="js-fade-el">
					<?php
					$random_case_title = get_field('section_ready-to-start-title', 'option');
					if ($random_case_title) {
						echo $random_case_title;
					}
					?>
				</span>
			</div>
		</div>
	</div>
</main><!-- #main -->
<?php

get_footer();
