<?php

/**-------------------------------------------------------------------------------------------------------------------------
 * Class look_ruby_walker_backend
 * this file edit menu in backend
 */
//admin menu setting
class look_ruby_walker_backend extends Walker_Nav_Menu {
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
	}

	public function end_lvl( &$output, $depth = 0, $args = array() ) {
	}

	public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $_wp_nav_menu_max_depth;
		$_wp_nav_menu_max_depth = $depth > $_wp_nav_menu_max_depth ? $depth : $_wp_nav_menu_max_depth;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		ob_start();
		$item_id = esc_attr( $item->ID );

		//category mega menu
		if ( empty( $item->rubymegamenu_category ) ) {
			$look_ruby_item_rubymegamenu_category = null;
		} else {
			$look_ruby_item_rubymegamenu_category = esc_attr( $item->rubymegamenu_category[0] );
		}

		//column mega menu
		if ( empty( $item->rubymegamenu_column ) ) {
			$look_ruby_item_megamenu_column = null;
		} else {
			$look_ruby_item_megamenu_column = esc_attr( $item->rubymegamenu_column[0] );
		}

		if ( empty( $item->rubymegamenu_column_bg ) ) {
			$look_ruby_item_megamenu_column_bg = null;
		} else {
			$look_ruby_item_megamenu_column_bg = esc_attr( $item->rubymegamenu_column_bg );
		}


		$removed_args = array( 'action', 'customlink-tab', 'edit-menu-item', 'menu-item', 'page-tab', '_wpnonce', );

		$original_title = '';
		if ( 'taxonomy' == $item->type ) {
			$original_title = get_term_field( 'name', $item->object_id, $item->object, 'raw' );
			if ( is_wp_error( $original_title ) ) {
				$original_title = false;
			}
		} elseif ( 'post_type' == $item->type ) {
			$original_object = get_post( $item->object_id );
			$original_title  = $original_object->post_title;
		}

		$classes = array(
			'menu-item menu-item-depth-' . $depth,
			'menu-item-' . esc_attr( $item->object ),
			'menu-item-edit-' . ( ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? 'active' : 'inactive' ),
		);

		$title = $item->title;

		if ( ! empty( $item->_invalid ) ) {
			$classes[] = 'menu-item-invalid';
			$title     = sprintf( esc_html__( '%s (Invalid)', 'look' ), $item->title );
		} elseif ( isset( $item->post_status ) && 'draft' == $item->post_status ) {
			$classes[] = 'pending';
			$title     = sprintf( esc_html__( '%s (Pending)', 'look' ), $item->title );
		}

		$title = ( ! isset( $item->label ) || '' == $item->label ) ? $title : $item->label;

		$submenu_text = '';
		if ( 0 == $depth ) {
			$submenu_text = 'style="display: none;"';
		}
		?>

	<li id="menu-item-<?php echo esc_attr( $item_id ); ?>" class="<?php echo implode( ' ', $classes ); ?>">
		<dl class="menu-item-bar">
			<dt class="menu-item-handle">
                <span class="item-title"><span class="menu-item-title"><?php echo esc_html( $title ); ?></span> <span
		                class="is-submenu" <?php echo esc_attr( $submenu_text ); ?>><?php esc_html_e( 'sub item', 'look' ); ?></span></span>
                    <span class="item-controls">
                        <span class="item-type"><?php echo esc_html( $item->type_label ); ?></span>
                        <span class="item-order hide-if-js">
                            <a href="<?php echo wp_nonce_url( add_query_arg(array( 'action'    => 'move-up-menu-item','menu-item' => $item_id), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ))),'move-menu_item');?>" class="item-move-up"><abbr title="<?php esc_attr_e( 'Move up', 'look' ); ?>">&#8593;</abbr></a>|
                            <a href="<?php echo wp_nonce_url( add_query_arg( array( 'action'    => 'move-down-menu-item', 'menu-item' => $item_id), remove_query_arg( $removed_args, admin_url( 'nav-menus.php' ))), 'move-menu_item');?>" class="item-move-down"><abbr title="<?php esc_attr_e( 'Move down', 'look' ); ?>">&#8595;</abbr></a>
                        </span>
                        <a class="item-edit" id="edit-<?php echo esc_attr( $item_id ); ?>"
                           title="<?php echo esc_attr( 'Edit Menu Item' ); ?>" href="<?php
                        echo ( isset( $_GET['edit-menu-item'] ) && $item_id == $_GET['edit-menu-item'] ) ? admin_url( 'nav-menus.php' ) : esc_url( add_query_arg( 'edit-menu-item', $item_id, remove_query_arg( $removed_args, admin_url( 'nav-menus.php#menu-item-settings-' . $item_id ) ) ) );
                        ?>"><?php esc_html_e( 'Edit Menu Item', 'look' ); ?></a>
                    </span>
			</dt>
		</dl>

		<div class="menu-item-settings" id="menu-item-settings-<?php echo esc_attr( $item_id ); ?>">

			<?php if ( 'custom' == $item->type ) : ?>
				<p class="field-url description description-wide">
					<label for="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>">
						<?php esc_html_e( 'URL', 'look' ); ?><br/>
						<input type="text" id="edit-menu-item-url-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-url" name="menu-item-url[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_url( $item->url ); ?>"/>
					</label>
				</p>
			<?php endif; ?>

			<p class="description description-thin">
				<label for="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Navigation Label', 'look' ); ?><br/>
					<input type="text" id="edit-menu-item-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-title" name="menu-item-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->title ); ?>"/>
				</label>
			</p>

			<p class="description description-thin">
				<label for="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Title Attribute', 'look' ); ?><br/>
					<input type="text" id="edit-menu-item-attr-title-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-attr-title" name="menu-item-attr-title[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->post_excerpt ); ?>"/>
				</label>
			</p>

			<p class="field-link-target description">
				<label for="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>">
					<input type="checkbox" id="edit-menu-item-target-<?php echo esc_attr( $item_id ); ?>" value="_blank" name="menu-item-target[<?php echo esc_attr( $item_id ); ?>]"<?php checked( $item->target, '_blank' ); ?> />
					<?php esc_html_e( 'Open link in a new window/tab', 'look' ); ?>
				</label>
			</p>

			<p class="field-css-classes description description-thin">
				<label for="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'CSS Classes (optional)', 'look' ); ?><br/>
					<input type="text" id="edit-menu-item-classes-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-classes" name="menu-item-classes[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( implode( ' ', $item->classes ) ); ?>"/>
				</label>
			</p>

			<p class="field-xfn description description-thin">
				<label for="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Link Relationship (XFN)', 'look' ); ?><br/>
					<input type="text" id="edit-menu-item-xfn-<?php echo esc_attr( $item_id ); ?>" class="widefat code edit-menu-item-xfn" name="menu-item-xfn[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->xfn ); ?>"/>
				</label>
			</p>

			<!--# category mega menu -->
			<?php if ( 0 == $depth && ( ( $item->object == 'category' ) ) ) { ?>
				<p class="field-rubymegamenu description description-wide">
					<label class="ruby-meta-menu-label" for="edit-menu-item-rubymegamenu-category-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Category Mega Menu: ', 'look' ); ?></label>
					<input type="checkbox" id="edit-menu-item-rubymegamenu-category-<?php echo esc_attr( $item_id ); ?>" name="menu-item-rubymegamenu-category[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( $look_ruby_item_rubymegamenu_category, 1 ); ?> />
					<span style="display: block; font-size: 12px; font-style: italic; margin-top: 5px; color: #aaa"><?php esc_html_e( 'Display latest post of this category', 'look' ); ?></span>
				</p>
			<?php } ?>

			<!--#column mega menu -->
			<?php if ( $depth == 0 && ( $item->object == 'custom' ) ) { ?>
				<p class="field-rubymegamenu description description-wide">
					<label class="ruby-meta-menu-label" for="edit-menu-item-rubymegamenu-column-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Columns Mega Menu: ', 'look' ); ?></label>
					<input type="checkbox" id="edit-menu-item-rubymegamenu-column-<?php echo esc_attr( $item_id ); ?>"  name="menu-item-rubymegamenu-column[<?php echo esc_attr( $item_id ); ?>]" value="1" <?php checked( $look_ruby_item_megamenu_column, 1 ); ?> />
					<span style="display: block; font-size: 12px; font-style: italic; margin-top: 5px; color: #aaa"><?php esc_html_e( 'The theme support columns mega menu (4 columns)', 'look' ); ?></span>
				</p>

				<p class="field-rubymegamenu description description-wide">
					<label class="ruby-meta-menu-label" for="edit-menu-item-rubymegamenu-column-bg-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'BG Image URL: ', 'look' ); ?></label>
					<input type="text" id="edit-menu-item-rubymegamenu-column-bg-<?php echo esc_attr( $item_id ); ?>"  name="menu-item-rubymegamenu-column-bg[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_url( $look_ruby_item_megamenu_column_bg ); ?>"/>
					<span style="display: block; font-size: 12px; font-style: italic; margin-top: 5px; color: #aaa"><?php esc_html_e( 'Input url of image background for this mega menu, leave blank if you want to remove it', 'look' ); ?></span>
				</p>
			<?php } ?>

			<p class="field-description description description-wide">
				<label for="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>">
					<?php esc_html_e( 'Description', 'look' ); ?><br/>
					<textarea id="edit-menu-item-description-<?php echo esc_attr( $item_id ); ?>" class="widefat edit-menu-item-description" rows="3" cols="20" name="menu-item-description[<?php echo esc_attr( $item_id ); ?>]">
						<?php echo esc_html( $item->description ); ?></textarea>
					<span class="description"><?php esc_html_e( 'The description will be displayed in the menu if the current theme supports it.', 'look' ); ?></span>
				</label>
			</p>

			<p class="field-move hide-if-no-js description description-wide">
				<label>
					<span><?php esc_html_e( 'Move', 'look' ); ?></span>
					<a href="#" class="menus-move-up"><?php esc_html_e( 'Up one', 'look' ); ?></a>
					<a href="#" class="menus-move-down"><?php esc_html_e( 'Down one', 'look' ); ?></a>
					<a href="#" class="menus-move-left"></a>
					<a href="#" class="menus-move-right"></a>
					<a href="#" class="menus-move-top"><?php esc_html_e( 'To the top', 'look' ); ?></a>
				</label>
			</p>

			<div class="menu-item-actions description-wide submitbox">
				<?php if ( 'custom' != $item->type && $original_title !== false ) : ?>
					<p class="link-to-original">
						<?php printf( esc_html__( 'Original: %s', 'look' ), '<a href="' . esc_attr( $item->url ) . '">' . esc_html( $original_title ) . '</a>' ); ?>
					</p>
				<?php endif; ?>
				<a class="item-delete submitdelete deletion" id="delete-<?php echo esc_attr( $item_id ); ?>" href="<?php echo wp_nonce_url(add_query_arg( array('action'=> 'delete-menu-item','menu-item' => $item_id), admin_url( 'nav-menus.php' )),'delete-menu_item_' . $item_id); ?>"><?php esc_html_e( 'Remove', 'look' ); ?></a> <span class="meta-sep hide-if-no-js"> | </span>
				<a class="item-cancel submitcancel hide-if-no-js" id="cancel-<?php echo esc_attr( $item_id ); ?>"href="<?php echo esc_url( add_query_arg( array('edit-menu-item' => $item_id, 'cancel'=> time()), admin_url( 'nav-menus.php' ) ) );?>#menu-item-settings-<?php echo esc_attr( $item_id ); ?>"><?php esc_html_e( 'Cancel', 'look' ); ?></a>
			</div>

			<input class="menu-item-data-db-id" type="hidden" name="menu-item-db-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item_id ); ?>"/>
			<input class="menu-item-data-object-id" type="hidden" name="menu-item-object-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object_id ); ?>"/>
			<input class="menu-item-data-object" type="hidden" name="menu-item-object[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->object ); ?>"/>
			<input class="menu-item-data-parent-id" type="hidden" name="menu-item-parent-id[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_item_parent ); ?>"/>
			<input class="menu-item-data-position" type="hidden" name="menu-item-position[<?php echo esc_attr( $item_id ); ?>]" value="<?php echo esc_attr( $item->menu_order ); ?>"/>
			<input class="menu-item-data-type" type="hidden" name="menu-item-type[<?php echo esc_attr( $item_id ); ?>]"  value="<?php echo esc_attr( $item->type ); ?>"/>
		</div>
		<!-- .menu-item-settings-->
		<ul class="menu-item-transport"></ul>
		<?php
		$output .= ob_get_clean();
	}
}


if ( ! function_exists( 'look_ruby_megamenu_walker' ) ) {
	function look_ruby_megamenu_walker( $walker ) {
		if ( $walker === 'Walker_Nav_Menu_Edit' ) {
			$walker = 'look_ruby_walker_backend';
		}

		return $walker;
	}
}
add_filter( 'wp_edit_nav_menu_walker', 'look_ruby_megamenu_walker' );

if ( ! function_exists( 'look_ruby_megamenu_walker_save' ) ) {
	function look_ruby_megamenu_walker_save( $menu_id, $menu_item_db_id ) {

		//category menu
		if ( isset( $_POST['menu-item-rubymegamenu-category'][ $menu_item_db_id ] ) ) {
			update_post_meta( $menu_item_db_id, '_menu_item_rubymegamenu_category', $_POST['menu-item-rubymegamenu-category'][ $menu_item_db_id ] );
		} else {
			update_post_meta( $menu_item_db_id, '_menu_item_rubymegamenu_category', '0' );
		}

		//columns mega menu
		if ( isset( $_POST['menu-item-rubymegamenu-column'][ $menu_item_db_id ] ) ) {
			update_post_meta( $menu_item_db_id, '_menu_item_rubymegamenu_column', $_POST['menu-item-rubymegamenu-column'][ $menu_item_db_id ] );
		} else {
			update_post_meta( $menu_item_db_id, '_menu_item_rubymegamenu_column', '0' );
		}

		//coulumb mega background
		if ( isset( $_POST['menu-item-rubymegamenu-column-bg'][ $menu_item_db_id ] ) ) {
			update_post_meta( $menu_item_db_id, '_menu_item_rubymegamenu_column_bg', $_POST['menu-item-rubymegamenu-column-bg'][ $menu_item_db_id ] );
		} else {
			update_post_meta( $menu_item_db_id, '_menu_item_rubymegamenu_column_bg', '0' );
		}
	}
}

add_action( 'wp_update_nav_menu_item', 'look_ruby_megamenu_walker_save', 10, 2 );


if ( ! function_exists( 'look_ruby_megamenu_walker_loader' ) ) {
	function look_ruby_megamenu_walker_loader( $menu_item ) {
		$menu_item->rubymegamenu_category  = get_post_meta( $menu_item->ID, '_menu_item_rubymegamenu_category', true );
		$menu_item->rubymegamenu_column    = get_post_meta( $menu_item->ID, '_menu_item_rubymegamenu_column', true );
		$menu_item->rubymegamenu_column_bg = get_post_meta( $menu_item->ID, '_menu_item_rubymegamenu_column_bg', true );

		return $menu_item;
	}
}
add_filter( 'wp_setup_nav_menu_item', 'look_ruby_megamenu_walker_loader' );
