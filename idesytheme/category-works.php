<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package idesy
 */

get_header();
?>
<main class="main">
	<div class="works-page">
		<div class="container">
			<div aria-hidden="true" class="intro_title_line js-anim-intro-line" data-sroller-end="0"></div>
			<?php idesy_get_breadcrumbs(); ?>
			<div class="page-intro js-intro-w">
				<?php
				the_archive_title('<h1 class="h1 js-anim-intro-el">', '</h1>');
				?>
				<?php
				$latest_articles = new WP_Query(
					array(
						'post_type' => 'works',
						'posts_per_page' => 1,
						'orderby' => 'rand',
						'post_status' => 'publish',
					)
				);

				if ($latest_articles->have_posts()) :
					while ($latest_articles->have_posts()) :
						$latest_articles->the_post();
						get_template_part('template-parts/post_work_category');
					endwhile;
					wp_reset_postdata();
				else :
					echo '<p>No articles found</p>';
				endif;
				?>
			</div>
			<div class="section_works">
				<div class="row">
					<div aria-hidden="true" class="work_title_line js-anim-line" data-sroller-end="1000"></div>
					<?php if (have_posts()) : ?>
					<?php
						/* Start the Loop */
						while (have_posts()) :
							the_post();

							/*
							 * Include the Post-Type-specific template for the content.
							 * If you want to override this in a child theme, then include a file
							 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
							 */

							get_template_part('template-parts/content', get_post_type());


						endwhile;

						// Pagination using paginate_links()
						the_posts_pagination(
							array(
								'prev_text' => __('Previous', 'textdomain'),
								'next_text' => __('Next', 'textdomain'),
							)
						);

					else :

						get_template_part('template-parts/content-works', 'none');

					endif;
					?>
				</div>
			</div>
			<div class="block-start">
				<div aria-hidden="true" class="work_start_line js-anim-line" data-sroller-end="1000"></div>
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
		<svg class="bg-gradient" width="1920" height="1704" viewBox="0 0 1920 1704" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g filter="url(#filter0_f_1086_525)">
				<path d="M871.5 713L969.5 144L1181 727.5L1843.5 951.5L1047.5 1052L964.5 1448L878.5 1033.5L-97 802.5L871.5 713Z" fill="url(#paint0_diamond_1086_525)" fill-opacity="0.48" />
			</g>
			<defs>
				<filter id="filter0_f_1086_525" x="-353" y="-112" width="2452.5" height="1816" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
					<feFlood flood-opacity="0" result="BackgroundImageFix" />
					<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
					<feGaussianBlur stdDeviation="128" result="effect1_foregroundBlur_1086_525" />
				</filter>
				<radialGradient id="paint0_diamond_1086_525" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(847.038 809.332) rotate(90) scale(636.965 636.538)">
					<stop stop-color="#11376F" />
					<stop offset="1" stop-color="#116F64" />
				</radialGradient>
			</defs>
		</svg>
	</div>
</main><!-- #main -->
<?php

get_footer();
