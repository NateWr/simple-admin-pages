<?php

/**
 * Register, display and save a number field setting in the admin menu
 * 
 * By default, it allows positive and negative numbers. To only allow positive numbers,
 * add "sanitize_callback" => "absint" to your add_setting() $args array.
 * 
 * Example:
 * $sap->add_setting(
 *    'page-id',
 *    'section-id',
 *    'number',
 *    [
 *        'id'			=> 'field-id',
 *        'title'			=> __( 'Some number:', '' ),
 *        'sanitize_callback' => 'absint', // Add this if you want to allow only positive numbers.
 *    ]
 *);
 * 
 * @since 2.1.2
 * @package Simple Admin Pages
 */

class sapAdminPageSettingNumber_2_1_2 extends sapAdminPageSetting_2_1_2 {

	public $sanitize_callback = 'intval';

	/**
	 * Display this setting
	 * @since 1.0
	 */
	public function display_setting() {
		?>

        <input name="<?php echo $this->get_input_name(); ?>" type="number" id="<?php echo $this->get_input_name(); ?>" value="<?php echo $this->value; ?>" class="regular-number" />

		<?php

		$this->display_description();

	}

}
