<?php
if ( ! function_exists( 'look_ruby_info_el_category' ) ) {
	function look_ruby_info_el_category( $primary = true ) {

		$categories       = get_the_category();
		$primary_category = get_post_meta( get_the_ID(), 'look_ruby_single_primary_category', true );


		if ( empty( $primary_category ) || false === $primary ) {
			if ( ! empty( $categories ) && array( $categories ) ) {
				foreach ( $categories as $category ) {

					$classes = 'cat-info-el is-cat-' . esc_attr( $category->term_id );
					echo '<a class="' . esc_attr( $classes ) . '" href="' . get_category_link( $category->term_id ) . '" title="' . esc_attr( $category->name ) . '">';
					echo esc_html( $category->name );
					echo '</a>';
				}
			}
		} else {
			$primary_category_name = get_cat_name( $primary_category );
			$classes               = 'cat-info-el is-cat-' . esc_attr( $primary_category );

			echo '<a class="' . esc_attr( $classes ) . '" href="' . get_category_link( $primary_category ) . '" title="' . esc_attr( $primary_category_name ) . '">';
			echo esc_html( $primary_category_name );
			echo '</a>';
		}
	}
}


