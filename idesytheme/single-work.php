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
			<ul class="breadcrumb">
				<li>
					<a href="#">Home</a>
				</li>
				<li>
					<a href="#">Works</a>
				</li>
				<li>
					<span>Rich Prize</span>
				</li>
			</ul>
		</div>
		<div class="page-intro">
			<div class="container container-small">
				<div class="left-side">
					<?php the_title('<h1 class="h1 js-fade-el">', '</h1>'); ?>
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
		<div class="main-img js-fade-el" style="background-image: url('<?= $properties['works_post_main-img']['sizes']['full'] ?>');">
		</div>
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
								<div class="col-6 text-col">
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
				endif;


			endwhile;


		else :
			echo 'Гнучкий контент відсутній';

		endif;
		?>
		<!-- <div class="text-two-cols style-1">
			<div class="container container-small">
				<div class="row">
					<div class="col-6">
						<div class="text-holder">
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
						</div>
					</div>
					<div class="col-6">
						<div class="text-holder">
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="img-holder size-1">
							<img src="images/img-031.jpg" alt="...">
						</div>
					</div>
					<div class="col-6">
						<div class="img-holder size-1">
							<img src="images/img-030.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="img-holder size-2">
							<img src="images/img-033.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="text-one-col">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="text-holder">
							<p>These tracks are known for their fast pace, intense beats, and overall high energy, making them suitable for a fixed gear ride video that aims to capture speed and adrenaline. Always check and respect copyright regulations when using music in your videos.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container swiper swiper-mobile-gallery">
				<div class="row swiper-wrapper">
					<div class="col-4 swiper-slide">
						<div class="img-holder size-3">
							<img src="images/img-034.jpg" alt="...">
						</div>
					</div>
					<div class="col-4 swiper-slide">
						<div class="img-holder size-3">
							<img src="images/img-034.jpg" alt="...">
						</div>
					</div>
					<div class="col-4 swiper-slide">
						<div class="img-holder size-3">
							<img src="images/img-034.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="img-holder size-1">
							<img src="images/img-032.jpg" alt="...">
						</div>
					</div>
					<div class="col-6 text-col">
						<div class="text-holder">
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row reversed">
					<div class="col-6">
						<div class="img-holder size-1">
							<img src="images/img-032.jpg" alt="...">
						</div>
					</div>
					<div class="col-6 text-col">
						<div class="text-holder">
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="img-holder size-2">
							<img src="images/img-033.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="img-full-width mt" style="background-image: url(images/img-031.jpg);">
		</div>
		<div class="text-one-col">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="text-holder">
							<p>These tracks are known for their fast pace, intense beats, and overall high energy, making them suitable for a fixed gear ride video that aims to capture speed and adrenaline. Always check and respect copyright regulations when using music in your videos.</p>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="img-holder size-1">
							<img src="images/img-032.jpg" alt="...">
						</div>
					</div>
					<div class="col-6">
						<div class="img-holder size-1">
							<img src="images/img-032.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row">
					<div class="col-12">
						<div class="img-holder size-2">
							<img src="images/img-033.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="images-block">
			<div class="container">
				<div class="row">
					<div class="col-4">
						<div class="img-holder size-3">
							<img src="images/img-034.jpg" alt="...">
						</div>
					</div>
					<div class="col-4 text-col style-2">
						<div class="text-holder">
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
							<p>We’re specializing on the full-cycle gambling services from market audits to front-end code delivery. And continue supporting your product regularly boosted and up-to-date</p>
						</div>
					</div>
					<div class="col-4">
						<div class="img-holder size-3">
							<img src="images/img-034.jpg" alt="...">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="section_works">
			<div class="container">
				<div class="row">
					<div class="col-6">
						<div class="works-item">
							<h3 class="h3" data-before="///">woom.bet</h3>
							<div class="item-picture" style="background-image: url(images/img-06.jpg);"></div>
							<ul class="list-tags">
								<li><span>UI Kit</span></li>
								<li><span>Wireframes</span></li>
								<li><span>Ux/Ui</span></li>
							</ul>
							<a href="#" class="item-link">woom.bet</a>
						</div>
					</div>
					<div class="col-6">
						<div class="works-item">
							<h3 class="h3" data-before="///">woom.bet</h3>
							<div class="item-picture" style="background-image: url(images/img-06.jpg);"></div>
							<ul class="list-tags">
								<li><span>UI Kit</span></li>
								<li><span>Wireframes</span></li>
								<li><span>Ux/Ui</span></li>
							</ul>
							<a href="#" class="item-link">woom.bet</a>
						</div>
					</div>
				</div>
			</div>
		</div> -->
		<div class="block-start js-fade-el">
			<div class="container">
				<span>Ready to Start <br>the Project?</span>
			</div>
		</div>
	</div>
</main><!-- #main -->
<?php

get_footer();
