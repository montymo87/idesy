<?php

/**
 *  Template name: Homepage
 */
get_header();

$properties = function_exists('get_fields') ? get_fields() : [];
?>
<div class="home-page">
	<svg class="graphic-2" width="2154" height="1907" viewBox="0 0 2154 1907" fill="none" xmlns="http://www.w3.org/2000/svg">
		<g filter="url(#filter0_f_154_4)">
			<path class="path-graphic-2" d="M1014 1626.5C984.579 1462.66 1077 1177 1077 1177C1077 1177 285.744 872.828 257.5 825.5C229.256 778.172 1291.07 759.59 1291.07 759.59C1291.07 759.59 1296.1 140.218 1367.5 276.5C1575.31 673.124 1536.79 1264.63 1529.73 1352.27C1530.1 1351.98 1530.46 1351.7 1530.83 1351.41L1653.79 640.183L1897.91 1051.24C1897.91 1051.24 1724.26 1201.44 1530.83 1351.41L1528.78 1363.27C1528.78 1363.27 1529.15 1359.48 1529.73 1352.27C1294.35 1534.68 1030.13 1716.34 1014 1626.5Z" fill="url(#paint0_diamond_154_4)" fill-opacity="0.64" />
		</g>
		<defs>
			<filter id="filter0_f_154_4" x="0.94635" y="0.908508" width="2152.97" height="1905.3" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
				<feFlood flood-opacity="0" result="BackgroundImageFix" />
				<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
				<feGaussianBlur stdDeviation="128" result="effect1_foregroundBlur_154_4" />
			</filter>
			<radialGradient id="paint0_diamond_154_4" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(1219.89 944.193) rotate(-120.706) scale(518.057 528.304)">
				<stop stop-color="#11376F" />
				<stop offset="1" stop-color="#116F64" />
			</radialGradient>
		</defs>
	</svg>
	<div class="section_intro">
		<svg class="graphic-1" width="1248" height="720" viewBox="0 0 1248 720" fill="none" xmlns="http://www.w3.org/2000/svg">
			<g filter="url(#filter0_f_468_170824)">
				<path class="path-graphic-1" d="M1088 0L401.5 9L731 464.5L234 292.5L130.5 559.5L287.227 -81.8568L236.085 -87.0846L-37 232.5V-115L236.085 -87.0846L309.5 -173L287.227 -81.8568L1088 0Z" fill="url(#paint0_diamond_468_170824)" />
			</g>
			<defs>
				<filter id="filter0_f_468_170824" x="-197" y="-333" width="1445" height="1052.5" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
					<feFlood flood-opacity="0" result="BackgroundImageFix" />
					<feBlend mode="normal" in="SourceGraphic" in2="BackgroundImageFix" result="shape" />
					<feGaussianBlur stdDeviation="80" result="effect1_foregroundBlur_468_170824" />
				</filter>
				<radialGradient id="paint0_diamond_468_170824" cx="0" cy="0" r="1" gradientUnits="userSpaceOnUse" gradientTransform="translate(525.5 193.25) rotate(90) scale(366.25 562.5)">
					<stop stop-color="#116F49" />
					<stop offset="1" stop-color="#11696F" stop-opacity="0.83" />
				</radialGradient>
			</defs>
		</svg>
		<div class="container">
			<div class="title-wrapper">
				<h1 class="h1">The <span>i</span><span>Gaming</span> <br> <span>Des</span>ign Agenc<span>y</span></h1>
				<div class="decor-title">
					<div class="chip chip-1"></div>
					<div class="chip chip-2"></div>
					<img class="title_img" src="<?php echo get_template_directory_uri(); ?>/assets/images/idesy.svg" alt="...">
					<div id="svgWrapper">
						<div id="svg" class="method2"></div>
					</div>
				</div>
			</div>
			<div class="text-holder">
				<?php if (!empty($properties['text_two_cols'])) : ?>
					<?= $properties['text_two_cols'] ?>
				<?php endif; ?>
			</div>
			<div class="marquee-group">
				<div class="marquee" marquee>
					<?php if (!empty($properties['marquee'])) : ?>
						<?= $properties['marquee'] ?>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
	<div class="section_cooperate">
		<div class="container">
			<div class="section-header">
				<h2 class="title-custom title-custom-1">
					<?php if (!empty($properties['section_2_title'])) : ?>
						<?= $properties['section_2_title'] ?>
					<?php endif; ?>
				</h2>
				<div class="header-img"></div>
				<p class="header-text">
					<?php if (!empty($properties['section_2_text'])) : ?>
						<?= $properties['section_2_text'] ?>
					<?php endif; ?>
				</p>
			</div>
			<div class="row">
				<?php
				$section_2_blocks = $properties['section_2_blocks'];
				if ($section_2_blocks) {
					foreach ($section_2_blocks as $block) {
						$block_title = $block['block_title'];
						$block_images = $block['block_img'];
						$block_link = $block['block_link'];

						echo '<div class="col-3"><div class="cooperate-card">';

						if (is_array($block_images) && !empty($block_images)) {
							$large_image_url = $block_images['sizes']['full'];
							echo '<img src="' . esc_url($large_image_url) . '" class="card-img" alt="' . esc_attr($block_images['alt']) . '">';
						}
						echo '<h3 class="card-title">' . wp_kses($block_title, 'post') . '</h3>';
						echo '<a href="' . esc_url($block_link) . '" class="card-link">' . esc_html__('Детальніше', 'your-text-domain') . '</a>';
						echo '</div></div>';
					}
				}
				?>
			</div>
		</div>
	</div>
	<div class="section_latest-works">
		<div class="container">
			<div aria-hidden="true" class="title_line_1 js-anim-line"></div>
			<h2 class="title-custom title-custom-2">
				<?php if (!empty($properties['section_3_title'])) : ?>
					<?= $properties['section_3_title'] ?>
				<?php endif; ?>
			</h2>
			<div class="cards-holder">
				<?php
				$latest_articles = new WP_Query(
					array(
						'post_type' => 'works',
						'posts_per_page' => 3,
						'orderby' => 'date',
						'order' => 'DESC',
						'post_status' => 'publish',
					)
				);

				if ($latest_articles->have_posts()) :
					while ($latest_articles->have_posts()) :
						$latest_articles->the_post();
						get_template_part('template-parts/post_work_home');
					endwhile;
					wp_reset_postdata();
				else :
					echo '<p>No articles found</p>';
				endif;
				?>
			</div>
		</div>
	</div>
	<div class="section_pride">
		<div class="container">
			<div class="text-holder">
				<?php if (!empty($properties['section_4_text'])) : ?>
					<?= $properties['section_4_text'] ?>
				<?php endif; ?>
			</div>
			<?php if (!empty($properties['section_4_video'])) : ?>
				<div class="video-holder">
					<video src="<?= $properties['section_4_video']['url'] ?>" poster="<?= $properties['section_4_video-poster']['sizes']['full'] ?>" loop muted></video>
				</div>
			<?php endif; ?>
			<div class="cards-holder">
				<div class="left-side">
					<?php if (!empty($properties['section_4_cards'])) : ?>
						<div class="img-holder">
							<img src="<?= $properties['section_4_cards']['0']['card_img']['sizes']['full'] ?>" alt="<?= $properties['section_4_cards']['0']['card_img']['alt'] ?>">
						</div>
					<?php endif; ?>
					<?php if (!empty($properties['section_4_cards'])) : ?>
						<div class="img-holder">
							<img src="<?= $properties['section_4_cards']['1']['card_img']['sizes']['full'] ?>" alt="<?= $properties['section_4_cards']['1']['card_img']['alt'] ?>">
						</div>
					<?php endif; ?>
				</div>
				<div class="right-side">
					<?php if (!empty($properties['section_4_cards'])) : ?>
						<div class="img-holder">
							<img src="<?= $properties['section_4_cards']['2']['card_img']['sizes']['full'] ?>" alt="<?= $properties['section_4_cards']['2']['card_img']['alt'] ?>">
						</div>
					<?php endif; ?>
					<?php if (!empty($properties['section_4_cards'])) : ?>
						<div class="img-holder">
							<img src="<?= $properties['section_4_cards']['3']['card_img']['sizes']['full'] ?>" alt="<?= $properties['section_4_cards']['3']['card_img']['alt'] ?>">
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
		<div class="section-illustration">
			<div class="section_illustration__line">
				<svg viewBox="0 0 250 250" preserveAspectRatio="xMidYMid meet">
					<circle cx="125" cy="125" r="125" stroke="white" fill="none" />
				</svg>
			</div>
		</div>
	</div>
	<div class="section_result_w">
		<div aria-hidden="true" class="title_line_2 js-anim-line" data-sroller-end="1000"></div>
		<div class="section_result">
			<div class="container">
				<h2 class="title-custom title-custom-3">
					<?php if (!empty($properties['section_5_title'])) : ?>
						<?= $properties['section_5_title'] ?>
					<?php endif; ?>
				</h2>
				<div>
					<div class="list-holder">
						<span class="list-title">
							<?php if (!empty($properties['section_5_title_2'])) : ?>
								<?= $properties['section_5_title_2'] ?>
							<?php endif; ?>
						</span>
						<ul class="list-result">
							<?php
							$section_5_list = $properties['section_5_list'];
							if ($section_5_list) {
								foreach ($section_5_list as $item) {
									$block_title = $item['item_title'];
									$block_images = $item['item_img'];

									echo '<li><div class="img-holder">';
									if (is_array($block_images) && !empty($block_images)) {
										$image_url = $block_images['sizes']['full'];
										echo '<img src="' . esc_url($image_url) . '"  alt="' . esc_attr($block_images['alt']) . '">';
									}
									echo '</div>';
									echo '<span class="li-title">' . wp_kses($block_title, 'post') . '</span>';
									echo '</li>';
								}
							}
							?>
						</ul>
					</div>
					<div class="list-holder">
						<span class="list-title">
							<?php if (!empty($properties['section_5_title_3'])) : ?>
								<?= $properties['section_5_title_3'] ?>
							<?php endif; ?>
						</span>
						<ul class="list-result">
							<?php
							$section_5_list = $properties['section_5_list_2'];
							if ($section_5_list) {
								foreach ($section_5_list as $item) {
									$block_title = $item['item_title'];
									$block_images = $item['item_img'];

									echo '<li><div class="img-holder">';
									if (is_array($block_images) && !empty($block_images)) {
										$image_url = $block_images['sizes']['full'];
										echo '<img src="' . esc_url($image_url) . '"  alt="' . esc_attr($block_images['alt']) . '">';
									}
									echo '</div>';
									echo '<span class="li-title">' . wp_kses($block_title, 'post') . '</span>';
									echo '</li>';
								}
							}
							?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="section_answer">
		<div class="container">
			<h2 class="title-custom title-custom-4">
				<?php if (!empty($properties['section_6_title'])) : ?>
					<?= $properties['section_6_title'] ?>
				<?php endif; ?>
			</h2>
			<div class="row">
				<div class="col-6">
					<?php
					$section_6_accordions_1 = $properties['section_6_accordions_left'];
					if ($section_6_accordions_1) {
						foreach ($section_6_accordions_1 as $item) {
							$block_title = $item['accordion_title'];
							$block_text = $item['accordion_text'];

							echo '<div class="accordion" accordion-item><div class="accordion-header">';
							echo '<h3>' . wp_kses($block_title, 'post') . '</h3>';
							echo '</div>';
							echo '<div class="accordion-body accordion-collapse"><div class="text-holder"><p>';
							echo wp_kses($block_text, 'post');
							echo '</p></div></div></div>';
						}
					}
					?>
				</div>
				<div class="col-6">
					<?php
					$section_6_accordions_2 = $properties['section_6_accordions_right'];
					if ($section_6_accordions_2) {
						foreach ($section_6_accordions_2 as $item) {
							$block_title = $item['accordion_title'];
							$block_text = $item['accordion_text'];

							echo '<div class="accordion" accordion-item><div class="accordion-header">';
							echo '<h3>' . wp_kses($block_title, 'post') . '</h3>';
							echo '</div>';
							echo '<div class="accordion-body accordion-collapse"><div class="text-holder"><p>';
							echo wp_kses($block_text, 'post');
							echo '</p></div></div></div>';
						}
					}
					?>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
<?php
get_footer();
