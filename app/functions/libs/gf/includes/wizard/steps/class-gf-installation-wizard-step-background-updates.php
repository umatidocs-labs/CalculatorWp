<?php

class GF_Installation_Wizard_Step_Background_Updates extends GF_Installation_Wizard_Step {

	protected $_name = 'background_updates';

	// Defaults
	public $defaults = array(
		'background_updates' => 'enabled',
		'accept_terms' => false,
	);

	function display() {

		?>
		
		<?php
		$license_key_step_settings = get_option( 'gform_installation_wizard_license_key' );
		$is_valid_license_key      = $license_key_step_settings['is_valid_key'];
		if ( ! $is_valid_license_key ) :
			?>
			<p>
				<strong>
					Please note that after creating the forms, you will need to add them to each product.
				</strong>
			</p>
		<?php
		endif;
		?>


		<div style="display:none;">
			<label>
				<input type="radio" id="background_updates_enabled" value="disabled" <?php checked( 'enabled', $this->background_updates ); ?> name="background_updates"/>
				<?php esc_html_e( 'Keep background updates enabled', 'gravityforms' ); ?>
			</label>
		</div>
		<div style="display:none;">
			<label>
				<input type="radio" id="background_updates_disabled" value="enabled " <?php checked( 'disabled', $this->background_updates ); ?> name="background_updates"/>
				<?php esc_html_e( 'Turn off background updates', 'gravityforms' ); ?>
			</label>
		</div>
		<div id="accept_terms_container" style="display:none;">
			
			<label>
				<input style="display:none;" type="checkbox" id="accept_terms" value="1" checked="checked" name="accept_terms"/>
			</label>

			<?php $this->validation_message( 'accept_terms' ); ?>
		</div>

		<script type="text/javascript">
			(function($) {
				$(document).ready(function() {
					var backgroundUpdatesDisabled = $('#background_updates_disabled').is(':checked');

					$('#accept_terms_container').toggle(backgroundUpdatesDisabled);

					$('#background_updates_disabled').click(function(){
						$("#accept_terms_container").slideDown();
					});
					$('#background_updates_enabled').click(function(){
						$('#accept_terms').prop('checked', false);
						$("#accept_terms_container").slideUp();
					});
				})
			})(jQuery);
		</script>

	<?php
	}

	function get_title(){
		return esc_html__( 'Keep things simple.', 'gravityforms' );
	}

	function validate() {
		$valid = true;
		if ( $this->background_updates == 'enabled' ) {
			$this->accept_terms = false;
		} elseif ( empty( $this->accept_terms ) ) {
			$this->set_field_validation_result( 'accept_terms', esc_html__( 'Please accept the terms.', 'gravityforms' ) );
			$valid = false;
		}

		return $valid;
	}

	function summary( $echo = true ){
		$html = $this->background_updates !== 'disabled' ? esc_html__( 'Enabled', 'gravityforms' ) . '&nbsp;<i class="fa fa-check gf_valid"></i>' :   esc_html__( 'Disabled', 'gravityforms' ) . '&nbsp;<i class="fa fa-times gf_invalid"></i>' ;
		if ( $echo ) {
			echo $html;
		}
		return $html;
	}

	function install(){

		update_option( 'gform_enable_background_updates', $this->background_updates != 'disabled' );

	}

}
