<?php
/**
 * Rosenfield Collection Theme.
 *
 * @package   RosenfieldCollection\Theme2020
 * @link      https://www.rosenfieldcollection.com
 * @author    Clayton Collie
 * @copyright Copyright © 2019 Clayton Collie
 * @license   GPL-2.0-or-later
 */

namespace RosenfieldCollection\Theme2020\Functions;

/**
 * Display alphebtical filter for artist
 *
 * @since  1.0.0
 */
function do_artist_filter() {
	$field = get_field_object( 'field_5e17ad49aa83c' );

	if ( ! empty( $field ) ) {
		$letters = $field['choices'];

		if ( ! empty( $letters ) ) {
			echo '<section id="rosenfield-collection-artist-filter" class="author-filter"><ul>';

			printf(
				'<li class="%s"><a href="%s"><span class="screen-reader-text">%s</span> %s</a></li>',
				get_query_var( 'artist_filter' ) === '' ? 'current' : '',
				esc_url( get_permalink( get_page_by_path( 'artists', OBJECT, 'page' ) ) ),
				esc_html__( 'Go to page', 'rosenfield-collection-2020' ),
				esc_html__( 'All Artists', 'rosenfield-collection-2020' )
			);

			foreach ( $letters as $letter ) {
				printf(
					'<li class="%s"><a href="%s"><span class="screen-reader-text">%s</span> %s</a></li>',
					get_query_var( 'artist_filter' ) === $letter ? 'current' : '',
					esc_url(
						add_query_arg(
							'artist_filter',
							$letter,
							get_permalink()
						)
					),
					esc_html__( 'Filter artist by the letter', 'rosenfield-collection-2020' ),
					esc_html( ucwords( $letter ) )
				);
			}

			echo '</ul></section>';
		}
	}
}

