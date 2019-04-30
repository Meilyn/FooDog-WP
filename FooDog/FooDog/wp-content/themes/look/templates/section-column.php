<?php
$look_ruby_column_counter = 0;
$look_ruby_check_column   = false;

if ( is_active_sidebar( 'look_ruby_blog_column_1' ) ) {
	$look_ruby_column_counter ++;
	$look_ruby_check_column = true;
}

if ( is_active_sidebar( 'look_ruby_blog_column_2' ) ) {
	$look_ruby_column_counter ++;
	$look_ruby_check_column = true;
}

if ( is_active_sidebar( 'look_ruby_blog_column_3' ) ) {
	$look_ruby_column_counter ++;
	$look_ruby_check_column = true;
}


$look_ruby_column_classes_el   = array();
$look_ruby_column_classes_el[] = 'promo-el';


if ( 1 == $look_ruby_column_counter ) {
	$look_ruby_column_classes_el[] = 'col-xs-12';
} elseif ( 2 == $look_ruby_column_counter ) {
	$look_ruby_column_classes_el[] = 'col-sm-6 col-xs-12';
} elseif ( 3 == $look_ruby_column_counter ) {
	$look_ruby_column_classes_el[] = 'col-sm-4 col-xs-12';
}

$look_ruby_column_classes_el = implode( ' ', $look_ruby_column_classes_el );

?>

<?php if ( true == $look_ruby_check_column ) : ?>

	<div class="promo-wrap">
		<div class="ruby-container">
			<div class="promo-inner row">
				<?php if ( is_active_sidebar( 'look_ruby_blog_column_1' ) ) : ?>
					<div class="<?php echo esc_attr( $look_ruby_column_classes_el ); ?>">
						<?php dynamic_sidebar( 'look_ruby_blog_column_1' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'look_ruby_blog_column_2' ) ) : ?>
					<div class="<?php echo esc_attr( $look_ruby_column_classes_el ); ?>">
						<?php dynamic_sidebar( 'look_ruby_blog_column_2' ); ?>
					</div>
				<?php endif; ?>

				<?php if ( is_active_sidebar( 'look_ruby_blog_column_3' ) ) : ?>
					<div class="<?php echo esc_attr( $look_ruby_column_classes_el ); ?>">
						<?php dynamic_sidebar( 'look_ruby_blog_column_3' ); ?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div><!--#promo wrap -->

<?php endif; ?>