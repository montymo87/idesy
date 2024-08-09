<?php

/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package idesy
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<style>
		body {
			visibility: hidden;
			opacity: 0;
			transition: opacity 0.3s ease-in-out;
		}
	</style>
	<?php wp_body_open(); ?>
	<div class="wrapper">
		<!-- <a class="skip-link screen-reader-text" href="#primary">
				<?php esc_html_e('Skip to content', 'idesy'); ?>
			</a> -->
		<!--  header -->
		<header class="header">
			<div class="container">
				<div class="left-side">
					<?php
					$custom_logo_id = get_theme_mod('custom_logo');
					$custom_logo_url = wp_get_attachment_image_src($custom_logo_id, 'full');

					if ($custom_logo_id) {

					?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-holder">
							<img src="<?php echo esc_url($custom_logo_url[0]); ?>" alt="<?php bloginfo('name'); ?>" />
						</a>
					<?php
					} else {

					?>
						<a href="<?php echo esc_url(home_url('/')); ?>" class="logo-holder">
							<img src="<?php echo get_template_directory_uri(); ?>/assets/images/logo.svg" alt="<?php bloginfo('name'); ?>" />
						</a>
					<?php
					}

					$legacytheme_description = get_bloginfo('description', 'display');
					if ($legacytheme_description || is_customize_preview()) :
					?>
						<p class="site-description">
							<?php echo $legacytheme_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped                        
							?>
						</p>
					<?php endif; ?>
					<div class="logo-text">
						<?php
						$header_logo_text_1 = get_theme_mod('header_logo_text_1', '');

						if (!empty($header_logo_text_1)) {
							echo '<p>' . esc_html($header_logo_text_1) . '</p>';
						}
						?>
						<?php
						$header_logo_text_2 = get_theme_mod('header_logo_text_2', '');

						if (!empty($header_logo_text_2)) {
							echo '<p>' . esc_html($header_logo_text_2) . '</p>';
						}
						?>
					</div>
				</div>
				<div class="right-side">
					<nav class="main-navigation" id="site-navigation">
						<div class="inner-holder">
							<?php
							wp_nav_menu(
								array(
									'theme_location' => 'primary',
									// 'menu_id' => 'primary-menu',
								)
							);
							?>
						</div>
						<div class="langs-list">
							<?php
							$languages = array(
								'ua' => '/images/flag-ua.svg',
								'en' => '/images/flag-en.svg'
							);

							$current_language = 'ua';

							$translations = pll_the_languages(array('raw' => 1));

							foreach ($languages as $lang => $img_path) {
								$active_class = ($lang === $current_language) ? ' active' : '';
								echo '<a href="' . $translations[$lang]['url'] . '" class="btn-select' . $active_class . '">';
								echo '<span class="icon-holder">';
								echo '<img src="' . get_stylesheet_directory_uri() . '/assets' . $img_path . '" alt="' . $lang . '">';
								echo '</span>';
								echo ucfirst($lang);
								echo '</a>';
							}
							?>
						</div>
					</nav>
					<a href="#" class="btn btn-md btn-primary" toggle-modal="modal-contact-form">
						<?php
						$button_send_request = get_theme_mod('button_send_request', '');

						if (!empty($button_send_request)) {
							echo esc_html($button_send_request);
						}
						?>
					</a>
					<div class="lang-select">
						<?php
						$translations = pll_the_languages(array('raw' => 1));
						$lang_current = '';
						$lang_list = '';
						foreach ($translations as $lang) {
							if ($lang["current_lang"]) {
								$lang_current = '' . $lang["slug"] . '';
							} else {
								$lang_list .= '<li class="dropdown-item"><a class="btn-select" href="' . $lang["url"] . '"><span class="icon-holder"><img src="' . get_template_directory_uri() . '/assets/images/flag-' . $lang["slug"] . '.svg" alt="' . $lang["slug"] . ' flag" /></span>' . ucfirst($lang["slug"]) . '</a></li>';
							}
						}
						?>
						<button class="btn-select">
							<span class="icon-holder">
								<img src="<?php echo get_template_directory_uri(); ?>/assets/images/flag-<?php echo $lang_current; ?>.svg" alt="flag name" />
							</span>
							<?= ucfirst($lang_current) ?>
							<svg width="7" height="6" viewBox="0 0 7 6" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M3.93301 5.25C3.74056 5.58333 3.25944 5.58333 3.06699 5.25L0.901924 1.5C0.709474 1.16667 0.950037 0.75 1.33494 0.75L5.66506 0.75C6.04996 0.75 6.29053 1.16667 6.09808 1.5L3.93301 5.25Z" fill="white" />
							</svg>
						</button>
						<ul class="lang-dropdown">
							<li class="dropdown-item">
								<?php if (!empty($lang_list)) : ?>
									<?= $lang_list ?>
								<?php endif; ?>
							</li>
						</ul>
					</div>
					<a href="#" class="btn-toggle-menu">
					</a>
				</div>
			</div>
		</header>
		<!-- / header -->