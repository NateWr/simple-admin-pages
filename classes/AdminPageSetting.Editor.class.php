<?php

/**
 * Register, display and save a TinyMC Editor field setting in the admin menu
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSettingEditor_2_1_2 extends sapAdminPageSetting_2_1_2 {

	public $sanitize_callback = 'wp_kses_post';
	
	/**
	 * List of arguments accepted by wp_editor
	 * @since 2.0
	 */
	public $args = array();

	/**
	 * wp_editor() will handle the escaping
	 * @since 2.0
	 */
	public function esc_value( $val ) {
		return $val;
	}

	/**
	 * Display this setting
	 * @since 2.0
	 */
	public function display_setting() {

		$this->args['textarea_name'] = $this->get_input_name();
		
		$value = empty( $this->value ) && !empty( $this->default ) ? $this->default : $this->value;

		wp_editor( $value, preg_replace( '/[^\da-z]/i', '', $this->id), $this->args );

		$this->display_description();

	}

}
