<?php

class GF_Installation_Wizard_Step_Complete extends GF_Installation_Wizard_Step {

	protected $_name = 'complete';

	function display() {

		?>
		<p><center>
			<?php
			esc_html_e( "Click the 'Create A Form' button to get started.", 'gravityforms' );
			?>
			</center>
		</p>
		<?php
		}

	function get_title(){
		return esc_html__( 'We are done with the Introductions', 'gravityforms' );
	}

	function get_next_button_text(){
		return esc_html__( 'Create A Form', 'gravityforms' );
	}

	function get_previous_button_text(){
		return '';
	}
}