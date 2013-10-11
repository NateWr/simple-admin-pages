<?php

/**
 * Register, display and save a selection with a drop-down list of any taxonomy
 * type
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSettingSelectTaxonomy extends sapAdminPageSetting {

	public $sanitize_callback = 'sanitize_text_field';
	
	// Whether or not to display a blank option
	public $blank_option = true;

	// Arrays of taxonomies to fetch (required)
	public $taxonomies;
	
	/**
	 * Array of options accepted by get_terms()
	 * See: http://codex.wordpress.org/Function_Reference/get_terms
	 */
	public $args = array();

	/**
	 * Initialize the setting
	 * @since 1.0
	 */
	public function __construct( $id, $title, $description, $taxonomies, $blank_option = true, $args = array() ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;
		$this->description = $description;
		$this->taxonomies = $taxonomies;
		$this->blank_option = $blank_option;
		$this->args = $args;
		$this->value = $this->esc_value( get_option ( $this->id ) );

	}

	/**
	 * Display this setting
	 * @since 1.0
	 */
	public function display_setting() {

		$terms = get_terms( $this->taxonomies, $this->args );
		
		?>

			<select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">
			
				<?php if ( $this->blank_option === true ) : ?>
					<option></option>
				<?php endif; ?>
				
				<?php foreach ( $terms as $term  ) : ?>
					<option value="<?php echo esc_attr( $term->term_id ); ?>"<?php if( $this->value == $term->term_id ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $term->name ); ?></option>
				<?php endforeach; ?>
				
			</select>

		<?php

		$this->display_description();

	}

}
