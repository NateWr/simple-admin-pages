<?php

/**
 * Register, display and save a text field setting in the admin menu
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSettingText_1_1 extends sapAdminPageSetting_1_1 {

	public $sanitize_callback = 'sanitize_text_field';

	/**
	 * Display this setting
	 * @since 1.0
	 */
	public function display_setting() {
		?>

		<input name="<?php echo $this->id; ?>" type="text" id="<?php echo $this->id; ?>" value="<?php echo $this->value; ?>" class="regular-text" />

		<?php
		
		$this->display_description();
		
	}

}
