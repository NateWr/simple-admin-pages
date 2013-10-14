<?php

/**
 * Register, display and save a selection option with a drop-down menu.
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSettingSelect extends sapAdminPageSetting {

	public $sanitize_callback = 'sanitize_text_field';

	// Whether or not to display a blank option
	public $blank_option = true;

	/**
	 * An array of options for this select field, accepted as a key/value pair.
	 * The key is the option value and the value is the text displayed to the
	 * user.
	 */
	public $options = array();

	/**
	 * Initialize the setting
	 * @since 1.0
	 */
	public function __construct( $id, $title, $description, $options, $blank_option = true ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;
		$this->blank_option = $blank_option;
		$this->options = $options;
		$this->value = $this->esc_value( get_option ( $this->id ) );

	}

	/**
	 * Display this setting
	 * @since 1.0
	 */
	public function display_setting() {

		?>

			<select name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>">

				<?php if ( $this->blank_option === true ) : ?>
					<option></option>
				<?php endif; ?>

				<?php foreach ( $this->options as $id => $title  ) : ?>
					<option value="<?php echo esc_attr( $id ); ?>"<?php if( $this->value == $id ) : ?> selected="selected"<?php endif; ?>><?php echo esc_html( $title ); ?></option>
				<?php endforeach; ?>

			</select>

		<?php

		$this->display_description();

	}

}
