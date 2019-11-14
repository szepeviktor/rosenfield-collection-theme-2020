<?php
/**
 * Genesis Starter Theme.
 *
 * @package   SeoThemes\GenesisStarterTheme
 * @link      https://genesisstartertheme.com
 * @author    SEO Themes
 * @copyright Copyright © 2019 SEO Themes
 * @license   GPL-2.0-or-later
 */

namespace SeoThemes\GenesisStarterTheme\Functions;

\add_filter( 'genesis_register_widget_area_defaults', __NAMESPACE__ . '\front_page_1_heading', 10, 2 );
/**
 * Change Front Page 1 title to H1.
 *
 * @since 1.0.0
 *
 * @param array $defaults Default settings.
 * @param array $args     Other args.
 *
 * @return array
 */
function front_page_1_heading( $defaults, $args ) {
	if ( 'front-page-1' === $args['id'] ) {
		$defaults['before_title'] = '<h1 class="hero-title" itemprop="headline">';
		$defaults['after_title']  = "</h1>\n";
	}

	return $defaults;
}


\add_filter( 'genesis_widget_area_defaults', __NAMESPACE__ . '\widget_area_defaults', 10, 3 );
/**
 * Set default values for widget area output.
 *
 * @since 1.0.0
 *
 * @param array  $defaults Widget area defaults.
 * @param string $id       Widget area ID.
 *
 * @return array
 */
function widget_area_defaults( $defaults, $id ) {
	$hero = 'front-page-1' === $id ? ' hero-section" role="banner' : '';

	if ( false !== strpos( $id, 'front-page-' ) ) {
		$defaults['before'] = \genesis_markup(
			[
				'open'    => '<div class="' . $id . $hero . '"><div class="wrap">',
				'context' => 'widget-area-wrap',
				'echo'    => false,
				'params'  => [
					'id' => $id,
				],
			]
		);
		$defaults['after']  = \genesis_markup(
			[
				'close'   => '</div></div>',
				'context' => 'widget-area-wrap',
				'echo'    => false,
			]
		);
	}

	return $defaults;
}
