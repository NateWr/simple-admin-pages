<?php

/**
 * Register, display and save an option with a single checkbox.
 *
 * This setting accepts the following arguments in its constructor function.
 *
 * $args = array(
 *		'id'			=> 'setting_id', 	// Unique id
 *		'title'			=> 'My Setting', 	// Title or label for the setting
 *		'description'	=> 'Description', 	// Help text description
 *		'label'			=> 'Label', 		// Checkbox label text
 *		);
 * );
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSettingToggle_1_1 extends sapAdminPageSetting_1_1 {

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
