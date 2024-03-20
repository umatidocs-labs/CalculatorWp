<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
<script src="https://formbuilder.online/assets/js/form-builder.min.js"></script>

<div class = "calculatorwp_loansettings_edit">

    <center>
    	<h3 class="calculatorwp_main_title"> Manage Mortgage Product: <?php echo $object->name; ?> </h3>
    </center>

	<div class="calculatorwp_main_section_wrap_click">
		<ul>
			<li class="calculatorwp_main_section_click" data-section_name="calculatorwp_main_title_shortcode" id="calculatorwp_main_title_shortcode" >Shortcode</li>
			<li class="calculatorwp_main_section_click" data-section_name="calculatorwp_list_table_dd" id="calculatorwp_list_table_dd">Calculations</li>
			<li class="calculatorwp_main_section_click" data-section_name="calculatorwp_list_table_frontend"  id="calculatorwp_list_table_frontend">Frontend Display</li>
			<li class="calculatorwp_main_section_click" data-section_name="calculatorwp_list_notes"  id="calculatorwp_list_notes">Internal Notes</li>
		<ul>
	</div>

	<div class="calculatorwp_main_title calculatorwp_main_section calculatorwp_main_title_shortcode">

		<h4>Shortcodes</h4>

		<table>
			<tr>
				<td>
					Display a Single Mortgage ( <b><?php echo $object->name; ?> </b> ) :
				</td>				
				<td class="sl_shortcode_details_l">
					<span class="sl_shortcode_details"> 
						[streamlinemortgage product=<?php echo $object->id; ?> ]
					</span> 
				<td>
			</tr>
			<tr>
				<td>Display a Dropdown of all Mortgages :</td>
				<td  class="sl_shortcode_details_l"><span class="sl_shortcode_details">[streamlinemortgage_all_loans]</span></td>
			</tr>
			<tr>
				<td>
					Borrower Login/ Signup :
				</td>
				<td class="sl_shortcode_details_l">
					<span class="sl_shortcode_details">[streamlinemortgage_login]</span>
				</td>
			</tr>
		</table>
	</div>

<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   

	echo $this->form->create( $model->name );
	$gflist = mvc_model("calculatorwpGform");

?>

	<table class="calculatorwp_list_table calculatorwp_list_table_dd calculatorwp_main_section">
		<tr>
			<td class="calculatorwp_title_feild">
				Name( Displayed on Frontend Dropdown )
			</td>
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('name', array('label' => '','class'=>'calculatorwp_input_feild')); ?>
			</td>
			
		</tr>
		<tr>
			<td class="calculatorwp_title_feild">
				Currency/ Country
			</td>
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
					$currency_of_the_world= sl_currency_country ;
					$currency_of_the_world = maybe_unserialize($currency_of_the_world);
					echo $this->form->select('currency', array('options'=>$currency_of_the_world,'value'=>$object->currency ,'label' => '','class'=>'calculatorwp_input_feild'));
				?>
			</td>
		</tr>
		<tr>
			<td class="calculatorwp_title_feild">Calculator Type</td>
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
				$calculatorwp_calculator_themes =[];
				$calculatorwp_calculator_themes=apply_filters('sl_get_calculator_themes',$calculatorwp_calculator_themes);
				echo $this->form->select('calculator_theme', array('options' => $calculatorwp_calculator_themes, 'class'=>'calculatorwp_input_feild_f', 'value'=>$object->calculator_theme ));
				?>
			</td>
		</tr>
		<tr class = "sm_interest">
			<td  class="calculatorwp_title_feild">
				Maximum Mortgage Amount
			</td>	
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ echo $this->form->input('max_amount', array('placeholder' => '', 'label' => '','class'=>'calculatorwp_input_feild'),  array('style' => ''));?>
			</td>
		</tr>
		<tr class = "sm_interest">
			<td class="calculatorwp_title_feild">Maximum Period</td>
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('max_period_number', array('label' => '','class'=>'calculatorwp_input_feild_small')); ?>
			</td>
		</tr>
		<tr class = "sm_interest">
			<td class="calculatorwp_title_feild"></td>
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   
					$Periodunit=sl_period_unit;
					$Periodunit=maybe_unserialize($Periodunit);
					echo $this->form->select('period_unit', array('options' => $Periodunit, 'value'=>$object->period_unit ,'class'=>'calculatorwp_input_feild_small'));
				?>
			</td>
		</tr>
		<tr class = "sm_interest">
			<td class="calculatorwp_title_feild">Interest Rate</td>
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('interest_rate', array('label' => '','class'=>'calculatorwp_input_feild')); ?>
			</td>
		</tr>
	<!--
	<tr>
		<td class="calculatorwp_title_feild">
			Spending Goal Form
		</td>
		<td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->select_from_model('goal_form', $gflist , array(), array('label' => '','class'=>'calculatorwp_input_feild'));?>
		</td>
	</tr> -->
	</table>

	<table class="calculatorwp_list_table calculatorwp_list_table_frontend calculatorwp_main_section">
		<tr>
			<td class="calculatorwp_title_feild">Product Title</td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('main_title_text', array('placeholder' => '','label' => '','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
		</tr>
	</table>

	<table class="calculatorwp_list_table calculatorwp_list_table_frontend calculatorwp_main_section">
		<tr>
			<td class="calculatorwp_title_feild"> Form </td>
			<td>
				<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */
				// echo $this->form->select_from_model('secondary_form', $gflist , array(), array('label' => '','class'=>'calculatorwp_input_feild'));
				// get_post( $post:integer|WP_Post|null, $output:string, $filter:string ) // $secondary_form

				$mortgagetables = get_posts( [
					'post_status' => 'active',
					'post_type' => 'mortgagetable',
					'fields' => 'ids'
				] );

				foreach( $mortgagetables  as $single_table_id ){
					$secondary_form[$single_table_id ] = get_the_title( $single_table_id ) ;
				}

				echo $this->form->select('secondary_form', array( 'options' => $secondary_form, 'value'=>$object->secondary_form, 'label' => '', 'class'=>'calculatorwp_input_feild' ) );
				
				?>
				<input type="button" class="sl_Manage_Forms" value="Manage Forms">
			</td>
		</tr>
	</table>
	
	<table class="calculatorwp_list_table calculatorwp_list_table_frontend calculatorwp_main_section">
		<tr>
			<td class="calculatorwp_title_feild">Product Description</td>
		</tr>
		<tr>
			<td><?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */ echo $this->form->editor('main_title_description', array('placeholder' => 'Notes about the link','label' => '','required'=>false,'class'=>'calculatorwp_textare_input_feild'),  array('style' => ''));?> </td>
		</tr>
	</table> 
	
	<table class="calculatorwp_list_table calculatorwp_list_table_frontend calculatorwp_main_section">
		<tr>
			<td  class="calculatorwp_title_feild">Submit Button Text</td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->input('button_text', array('placeholder' => '', 'label' => '','class'=>'calculatorwp_input_feild'),  array('style' => 'width: 200px;'));?>
		</tr>
		<tr>
			<td class="calculatorwp_title_feild">
				Mailchimp Group
				<?php			
					echo '<br>To show groups <a href="'. admin_url( 'admin.php?page=mvc_calculatorwp_mailchimps') .'">Add API key</a>';
				?>
			
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   

				$calculatorwp_get_mailchimp_list_interest = apply_filters('calculatorwp_get_mailchimp_list_interest','hallo');

				// var_dump($calculatorwp_get_mailchimp_list_interest);
				
				if(is_array($calculatorwp_get_mailchimp_list_interest)){

					if(count($calculatorwp_get_mailchimp_list_interest)>0){
						echo $this->form->select('mailchimp_group', array('options' => $calculatorwp_get_mailchimp_list_interest, 'value'=>$object->mailchimp_group,'class'=>'calculatorwp_input_feild'));
					}
					else{
						echo "Please add a Mailchimp API Key";
					}

				}
				else{
					echo "Please add a Mailchimp API Key";
				}
			?>
			</td>
			
		</tr>
	</table>

	<table class="calculatorwp_list_table calculatorwp_list_notes calculatorwp_main_section">
		<tr>
			<td class="calculatorwp_title_feild">Notes( Internal use only )</td>
			<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo $this->form->textarea_input('notes', array('placeholder' => 'Notes about the loan','label' => '','class'=>'calculatorwp_textare_input_feild'),  array('style' => ''));?>
		</tr>
	</table>
	<?php /* Designed and developed by Gilbert Karogo K., a product of umatidocs.com */   echo "<center>".$this->form->end(' Update ')." <br><a href=".mvc_admin_url(array('controller' => 'admin_calculatorwp_loansettings', 'action' => 'delete', 'id' => $object->__id)).">Delete</a></center>"; ?>

</div>
</div>

<div class="sl_manage_from_side_wrap">
	<div class="sl_manage_from_side_inner">
		<div class="sl_forms_menu_top">
			<input type="button" class="sl_form_inner_close" value="Close [x]">
		</div>
		
		<div class="sl_manage_from_side_body">
			<div class="sl_forms_menu_top">
				<input type="button" class="sl_new_form" value="New Form">
			</div>
				<div class="sl_form_list_detail sl_form_list_wrap">
				<table class="calculatorwp_list_table_index">
					<thead>
						<tr style="width:100%;">
							<th class="calculatorwp_sub_title">
								Form List
							</th>
							<th class="calculatorwp_sub_title">
							</th>
						</tr>
					</thead>
					<tbody class="sl_table_body_list">

					<?php
					$mortgagetables = get_posts( [
						'post_status' => 'active',
						'post_type' => 'mortgagetable',
						'fields' => 'ids'
					] );

					foreach( $mortgagetables  as $single_table_id ){

						$table_name = get_the_title( $single_table_id );
						echo '<tr style="width:100%;" class="sl_single_table_line sl_table_item_id_'.$single_table_id.'">
							<td class="sl_list_single_item_single">
								<span class="">'.$table_name.'</span>
							</td>
							<td class="sl_house_keeping">
								<center>
								<span data-sl_table_id="'.$single_table_id.'" class="sl_house_keeping_link sl_open_from_edit_details">Open</span>
								</center>
							</td>
						</tr>';

					}
					?>
					
					</tbody>

				</table>
			</div>
			<div class="calculatorwp_sub_form_edit_wrap">
				<div class="sl_top_menu_form">
					<input type="button" value="Save" class="sl_Save_and_Close">
				</div>
				<div>
					<input type="text" class="calculatorwp_form_name" id="calculatorwp_form_name">
				</div>
				<div class="sl_editor_area">
					<div id="form-editor-product"></div>
				</div>
			</div>
		</div>
	</div>
</div>

<input id="calculatorwp_form_id" value="0" type="hidden">