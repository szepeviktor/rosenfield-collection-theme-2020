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
 * Custom header image callback.
 *
 * @since 1.0.0
 *
 * @return string
 */
function header() : string {
	$id  = '';
	$url = '';

	if ( class_exists( 'WooCommerce' ) && \is_shop() ) {
		$id = \wc_get_page_id( 'shop' );
	} elseif ( \is_post_type_archive() ) {
		// phpcs:ignore WordPress.VIP.RestrictedFunctions.get_page_by_path_get_page_by_path
		$id = \get_page_by_path( \get_query_var( 'post_type' ) );
		$id = $id && \has_post_thumbnail( $id->ID ) ? $id->ID : false;
	} elseif ( is_category() ) {
		// phpcs:ignore WordPress.VIP.RestrictedFunctions.get_page_by_title_get_page_by_title
		$id = \get_page_by_title( 'category-' . \get_query_var( 'category_name' ), OBJECT, 'attachment' );
	} elseif ( is_tag() ) {
		// phpcs:ignore WordPress.VIP.RestrictedFunctions.get_page_by_title_get_page_by_title
		$id = \get_page_by_title( 'tag-' . \get_query_var( 'tag' ), OBJECT, 'attachment' );
	} elseif ( is_tax() ) {
		// phpcs:ignore WordPress.VIP.RestrictedFunctions.get_page_by_title_get_page_by_title
		$id = \get_page_by_title( 'term-' . \get_query_var( 'term' ), OBJECT, 'attachment' );
	} elseif ( is_front_page() ) {
		$id = \get_option( 'page_on_front' );
	} elseif ( is_home() ) {
		$id = \get_option( 'page_for_posts' );
	} elseif ( is_search() ) {
		// phpcs:ignore WordPress.VIP.RestrictedFunctions.get_page_by_path_get_page_by_path
		$id = \get_page_by_path( 'search' );
		$id = $id ? $id->ID : false;
	} elseif ( \is_404() ) {
		// phpcs:ignore WordPress.VIP.RestrictedFunctions.get_page_by_path_get_page_by_path
		$id = \get_page_by_path( 'error' );
		$id = $id ? $id->ID : false;
	} elseif ( \is_singular() ) {
		$id = \get_the_id();
	}

	if ( \is_object( $id ) ) {
		$url = \wp_get_attachment_image_url( $id->ID, 'object' );
	} elseif ( $id ) {
		$url = \get_the_post_thumbnail_url( $id, 'object' );
	}

	if ( ! $url ) {
		$url = \get_header_image();
	}

	if ( $url ) {
		$selector = \get_theme_support( 'custom-header', 'header-selector' );

		/** @noinspection CssUnknownTarget */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
		return \printf( '<style id="hero-css" type="text/css">' . esc_attr( $selector ) . '{background-image:url(%s)}</style>' . "\n", esc_url( $url ) );
	} else {
		return '';
	}
}
