<?php

/**
 * Register, display and save an option with a checkbox.
 *
 * @since 1.0
 * @package Simple Admin Pages
 *
 * @todo This should handle multiple options and properly escape the values
 * 		when saved and stored as an array.
 */

class sapAdminPageSettingCheckbox extends sapAdminPageSetting {

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
	public function __construct( $id, $title, $description, $label ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;
		$this->label = $label;
		$this->value = $this->esc_value( get_option( $this->id ) );

	}

	/**
	 * Display this setting
	 * @since 1.0
	 */
	public function display_setting() {

		?>

			<input type="checkbox" name="<?php echo $this->id; ?>" id="<?php echo $this->id; ?>" value="1"<?php if( $this->value == '1' ) : ?> checked="checked"<?php endif; ?>>
			<label for="<?php echo $this->id; ?>"><?php echo $this->label; ?></label>

		<?php

		$this->display_description();

	}

}
