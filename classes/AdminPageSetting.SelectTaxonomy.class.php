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

	/**
	 * Arrays of taxonomies and arguments accepted by get_terms().
	 * See: http://codex.wordpress.org/Function_Reference/get_terms
	 */
	public $taxonomies = array();
	public $args = array();

	/**
	 * Initialize the setting
	 * @since 1.0
	 */
	public function __construct( $id, $title, $description, $taxonomies, $args = array() ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;
		$this->description = $description;
		$this->taxonomies = $taxonomies;
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
				<?php foreach ( $terms as $term  ) : ?>
					<option value="<?php echo esc_attr( $term->term_id ); ?>"<?php if( $this->value == $term->term_id ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $term->name ); ?></option>
				<?php endforeach; ?>
			</select>

		<?php

		$this->display_description();

	}

}
