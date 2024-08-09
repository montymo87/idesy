<?php

/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package idesy
 */

?>
<!--  footer -->
<footer class="footer">
	<div class="container">
		<div class="footer_decor_circle" aria-hidden="true"></div>
		<div class="row">
			<div class="col-6">
				<div class="footer-block first-block">
					<span class="title-custom">
						<?php
						$feedback_button_text_2 = get_theme_mod('feedback_button_text_2', '');

						if (!empty($feedback_button_text_2)) {
							echo '<span data-text="' . esc_html($feedback_button_text_2) . '"></span>';
						}
						?>
						<?php
						$feedback_button_text_1 = get_theme_mod('feedback_button_text_1', '');

						if (!empty($feedback_button_text_1)) {
							echo '<span>' . esc_html($feedback_button_text_1) . '</span>';
						}
						?>
					</span>
					<div class="icon-holder">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-04.svg" alt="...">
					</div>
					<a href="#" class="block-link" toggle-modal="modal-contact-form">
						<?php
						$copyright_text = get_theme_mod('feedback_button_text_1', '');

						if (!empty($copyright_text)) {
							echo esc_html($copyright_text);
						}
						?>
						<?php
						$copyright_text = get_theme_mod('feedback_button_text_2', '');

						if (!empty($copyright_text)) {
							echo esc_html($copyright_text);
						}
						?>
					</a>
				</div>
			</div>
			<div class="col-6">
				<div class="footer-block second-block">
					<div class="block-img-1">
						<img src="<?php echo get_template_directory_uri(); ?>/assets/images/img-026.png" alt="...">
					</div>
					<div class="block-content">
						<a href="mailto:hello@idesy.agency" class="link-mail">hello@idesy.agency</a>
						<ul class="soc-links">
							<li>
								<a href="<?php echo get_theme_mod('facebook_link', '') ?>" target="_blank">
									<span class="icon-holder">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-01.svg" alt="...">
									</span>
									facebook
								</a>
							</li>
							<li>
								<a href="<?php echo get_theme_mod('instagram_link', '') ?>" target="_blank">
									<span class="icon-holder">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-02.svg" alt="...">
									</span>
									instagram
								</a>
							</li>
							<li>
								<a href="<?php echo get_theme_mod('behance_link', '') ?>" target="_blank">
									<span class="icon-holder">
										<img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon-03.svg" alt="...">
									</span>
									behance
								</a>
							</li>
						</ul>
						<p class="copyright">
							<?php
							$copyright_text = get_theme_mod('copyright_text', '');

							if (!empty($copyright_text)) {
								echo '<p class="copyright">' . esc_html($copyright_text) . '</p>';
							}
							?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</footer>
</div>
<!-- / footer -->
<div class="modal-overlay">
	<div class="modal" id="modal-contact-form">
		<div class="modal-header">
			<h3 class="modal-title">
				<?php
				$random_case_title = get_field('modal_contact-title', 'option');
				if ($random_case_title) {
					echo $random_case_title;
				}
				?>
			</h3>
			<button class="btn-close">
				<svg width="42" height="42" viewBox="0 0 42 42" fill="none" xmlns="http://www.w3.org/2000/svg">
					<path d="M38.2157 0.513042L41.9869 4.28428L28.7876 17.4836L25.0164 13.7124L38.2157 0.513042ZM13.7026 25.0261L17.4739 28.7973L4.27456 41.9966L0.50332 38.2254L13.7026 25.0261ZM28.7876 25.0261L41.9869 38.2254L38.2157 41.9966L25.0164 28.7973L28.7876 25.0261ZM4.27456 0.513042L17.4739 13.7124L13.7026 17.4836L0.50332 4.28428L4.27456 0.513042Z" fill="white" />
				</svg>
				<span class="sr-only">close modal</span>
			</button>
		</div>
		<div class="contact-form">
			<?php echo do_shortcode('[cf7form cf7key="%d0%ba%d0%be%d0%bd%d1%82%d0%b0%d0%ba%d1%82%d0%bd%d0%b0-%d1%84%d0%be%d1%80%d0%bc%d0%b0-1"]'); ?>
		</div>
	</div>
</div>
<!-- #page -->
<?php wp_footer(); ?>
</body>

</html>