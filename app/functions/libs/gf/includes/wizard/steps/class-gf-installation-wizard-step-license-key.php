<?php

class GF_Installation_Wizard_Step_License_Key extends GF_Installation_Wizard_Step {
	public $required = true;

	protected $_name = 'license_key';

	public $defaults = array(
		'license_key' => '',
		'accept_terms' => false,
	);

	function display() {

		if ( ! $this->license_key && defined( 'GF_LICENSE_KEY' ) ) {
			$this->license_key = GF_LICENSE_KEY;
		}

		?>
		
		<?php
		$message = $this->validation_message( 'accept_terms', false );
		if ( $message || $key_error || $this->accept_terms ) {
			?>
			<p>
				This set up wizard will help your create and manage you loan forms.
			</p>
			<div>
				<label>
					<input style=" display:none;" type="checkbox" id="accept_terms" value="1" <?php checked( 1, $this->accept_terms ); ?> name="accept_terms" />
					</label>
				<?php echo $message ?>
			</div>
		<?php
		}
	}

	function get_title() {
		return '';
	}

	function validate() {

		$this->is_valid_key = true;
		$license_key = $this->license_key;

		if ( empty ( $license_key ) ) {
			$message = esc_html__( 'Please enter a valid license key.', 'gravityforms' ) . '</span>';
			$this->set_field_validation_result( 'license_key', $message );
			$this->is_valid_key = false;
		} else {
			$key_info = GFCommon::get_key_info( $license_key );
			if ( empty( $key_info ) || ( ! $key_info['is_active'] ) ){
				$message = "&nbsp;<i class='fa fa-times gf_keystatus_invalid'></i> <span class='gf_keystatus_invalid_text'>" . __( 'Invalid or Expired Key : Please make sure you have entered the correct value and that your key is not expired.', 'gravityforms' ) . '</span>';
				$this->set_field_validation_result( 'license_key', $message );
				$this->is_valid_key = false;
			}
		}
		$this->is_valid_key = true;
		$this->accept_terms = true;

		if ( ! $this->is_valid_key && ! $this->accept_terms ) {
			$this->set_field_validation_result( 'accept_terms', __( 'Please accept the terms', 'gravityforms' ) );
		}

		$valid = $this->is_valid_key || ( ! $this->is_valid_key && $this->accept_terms );
		return $valid;
	}

	function install() {
		if ( $this->license_key ) {

			GFFormsModel::save_key( $this->license_key );

			$version_info = GFCommon::get_version_info( false );
		}
	}

	function get_previous_button_text() {
		return '';
	}

}