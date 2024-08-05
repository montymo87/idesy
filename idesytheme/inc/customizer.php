<?php
/**
 * idesy Theme Customizer
 *
 * @package idesy
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function idesy_customize_register($wp_customize)
{
	$wp_customize->get_setting('blogname')->transport = 'postMessage';
	$wp_customize->get_setting('blogdescription')->transport = 'postMessage';
	$wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

	if (isset($wp_customize->selective_refresh)) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector' => '.site-title a',
				'render_callback' => 'idesy_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector' => '.site-description',
				'render_callback' => 'idesy_customize_partial_blogdescription',
			)
		);
	}

	$wp_customize->add_section(
		'header_section',
		array(
			'title' => esc_html__('Header', 'idesytheme'),
			'priority' => 39,
		)
	);

	$wp_customize->add_setting(
		'header_logo_text_1',
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'header_logo_text_1',
		array(
			'label' => esc_html__('Текст біля логотипа (1 частина)', 'idesytheme'),
			'section' => 'header_section',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'header_logo_text_2',
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'header_logo_text_2',
		array(
			'label' => esc_html__('Текст біля логотипа (2 частина)', 'idesytheme'),
			'section' => 'header_section',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'button_send_request',
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'button_send_request',
		array(
			'label' => esc_html__('Текст в кнопці (кнопка виклику форми)', 'idesytheme'),
			'section' => 'header_section',
			'type' => 'text',
		)
	);

	$wp_customize->add_section(
		'copyright_section',
		array(
			'title' => esc_html__('Footer', 'idesytheme'),
			'priority' => 40,
		)
	);

	$wp_customize->add_setting(
		'feedback_button_text_1',
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'feedback_button_text_1',
		array(
			'label' => esc_html__('Текст кнопки зворотнього зв\'язку (перше поле)', 'idesytheme'),
			'section' => 'copyright_section',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'feedback_button_text_2',
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'feedback_button_text_2',
		array(
			'label' => esc_html__('Текст кнопки зворотнього зв\'язку (друге поле)', 'idesytheme'),
			'section' => 'copyright_section',
			'type' => 'text',
		)
	);


	$wp_customize->add_setting(
		'copyright_text',
		array(
			'default' => '',
			'sanitize_callback' => 'sanitize_text_field',
		)
	);

	$wp_customize->add_control(
		'copyright_text',
		array(
			'label' => esc_html__('Текст копірайту', 'idesytheme'),
			'section' => 'copyright_section',
			'type' => 'text',
		)
	);

	$wp_customize->add_setting(
		'facebook_link',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'facebook_link',
		array(
			'label' => esc_html__('Посилання на Facebook', 'idesytheme'),
			'section' => 'copyright_section',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting(
		'instagram_link',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'instagram_link',
		array(
			'label' => esc_html__('Посилання на Instagram', 'idesytheme'),
			'section' => 'copyright_section',
			'type' => 'url',
		)
	);

	$wp_customize->add_setting(
		'behance_link',
		array(
			'default' => '',
			'sanitize_callback' => 'esc_url_raw',
		)
	);

	$wp_customize->add_control(
		'behance_link',
		array(
			'label' => esc_html__('Посилання на Behance', 'idesytheme'),
			'section' => 'copyright_section',
			'type' => 'url',
		)
	);

}
add_action('customize_register', 'idesy_customize_register');



/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function idesy_customize_partial_blogname()
{
	bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function idesy_customize_partial_blogdescription()
{
	bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function idesy_customize_preview_js()
{
	wp_enqueue_script('idesy-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'), _S_VERSION, true);
}
add_action('customize_preview_init', 'idesy_customize_preview_js');
