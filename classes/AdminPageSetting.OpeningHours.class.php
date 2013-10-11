<?php

/**
 * Register, display and save a series of fields to specify the opening hours
 * of a business/company.
 *
 * @since 1.0
 * @package Simple Admin Pages
 */

class sapAdminPageSettingOpeningHours extends sapAdminPageSetting {

	public $sanitize_callback = 'sanitize_text_field';

	/**
	 * Initialize the setting
	 * @since 1.0
	 */
	public function __construct( $id, $title, $description ) {

		$this->id = esc_attr( $id );
		$this->title = $title;
		$this->description = $description;
		$this->value = $this->esc_value( get_option( $this->id ) );

	}

	/**
	 * Escape the value to display it in text fields
	 * @since 1.0
	 */
	public function esc_value( $values ) {

		// Loop over the values and sanitize them
		for ( $i = 0; $i < 7; $i++ ) {
			if ( isset( $values[ $i ] ) && is_array( $values[ $i ] ) ) {
				$values[$i]['day'] = esc_attr($values[$i]['day']);
				$values[$i]['hours'] = esc_attr($values[$i]['hours']);
			}
		}

		return $values;

	}

	/**
	 * Display this setting
	 * @since 1.0
	 */
	public function display_setting() {

		$this->display_description();

		for ($i = 0; $i < 7; $i++) {
		?>

			<table class="sap-opening-hours">
				<tr>
					<td>
						<input name="<?php echo $this->id; ?>[<?php echo $i; ?>][day]" type="text" id="<?php echo $this->id . '-' . $i; ?>-day" value="<?php echo $this->value[$i]['day']; ?>" class="regular-text sap-opening-hours-day" />
					</td>
					<td>
						<input name="<?php echo $this->id; ?>[<?php echo $i; ?>][hours]" type="text" id="<?php echo $this->id . '-' . $i; ?>-hours" value="<?php echo $this->value[$i]['hours']; ?>" class="regular-text sap-opening-hours-hours" />
					</td>
				</tr>
			</table>

		<?php
		}

	}

	/**
	 * Sanitize the array of text inputs for this setting
	 * @since 1.0
	 */
	public function sanitize_callback_wrapper( $values ) {

		// If no sanitization callback exists, don't register the setting.
		if ( !isset( $this->sanitize_callback ) || !trim( $this->sanitize_callback ) ) {
			return;
		}

		// If this isn't an array, just sanitize it as a string
		if (!is_array( $values ) ) {
			return call_user_func( $this->sanitize_callback, $values );
		}

		// Loop over the values and sanitize them
		for ( $i = 0; $i < 7; $i++ ) {
			if ( isset( $values[ $i ] ) && is_array( $values[ $i ] ) ) {
				$values[$i]['day'] = call_user_func( $this->sanitize_callback, $values[$i]['day'] );
				$values[$i]['hours'] = call_user_func( $this->sanitize_callback, $values[$i]['hours'] );
			}
		}

		return $values;
	}

}
