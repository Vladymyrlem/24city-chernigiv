<?php


function customtaxorder_register_settings() {
	register_setting('customtaxorder_settings', 'customtaxorder_settings', 'customtaxorder_settings_validate');
	register_setting('customtaxorder_settings', 'customtaxorder_taxonomies', 'customtaxorder_taxonomies_validate');
}
add_action('admin_init', 'customtaxorder_register_settings');


function customtaxorder_settings_validate($input) {

	$taxonomies = customtaxorder_get_taxonomies() ;

	foreach ( $taxonomies as $taxonomy ) {
		if ( $input[$taxonomy->name] != 1 ) {
			if ( $input[$taxonomy->name] != 2 ) {
				if ( $input[$taxonomy->name] != 3 ) {
					$input[$taxonomy->name] = 0; //default
				}
			}
		}
	}
	$output = array();
	foreach ( $input as $key => $value) {
		$key = (string) sanitize_text_field( $key );
		$output[$key] = (int) $value;
	}
	return $output;
}
function customtaxorder_taxonomies_validate($input) {
	$input = (string) sanitize_text_field( $input );
	return $input;
}


/*
 * Add all the admin menu pages.
 */
function customtaxorder_menu() {

	$taxonomies = customtaxorder_get_taxonomies() ;

	$taxonomies = customtaxorder_sort_taxonomies( $taxonomies );
	// Set your custom capability through this filter.
	$custom_cap = apply_filters( 'customtaxorder_custom_cap', 'manage_categories' );

	//add_menu_page( string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', string $icon_url = '', int $position = null )
	add_menu_page(esc_html__('Term Order', 'custom-taxonomy-order-ne'), esc_html__('Term Order', 'custom-taxonomy-order-ne'), $custom_cap, 'customtaxorder', 'customtaxorder_subpage', 'dashicons-list-view', 122.35);
	//add_submenu_page( string $parent_slug, string $page_title, string $menu_title, string $capability, string $menu_slug, callable $function = '', int $position = null )
	add_submenu_page('customtaxorder', esc_html__('Order Taxonomies', 'custom-taxonomy-order-ne'), esc_html__('Order Taxonomies', 'custom-taxonomy-order-ne'), $custom_cap, 'customtaxorder-taxonomies', 'custom_taxonomy_order');

	foreach ($taxonomies as $taxonomy ) {
		// Set your finegrained capability for this taxonomy for this custom filter.
		$custom_cap_tax = apply_filters( 'customtaxorder_custom_cap_' . $taxonomy->name, $custom_cap );
		add_submenu_page('customtaxorder', esc_html__('Order ', 'custom-taxonomy-order-ne') . $taxonomy->label, esc_html__('Order ', 'custom-taxonomy-order-ne') . $taxonomy->label, $custom_cap_tax, 'customtaxorder-'.$taxonomy->name, 'customtaxorder_subpage');
	}
	add_submenu_page('customtaxorder', esc_html__('About', 'custom-taxonomy-order-ne'), esc_html__('About', 'custom-taxonomy-order-ne'), $custom_cap, 'customtaxorder-about', 'customtaxorder_about');
}
add_action('admin_menu', 'customtaxorder_menu');


function customtaxorder_css() {
	if ( isset($_GET['page']) ) {
		$pos_page = $_GET['page'];
		$pos_args = 'customtaxorder';
		$pos = strpos($pos_page,$pos_args);
		if ( $pos === false ) {} else {
			wp_enqueue_style('customtaxorder', plugins_url( 'css/customtaxorder.css', __FILE__), false, CUSTOMTAXORDER_VER, 'screen' );
		}
	}
}
add_action('admin_print_styles', 'customtaxorder_css');


function customtaxorder_js_libs() {
	if ( isset($_GET['page']) ) {
		$pos_page = $_GET['page'];
		$pos_args = 'customtaxorder';
		$pos = strpos($pos_page,$pos_args);
		if ( $pos === false ) {} else {
			wp_enqueue_script( 'jquery' );
			wp_enqueue_script( 'jquery-ui-core' );
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_script( 'customtaxorder', plugins_url( '/js/script.js', __FILE__ ), 'jquery-ui-sortable', CUSTOMTAXORDER_VER, true );
		}
	}
}
add_action('admin_print_scripts', 'customtaxorder_js_libs');


/*
 * Add term_order input to tag edit screen.
 * @since 3.1.0
 */
function customtaxorder_tag_edit_screen() {

	$taxonomies = customtaxorder_get_taxonomies() ;
	$options = customtaxorder_get_settings();

	foreach ( $taxonomies as $taxonomy ) {
		if ( is_object($taxonomy) && isset($taxonomy->name) ) {
			if ( ! isset($options[$taxonomy->name]) ) {
				$options[$taxonomy->name] = 0; // default if not set in options yet
			}
			if ( $options[$taxonomy->name] == 1 ) { // only when custom order is enabled.
				add_action( "{$taxonomy->name}_add_form_fields",  'customtaxorder_term_order_add_form_field', 10, 1 );
				add_action( "{$taxonomy->name}_edit_form_fields", 'customtaxorder_term_order_edit_form_field', 10, 2 );
			}
		}
	}
}
add_action( 'admin_init', 'customtaxorder_tag_edit_screen' );


/*
 * Output the "term_order" form field when adding a new term.
 * @param string $taxonomy the name of the taxonomy.
 * @since 3.1.0
 */
function customtaxorder_term_order_add_form_field( $taxonomy ) {
	$options = customtaxorder_get_settings();
	if ( isset($options[$taxonomy]) && $options[$taxonomy] == 1 ) {
		?>
		<div class="form-field form-required">
			<label for="term_order">
				<?php esc_html_e( 'Order', 'custom-taxonomy-order-ne' ); ?>
			</label>
			<input type="number" pattern="[0-9.]+" name="term_order" id="term_order" value="0" size="11">
			<p class="description">
				<?php esc_html_e( 'This taxonomy is sorted based on custom order. You can choose your own order by entering a number (1 for first, etc.) in this field.', 'custom-taxonomy-order-ne' ); ?>
			</p>
		</div>
		<?php
	}
}


/*
 * Output the "term_order" form field when editing an existing term.
 * @param object $term WP_Term Current taxonomy term object.
 * @param string $taxonomy the name of the taxonomy.
 * @since 3.1.0
 */
function customtaxorder_term_order_edit_form_field( $term, $taxonomy ) {
	$options = customtaxorder_get_settings();
	if ( isset($options[$taxonomy]) && $options[$taxonomy] == 1 ) {
		if ( is_object($term) && isset($term->term_order) ) {
			$term_order = $term->term_order;
		} else {
			$term_order = 0;
		}
		?>
		<tr class="form-field">
			<th scope="row" valign="top">
				<label for="term_order">
					<?php esc_html_e( 'Order', 'custom-taxonomy-order-ne' ); ?>
				</label>
			</th>
			<td>
				<input name="term_order" id="term_order" type="text" value="<?php echo $term_order; ?>" size="11" />
				<p class="description">
					<?php
					esc_html_e( 'This taxonomy is sorted based on custom order. You can choose your own order by entering a number (1 for first, etc.) in this field.', 'custom-taxonomy-order-ne' );
					if ( isset($term->parent) && $term->parent != 0 ) {
						echo '<br />';
						esc_html_e( 'This sub-term will be sorted after the parent term, the order entered here is relative to other sub-terms.', 'custom-taxonomy-order-ne' );
					}
					?>
				</p>
			</td>
		</tr>
		<?php
	}
}


/*
 * Set `term_order` to term when updating
 * @since 3.1.0
 * @param  int     $term_id   The ID of the term
 * @param  int     $tt_id     Not used
 * @param  string  $taxonomy  Taxonomy of the term
 */
function customtaxorder_add_term_order( $term_id = 0, $tt_id = 0, $taxonomy = '' ) {
	if ( ! isset($_POST['term_order']) ) {
		return;
	}
	if ( $term_id == 0 ) {
		return;
	}
	$term = get_term( $term_id, $taxonomy );
	if ( ! is_object( $term ) ) {
		return;
	}

	$term_order = (int) $_POST['term_order'];

	customtaxorder_set_db_term_order( $term_id, $term_order, $taxonomy );
}
add_action( 'create_term', 'customtaxorder_add_term_order', 10, 3 );
add_action( 'edit_term',   'customtaxorder_add_term_order', 10, 3 );



/*
 * Set `term_order` in database for term.
 * @since 3.1.0
 * @param  int     $term_id    The ID of the term.
 * @param  int     $term_order The order of the term.
 * @param  string  $taxonomy   Taxonomy of the term.
 */
function customtaxorder_set_db_term_order( $term_id = 0, $term_order = 0, $taxonomy = '' ) {
	global $wpdb;

	if ( $term_id == 0 ) {
		return;
	}
	$term = get_term( $term_id, $taxonomy );
	if ( ! is_object( $term ) ) {
		return;
	}

	$wpdb->query( $wpdb->prepare(
		"
			UPDATE $wpdb->terms SET term_order = '%d' WHERE term_id ='%d'
		",
		$term_order,
		$term_id
	) );
	$wpdb->query( $wpdb->prepare(
		"
			UPDATE $wpdb->term_relationships SET term_order = '%d' WHERE term_taxonomy_id ='%d'
		",
		$term_order,
		$term_id
	) );

	clean_term_cache( $term_id, $taxonomy );
}


/*
 * About page with text.
 */
function customtaxorder_about() {
	?>
	<div class='wrap'>

		<h1><?php esc_html_e('About Custom Taxonomy Order NE', 'custom-taxonomy-order-ne'); ?></h1>
		<h2><?php esc_html_e('Support', 'custom-taxonomy-order-ne'); ?></h2>
		<p><?php
			$support = '<a href="https://wordpress.org/support/plugin/custom-taxonomy-order-ne" target="_blank">';
			/* translators: %s is a link */
			echo sprintf( esc_html__( 'If you have a problem or a feature request, please post it on the %ssupport forum at wordpress.org%s.', 'custom-taxonomy-order-ne' ), $support, '</a>' ); ?>
			<?php esc_html_e('I will do my best to respond as soon as possible.', 'custom-taxonomy-order-ne'); ?><br />
			<?php esc_html_e('If you send me an email, I will not reply. Please use the support forum.', 'custom-taxonomy-order-ne'); ?>
		</p>


		<h2><?php esc_html_e('Review this plugin.', 'custom-taxonomy-order-ne'); ?></h2>
		<p><?php
			$review = '<a href="https://wordpress.org/support/view/plugin-reviews/custom-taxonomy-order-ne?rate=5#postform" target="_blank">';
			/* translators: %s is a link */
			echo sprintf( esc_html__( 'If this plugin has any value to you, then please leave a review at %sthe plugin page%s at wordpress.org.', 'custom-taxonomy-order-ne' ), $review, '</a>' ); ?>
		</p>

		<h2><?php esc_html_e('Translations', 'custom-taxonomy-order-ne'); ?></h2>
		<p><?php
			$link = '<a href="https://translate.wordpress.org/projects/wp-plugins/custom-taxonomy-order-ne" target="_blank">';
			/* translators: %s is a link */
			echo sprintf( esc_html__( 'Translations can be added very easily through %sGlotPress%s.', 'custom-taxonomy-order-ne' ), $link, '</a>' ); echo '<br />';
			echo sprintf( esc_html__( "You can start translating strings there for your locale. They need to be validated though, so if there's no validator yet, and you want to apply for being validator (PTE), please post it on the %ssupport forum%s.", 'custom-taxonomy-order-ne' ), $support, '</a>' ); echo '<br />';
			$make = '<a href="https://make.wordpress.org/polyglots/" target="_blank">';
			/* translators: %s is a link */
			echo sprintf( esc_html__( 'I will make a request on %smake/polyglots%s to have you added as validator for this plugin/locale.', 'custom-taxonomy-order-ne' ), $make, '</a>' ); ?>
		</p>

	</div>
	<?php
}


/*
 * Add Settings link to the main plugin page.
 */
function customtaxorder_links( $links, $file ) {
	if ( $file == plugin_basename( dirname(__FILE__).'/customtaxorder.php' ) ) {
		$links[] = '<a href="' . admin_url( 'admin.php?page=customtaxorder' ) . '">' . esc_html__( 'Settings', 'custom-taxonomy-order-ne' ) . '</a>';
	}
	return $links;
}
add_filter( 'plugin_action_links', 'customtaxorder_links', 10, 2 );


/*
 * Flush object cache when order is changed in taxonomy ordering plugin.
 *
 * @since 2.7.8
 *
 */
function customtaxorder_flush_cache() {
	wp_cache_flush();
}
add_action( 'customtaxorder_update_order', 'customtaxorder_flush_cache' );


/*
 * Load language files.
 */
function customtaxorder_load_lang() {
	load_plugin_textdomain('custom-taxonomy-order-ne', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/');
}
add_action('plugins_loaded', 'customtaxorder_load_lang');
