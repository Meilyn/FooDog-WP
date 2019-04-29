<?php
/*
Template Name: Author Team
*/

look_ruby_template_wrapper::open_page_wrap( 'ruby-page-wrap page-author-team-wrap', 'none' );
echo '<div class="author-team-page-title post-title page-title"><h1>' . get_the_title() . '</h1></div>';
look_ruby_template_wrapper::open_page_inner( 'ruby-page-inner', 'none' );

$look_ruby_args = array(
	'blog_id'     => $GLOBALS['blog_id'],
	'orderby'     => 'login',
	'count_total' => false,
	'role__in'    => array( 'administrator', 'author', 'editor' )
);

$look_ruby_blog_users = get_users( $look_ruby_args );

$look_ruby_excepted_author_id = look_ruby_core::get_option( 'excepted_author_team_id' );
if ( ! empty( $look_ruby_excepted_author_id ) ) {
	$look_ruby_excepted_author_id = explode( ',', $look_ruby_excepted_author_id );
}

if ( ! empty( $look_ruby_blog_users ) ) {
	foreach ( $look_ruby_blog_users as $look_ruby_user ) :

		$look_ruby_user_id = $look_ruby_user->data->ID;

		//check exception user
		if ( ! empty( $look_ruby_excepted_author_id ) && is_array( $look_ruby_excepted_author_id ) && in_array( $look_ruby_user_id, $look_ruby_excepted_author_id ) ) {
			continue;
		}

		$look_ruby_blog_user_name     = $look_ruby_user->data->display_name;
		$look_ruby_blog_user_job      = '';
		$look_ruby_blog_user_decs     = '';
		$look_ruby_user_social_data   = look_ruby_social_data::author_data( $look_ruby_user_id );
		$look_ruby_user_render_social = look_ruby_social_bar::render( $look_ruby_user_social_data );

		if ( ! empty( $look_ruby_user_social_data['job'] ) ) {
			$look_ruby_blog_user_job = $look_ruby_user_social_data['job'];
		}

		if ( ! empty( $look_ruby_user_social_data['description'] ) ) {
			$look_ruby_blog_user_decs = $look_ruby_user_social_data['description'];
		}
		
		?>

		<div class="single-author-wrap">
			<div class="single-author-inner clearfix">
				<div class="author-thumb-wrap">
					<?php echo get_avatar( get_the_author_meta( 'user_email', $look_ruby_user_id ), 140, '', $look_ruby_blog_user_name ); ?>
				</div>
				<div class="author-content-wrap">
					<div class="author-title">
						<a href="<?php echo get_author_posts_url( $look_ruby_user_id ); ?>">
							<h3><?php echo esc_html( $look_ruby_blog_user_name ) ?></h3></a>
						<span class="author-job"><?php echo esc_html( $look_ruby_blog_user_job ); ?></span>
					</div>
					<?php if ( ! empty( $look_ruby_blog_user_decs ) ) : ?>
						<div class="author-description"><?php echo( $look_ruby_blog_user_decs ); ?></div>
					<?php endif; ?>
					<?php if ( ! empty( $look_ruby_user_render_social ) ) : ?>
						<div class="author-social"><?php echo( $look_ruby_user_render_social ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div><!--#author box -->

	<?php

	endforeach;
}


look_ruby_template_wrapper::close_page_inner();
look_ruby_template_wrapper::close_page_wrap();
