//alert(' Hallo world. ')

function sr_board_profile_loader(){

	jQuery(document).ready(function($) {

		$('#sr_close_profile').click(function(){

			$('#sr_edit_profile_mod').hide();

		});

		$('.sr_edit_tab_details').click(function(){

			current_date_edit_tab = $(this).attr('date-edit-tab-details');

			$('#sr_edit_profile_mod').show();

			srb_manager.load_edit_form( current_date_edit_tab );

		});

		$('#sr_close_b').click(function(){

			$('#sr_upload_file_attachment').hide();

		});

		$('#sr_upload_profile').click(function(){

			$('#sr_upload_file_attachment').show();

		});

		if( sr_current_situation == true ){

			//Make text black
			$('.sr_contact_info').css({'color':'black'});

		}
		else{

			//Make text gray
			$('.sr_contact_info').css({'color':'gray'});

			$('#sr_s_hide_contacts').click() ;

		}

		var srb_manager = {

			'load_edit_form':function( load_edit_form ){

				var form_data = new FormData();

				form_data.append('action', 'srb_edit_profile');

				form_data.append( 'sr_profile_id', sr_profile_id );

				form_data.append( 'load_edit_form' , load_edit_form );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						$('#my_profile_list_inner').html( response );

						$('#ps_update_profile').click( function(e){
							
							srb_manager.update_profile_sender(e);
						
						});
					
					},
				
					error: function (response) {

						$('#my_profile_list_inner').html('An Error happened');
			
					}
				
				});
				
			},

			'update_profile_sender' : function(e){

				e.preventDefault();

				data_submit_field = $('#ps_update_profile').attr('data-submit-field');

				slides = $('.'+ data_submit_field +'_input' );

				$('#q_message').html('Updating candidate...')

				var form_data = new FormData();

				sr_data_arr = {} ;

				for( var i = 0; i < slides.length; i++ ){

					sr_update_value = {} ;

					sr_update_value.db_name = slides[i].attributes.data_db_name.nodeValue ;
					
					sr_update_value.sb_value = slides[i].value ;
					
					sr_update_value.explode_value =  $('.'+data_submit_field+'_split_value').val() ;

					sr_data_arr[ slides[i].attributes.data_db_name.nodeValue ]=  sr_update_value  ;

				}

				form_data.append('sr_data_values', JSON.stringify(sr_data_arr) );

				form_data.append( 'sr_post_id' , sr_profile_id ); 

				form_data.append('action', 'srb_update_profile_sender' );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						console.log( response );

						response = JSON.parse(response);

						$( '#my_profile_list_inner' ).html( response.report );
					
					},
				
					error: function (response) {

						$('#my_profile_list_inner').html('An Error happened');
			
					}
				
				});
				
			},

			'process_view_contact' : function(){

				if( sr_current_situation == true ){

					//Make text black
					$('.sr_contact_info').css({'color':'gray'});
		
					sr_current_situation = false;

				}
				else{

					//Make text gray
					$('.sr_contact_info').css({'color':'black'});

					sr_current_situation = true;

				}

			},
	
			'change_display_contacts':function(){
				//Find the current state
				//Change to a different
				srb_manager.process_view_contact();

				var form_data = new FormData();

				form_data.append( 'action', 'ps_update_view_profile_contact' );

				form_data.append( 'sr_profile_id', sr_profile_id );

				form_data.append( 'sr_current_situation', sr_current_situation );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						console.log( response );

					},
				
					error: function (response) {

						$('#my_profile_list_inner').html('An Error happened');
			
					}
				
				});
				
			}

		};
		
		$('#sr_edit_profile').click(function(){

			$('#sr_edit_profile_mod').show();

			srb_manager.load_edit_form();

		});


		$('#sr_s_hide_contacts').click(function(){

			srb_manager.change_display_contacts() ;

		});
	});
}


function sr_profile_uploader_wizard(){
	
	jQuery(document).ready(function($) {

	//Rest of the code
	
	var isAdvancedUpload = function() {
	  var div = document.createElement('div');
	  return (('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)) && 'FormData' in window && 'FileReader' in window;
	}();
	
	var $form = $('.box');
	
	//if (isAdvancedUpload) {
	  $form.addClass('has-advanced-upload');
	//}
	
	if (isAdvancedUpload) {
	
	  var droppedFiles = false;
	
	  $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
		e.preventDefault();
		e.stopPropagation();
	  })

	  $form.on('dragover dragenter', function() {
		$form.addClass('is-dragover');
	  })

	  $form.on('dragleave dragend drop', function() {
		$form.removeClass('is-dragover');
	  })

	  $form.on('drop', function(e) {
		droppedFiles = e.originalEvent.dataTransfer.files;
		$('#file').val();
	  });
	
	}
	 $('#file').on('change',function(){
		droppedFiles =$('#file').prop('files');
	})
	var $input    = $form.find('input[type="file"]'),
		$label    = $form.find('label'),
		showFiles = function(files) {
		   $form.find('#ps_filename').text(files.length > 1 ? ($input.attr('data-multiple-caption') || '').replace( '{count}', files.length ) : files[ 0 ].name );
		   $('#ps_bottom_tick').show();
			$('#psremove_file').show();
			$('#ps_filename').show();
		};
	
	// ...
	
	$form.on('drop', function(e) {
	  droppedFiles = e.originalEvent.dataTransfer.files; // the files that were dropped
	  showFiles( droppedFiles );
	});
	
	//...
	
	$input.on('change', function(e) {
	  showFiles(e.target.files);
	});
	
	
		var missing_fields = 0;
		var req_f = ['finput1'];
			
		//console.log(trader_var);
		$("#close_required_fields").click(function(){
			$("#required_fields").hide();
		});	
		
		var number_of_files_id = 1;
		function add_new_file_field(){
			//console.log(number_of_files_id);
			//$('#file_section_area').append('<div id="wholediv'+number_of_files_id+'"> <div class="headclass" id="headclass'+number_of_files_id+'">Select A Resume<span class="astericsclass">*</span></div><div id="somefilel'+number_of_files_id+'"><div class="file-upload-wrapper"><form class="box" method="post" action="" enctype="multipart/form-data"> <div class="box__input"><input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />    <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>    <button class="box__button" type="submit">Upload</button>  </div>  <div class="box__uploading">Uploading…</div>  <div class="box__success">Done!</div>  <div class="box__error">Error! <span></span>.</div></form><input name="Shipping_Conditions" type="file" value="Buyer" class="field_text_f_class file-upload" id="finput'+number_of_files_id+'"></div></div></div>');
			//number_of_files_id;
			const  headclass = '#headclass'+number_of_files_id;
			const  somefilel =  '#somefilel'+number_of_files_id;
			const  closefiled = '#closefiled'+number_of_files_id;
			
			$( '#closefiled'+number_of_files_id ).click(function(){
				$( headclass ).html('');
				$( somefilel).html('');
				$( closefiled ).hide();
			});
			number_of_files_id = number_of_files_id+1;
		}
			
		$('#addfile_sec').click(function(e){
			e.preventDefault();
			add_new_file_field();
		});
		
		add_new_file_field();
	
	var sf_row_id = 1;
	var sf_append_point = "field_12_103";
	
	function sf_order_item_list(){
	
		items=[];
		
		for (i = 1; i < q_row_id ; i++) {
		  items[i]={
			  'f1':	$(" [name='input_91"+i+"']").val(),
			  "f2":$("#input_12_12"+i).val(),
			  "f3":$("#input_12_22"+i).val(),
			  "f4":$("#input_12_97"+i).val(),
			}
		}
		
		return items;	
	}
	
	function att_upload_and_save_text() {
		
		var supporttitle = 'User Id:';//+$('#ps_user_id').val();
	
		var querytype = jQuery('.support-query').val();
	
		var form_data = new FormData();
		
		final_tally_place = number_of_files_id;
	
		for (i = 1; i < number_of_files_id; i++) {
	
			var file_data = droppedFiles[0];
	
			form_data.append( 'file1' , file_data );
	
		}
		
		form_data.append('action', 'sr_add_attachment_file');
	
		form_data.append( 'sr_post_id' , sr_profile_id ); 
		
		form_data.append('final_tally_place', final_tally_place);
		
		$("#sending_data").show();
		
		jQuery.ajax({
		
			url: ajax_object.ajax_url,
		
			type: 'post',
		
			contentType: false,
		
			processData: false,
		
			data: form_data,
		
			success: function ( response ) {

				console.log(response);

				response = JSON.parse(response);
		
				$("#sending_data").hide();
		
				$("#main_spot_to_change").html(''); 
		
				$("#required_fields_inner").html('');
		
			//	$("#main_spot_to_change").html( response );	

				$('#sr_upload_file_attachment').hide();

				$('#sr_files_area').click();

				$('#sr_last_file_item').before('<li style="list-style:none;"><a href="'+ response.url +'">'+ response.f_name +'</a></li>');

				
				
		
			},  
			error: function (response) {
		
				console.log(response);
		
				console.log('error');
		
				$("#sending_data").hide();
		
				alert('There was an error during the uploading process.');
		
			}
		
		});	
	
	}
	req_f=['file'];
	$("#psremove_file").click(function(){
		$("#ps_filename").hide();
		$("#psremove_file").hide();
		$("#ps_bottom_tick").hide();
		$("#file").val('');
	});
	
	
		$("#ps_submit_upload_attachment").click(function(e){
		
			e.preventDefault();
		
			missing_fields =0;
			
			req_f.forEach( function(input_id){

				//if field empty->make border red		
				in_vals = $("#"+input_id).val();
		
				if( in_vals ==  "" && droppedFiles == false ){
		
					$( "#"+input_id ).css({"border":"1px solid red"});
		
					$("#required_fields").show();
					
					//increase missing_fields
		
					missing_fields = missing_fields + 1;
		
				}			
		
			});
			
			if( missing_fields == 0 ){
	
				//do ajax
				att_upload_and_save_text();
	
			}
		});	
	});
	}