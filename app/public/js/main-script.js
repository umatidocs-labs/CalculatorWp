jQuery(document).ready(function($) {

	sl_list_message_details_num = 0 ;

	// Form builder
	var formBuilder_outer = '' ;

	var sl_manage_form_builder = {

		"init" : function () {

			$('.sl_Save_and_Close').click( function(){

				$('.save-template').click();
				$( this ).val('Saving...');

				if( $('#calculatorwp_form_name').val().length > 0 ){
					sl_manage_form_builder.save_form( {
						'form_data': formBuilder_outer.formData,
						'form_name': $('#calculatorwp_form_name').val(),
						'form_id': $('#calculatorwp_form_id').val(),
					} );
				}
				else{
					$( this ).val('Error, the form title is needed.');
					$('#calculatorwp_form_name').css({ "border": "2px solid #f793a1" });
					$('#calculatorwp_form_name').blur( function(){
						$('#calculatorwp_form_name').css({ "border": "2px solid #ccc" });
					});
					$('#calculatorwp_form_name').focus( function(){
						$('#calculatorwp_form_name').css({ "border": "2px solid #ccc" });
						$('.sl_Save_and_Close').val('Save');
					});
				}

			} )
			$('.sl_open_from_edit_details').click( function(){

				sl_manage_form_builder.load_single_form_for_update( { 'form_id' : $( this ).data('sl_table_id') } ) ;

			} );

		},
		'save_form': function( params = {} ) {
			
			var form_data = new FormData() ;
			form_data.append( 'action' , 'sl_update_form_builder' );
			form_data.append( 'form_data', params.form_data );
			form_data.append( 'form_name', params.form_name );
			form_data.append( 'form_id' , params.form_id );

			jQuery.ajax( {

				url: ajax_object.ajaxurl,
				type: 'post',
				contentType: false,
				processData: false,
				data: form_data,
				success: function ( response ) { //console.log( response ) ;

					response = JSON.parse( response ) ;
					$('.sl_Save_and_Close').val('Save');
					$('#calculatorwp_form_id').val( response.table_id );
					sl_manage_form_builder.update_form_list({
						'form_list': response.mortgage_tables,
						'table_id' : response.table_id
					} );

				},
				error: function (response) {
					console.log( response ) ;
				}

			} ) ;

		},
		'update_form_list': function( params ){

			$('.sl_table_body_list').html( '' ) ;

			$.each( params.form_list, function( index, value ){
					
				$('.sl_table_body_list').append( '<tr style="width:100%;" class="sl_single_table_line sl_table_item_id_' +value.id+ '">\
					<td class="sl_list_single_item_single ">\
						<span class="">' +value.post_name+ '</span>\
					</td>\
					<td class="sl_house_keeping">\
						<center>\
							<span data-sl_table_id="' +value.id+ '" class="sl_house_keeping_link sl_open_from_edit_details">Open</span>\
						</center>\
					</td>\
				</tr>' );

			} );

			// focus on newly edited table
			sl_manage_form_builder.focus_on_a_table( { 'table_id': params.table_id } );	// add listener

		},
		'focus_on_a_table':function( aparams ){

			$('.sl_single_table_line').css( 'background', '#fff' );
			// console.log('.sl_table_item_id_' + aparams.table_id );
			$( '.sl_table_item_id_' + aparams.table_id ).css( 'background', '#33db040f' );
			
		},
		'load_single_form_for_update':function( param ){

			// param.form_id // update input
			$('#calculatorwp_form_id').val( param.form_id );

			var form_data = new FormData() ;

			form_data.append( 'action' , 'sl_form_load_content' );
			form_data.append( 'form_id' , param.form_id );

			jQuery.ajax( {

				url: ajax_object.ajaxurl,
				type: 'post',
				contentType: false,
				processData: false,
				data: form_data,
				success: function ( response ) {

					response = JSON.parse( response );
					formData = response.formData
					formData = formData.replace(/\\/g, '') ;

					$('.calculatorwp_sub_form_edit_wrap').show();
					// update title
					$('#calculatorwp_form_name').val( response.post_title );

					// update content
					$('#form-editor-product').html('');
					$('#form-editor-product').formBuilder( { formData } ).promise.then( formBuilder => {
						formBuilder_outer = formBuilder;
					} );
					sl_manage_form_builder.focus_on_a_table( { 'table_id': param.form_id } );	// add listener
				
				},
				error: function (response) {
					console.log( response ) ;
				}

			} ) ;
			
		}

	} ;

	sl_manage_form_builder.init();

	$('.calculatorwp_main_section_click').click( function(){

		$('.calculatorwp_main_section').hide();
		$( '.' + $( this ).data('section_name') ).show();
		$('.calculatorwp_main_section_click').css( {
			'box-shadow': '0 4px 8px 0 rgba(0, 0, 0, 0.0), 0 6px 20px 0 rgba(0, 0, 0, 0.0)',
			'color':"#323232"
		} );
		$( this ).css( {
			'box-shadow': '0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)',
			'color':"#323232"
		} );
		$('.sl_form_inner_close').click( function(){
			$('.sl_manage_from_side_wrap').hide();
			$( '#calculatorwp_list_table_frontend' ).click() ;
		} );

	} );

	$('.sl_form_inner_close').click( function(){
		$('.sl_manage_from_side_wrap').hide();
	} )
	$('.sl_Manage_Forms').click( function(){
		$('.sl_manage_from_side_wrap').show();
	} );
	$('.sl_new_form').click( function(){

		$('#calculatorwp_form_name').val('');
		$('#calculatorwp_form_id').val('0'); // $('.clear-all').click() // $('.del-button').click();
		$('#form-editor-product').html('');
		$( '.sl_single_table_line' ).css( 'background', '#fff' );
		$('.calculatorwp_sub_form_edit_wrap').show();

		$('#form-editor-product').formBuilder().promise.then( formBuilder => {
			formBuilder_outer = formBuilder;
		} );

	} )

});