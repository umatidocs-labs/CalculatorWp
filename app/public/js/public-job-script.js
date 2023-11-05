function sr_board_job_loader(){
	
	jQuery(document).ready(function($) {

		var sr_search_options = {
			
			'sr_s_shared_jobs':	'off',
			
			'sr_s_my_jobs':		'off',
			
			'sr_s_hot_jobs':	'off',
			
			'sr_s_Urgent_jobs':	'off',
			
			'sr_s_fulltime':	'off',
			
			'sr_s_contract':	'off',
			
			'sr_s_parttime':	'off',
			
			'sr_s_remote':		'off',
			
			'sr_s_temporary':	'off'
		
		};
		
		
		var hot_buttons_to_listen_to = {} ;
									
		var urgent_buttons_to_listen_to = {} ;

		var srb_manager = {

			"init":function() {

				srb_manager.load_all_jobs();

			},
			"load_all_jobs":function() {

				var form_data = new FormData();

				form_data.append('action', 'srb_get_all_jobs');
				
				form_data.append('user_name'," Gilbert " );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						// console.log( response );

						response =  JSON.parse( response );

						if( Object.keys(response).length > 0 ){

							$( '#srb_joblist' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead">
								<button class="main__btn main__btn--margin" type="button"><span>load more</span></button>
							</div>
							<!-- end view more -->`);

							for(var k in response.jobs) {
								 
								console.log(k);


								var hot_class = 'sr_listen_not_hot';

								var urgent_class = 'sr_listen_not_urgent';

								if( response.jobs[k].is_job_owner == true ){

									hot_buttons_to_listen_to[k] = response.jobs[k].hot_button ;
									
									urgent_buttons_to_listen_to[k] = response.jobs[k].urgent_button ;

									hot_class = 'sr_listen_hot';

									urgent_class = 'sr_listen_urgent';
									
								}
							
								$( '#srb_lead' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-12">
									<div class="profile">
										<div class="profile__logo col-lg-2">
											<img src="`+ response.jobs[k].job_logo +`" alt="">
										</div>
										
										<div class="profile__wrap col-lg-5 ">
											<h2 class="profile__title"><a href=""><strong><h4>`+ response.jobs[k].job_title +`</h4> <span class"srb_float_right srb_green">`+ response.jobs[k].job_status +`</span></strong></a></h2>
											
											<p class="profile__text"><span class="sbr_gray"><strong> `+ response.jobs[k].job_agency +`</strong></span></p>
											<p><span><strong>Salary: <span class="srb_green"> `+ response.jobs[k].job_salary +` </span> </strong></span> <span><strong>Hourly:  <span class="srb_green"> `+ response.jobs[k].job_hourly +` </span></strong></span>  <span><strong>Type:  <span class="srb_green"> `+ response.jobs[k].job_type +` </span> </strong></span> </p>
											
										</div>
		
										<div class="col-lg-3 sbr_left_gray_border">
												<span class="col-lg-12"> <strong> <span class="srb_gray"> <h4>Split</h4> </strong></span></span>
												<span class="col-lg-12"> <span class="srb_green" > <strong><h3>$`+ response.jobs[k].job_split +`</h3></strong></span>
											</div>
											<div class="col-lg-2" class="srb_left_line">
												<span class="col-lg-12"><span class="board_right_blue"><a href="`+ response.jobs[k].kanban_link +`">BOARD</a></span></span>
												<span class="col-lg-12"><!-- Default switch -->
													<div class="custom-control custom-switch">
													 <i class="fa fa-exclamation-circle sbr_icon_right  `+ urgent_class +` srb_red sbr_float_left ` + response.jobs[k].urgent_button + ` " data-job-id="`+k+`"></i>
													 <i class="fa fa-fire srb_red sbr_icon_right  `+ hot_class +` sbr_float_left  ` + response.jobs[k].hot_button +`" data-job-id="`+k+`"></i>
													</div>
												</span>
											</div>
									</div>
								</div>
								<!-- end profile -->`);


							}
	
							$('#sr_Full_Time').html( response.job_type_count.Full_Time );

							$('#sr_Contract').html( response.job_type_count.Contract );

							$('#sr_Part_Time').html( response.job_type_count.Part_Time );

							$('#sr_Remote').html( response.job_type_count.Remote );

							$('#sr_Temporary').html( response.job_type_count.Temporary );

							$('.sr_listen_hot').click(function(){

								btn_job_id =  $( this ).attr('data-job-id') ;

								sr_situation = hot_buttons_to_listen_to[ btn_job_id ] ;
								
								// Change color 								
								if( sr_situation == 'sr_not_hot' ){

									sr_situation = 'sr_is_hot';

									$( this ).addClass('sr_is_hot') ;

								}
								else{
									
									sr_situation = 'sr_not_hot';

									$( this ).removeClass('sr_is_hot') ;

								}

								// Updated local db
								hot_buttons_to_listen_to[ btn_job_id ] = sr_situation ;

								// Update server db 
								srb_manager.update_hot_button( btn_job_id , sr_situation );

							});

							$('.sr_listen_urgent').click(function(){

								btn_job_id =  $( this ).attr('data-job-id') ;

								sr_situation = urgent_buttons_to_listen_to[ btn_job_id ] ;

								// alert(urgent_buttons_to_listen_to[ btn_job_id ] );
								
								// Change color 
								if( sr_situation == 'sr_not_urgent' ){

									sr_situation = 'sr_is_urgent';

									$( this ).addClass('sr_is_urgent') ;


								}
								else{
									
									sr_situation = 'sr_not_urgent';

									$( this ).removeClass('sr_is_urgent') ;


								}

								// Updated local db
								urgent_buttons_to_listen_to[ btn_job_id ] = sr_situation ;

								// Update server db 
								srb_manager.update_urgent_button( btn_job_id , sr_situation );

							});
							 
						}
						else{
							
							$( '#srb_resumelist' ).html('<span id="single_notification_pod" style="padding:15px;"> <center> No jobs at the moment</center></span>');
						
						}
					
					},  
				
					error: function (response) {

						
						console.log('There was an error when getting jobs.');
			
					}
				
				});
				
			},

			"update_hot_button":function( btn_job_id , sr_situation ){

				var form_data = new FormData();

				form_data.append('action', 'srb_update_hot_button' );
								
				form_data.append('job_id', btn_job_id );

				form_data.append('situation', sr_situation );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						console.log(response);

					},  
				
					error: function (response) {

						console.log('There was an error man.');
			
					}
				
				});

			},

			"update_urgent_button":function( btn_job_id , sr_situation ){

				var form_data = new FormData();

				form_data.append('action', 'srb_update_urgent_button' );
								
				form_data.append('job_id', btn_job_id );

				form_data.append('situation', sr_situation );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						console.log(response);

					},  
				
					error: function (response) {

						console.log('There was an error man.');
			
					}
				
				});



			},

			"search_jobs":function(){

				var form_data = new FormData();

				form_data.append('action', 'srb_search_all_jobs' );
/*
				console.log( sr_search_options.sr_s_shared_jobs );
						
				console.log(  sr_search_options.sr_s_my_jobs  );

				console.log( sr_search_options.sr_s_hot_jobs );
						
				console.log( sr_search_options.sr_s_Urgent_jobs );
				
				console.log( sr_search_options.sr_s_fulltime );
						
				console.log( sr_search_options.sr_s_contract );
						
				console.log( sr_search_options.sr_s_parttime  );
						
				console.log( sr_search_options.sr_s_remote );
						
				console.log( sr_search_options.sr_s_temporary );

*/

console.log( sr_search_options.sr_s_fulltime );

				form_data.append('sr_s_keyword', $('#sr_s_keyword').val() );

				form_data.append('sr_s_location',$('#sr_s_location').val() );

						
				form_data.append('sr_s_shared_jobs',sr_search_options.sr_s_shared_jobs );
						
				form_data.append('sr_s_my_jobs',sr_search_options.sr_s_my_jobs );

				form_data.append('sr_s_hot_jobs',sr_search_options.sr_s_hot_jobs );
						
				form_data.append('sr_s_Urgent_jobs',sr_search_options.sr_s_Urgent_jobs );

				
				form_data.append('sr_s_fulltime',sr_search_options.sr_s_fulltime );
						
				form_data.append('sr_s_contract',sr_search_options.sr_s_contract );
						
				form_data.append('sr_s_parttime',sr_search_options.sr_s_parttime );
						
				form_data.append('sr_s_remote',sr_search_options.sr_s_remote );
						
				form_data.append('sr_s_temporary', sr_search_options.sr_s_temporary );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						console.log(response);

						response =  JSON.parse( response );

						$('#search_job_message').hide();
			
						
						if( Object.keys(response).length > 0 ){

							$( '#srb_joblist' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead">
								<button class="main__btn main__btn--margin" type="button"><span>load more</span></button>
							</div>
							<!-- end view more -->`);

							for(var k in response.jobs) {
								 
								console.log(k);

								var hot_class = 'sr_listen_not_hot';

								var urgent_class = 'sr_listen_not_urgent';

								if( response.jobs[k].is_job_owner == true ){

									hot_buttons_to_listen_to[k] = response.jobs[k].hot_button ;
									
									urgent_buttons_to_listen_to[k] = response.jobs[k].urgent_button ;

									hot_class = 'sr_listen_hot';

									urgent_class = 'sr_listen_urgent';
									
								}
							
								$( '#srb_lead' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-12">
									<div class="profile">
										<div class="profile__logo col-lg-2">
											<img src="`+ response.jobs[k].job_logo +`" alt="">
										</div>
										
										<div class="profile__wrap col-lg-5 ">
											<h2 class="profile__title"><a href=""><strong><h4>`+ response.jobs[k].job_title +`</h4> <span class"srb_float_right srb_green">`+ response.jobs[k].job_status +`</span></strong></a></h2>
											
											<p class="profile__text"><span class="sbr_gray"><strong> `+ response.jobs[k].job_agency +`</strong></span></p>
											<p><span><strong>Salary: <span class="srb_green"> `+ response.jobs[k].job_salary +` </span> </strong></span> <span><strong>Hourly:  <span class="srb_green"> `+ response.jobs[k].job_hourly +` </span></strong></span>  <span><strong>Type:  <span class="srb_green"> `+ response.jobs[k].job_type +` </span> </strong></span> </p>
											
										</div>
		
										<div class="col-lg-3 sbr_left_gray_border">
												<span class="col-lg-12"> <strong> <span class="srb_gray"> <h4>Split</h4> </strong></span></span>
												<span class="col-lg-12"> <span class="srb_green" > <strong><h3>$`+ response.jobs[k].job_split +`</h3></strong></span>
											</div>
											<div class="col-lg-2" class="srb_left_line">
												<span class="col-lg-12"><span class="board_right_blue"><a href="`+ response.jobs[k].kanban_link +`">BOARD</a></span></span>
												<span class="col-lg-12"><!-- Default switch -->
													<div class="custom-control custom-switch">
													 <i class="fa fa-exclamation-circle sbr_icon_right  `+ urgent_class +` srb_red sbr_float_left ` + response.jobs[k].urgent_button + ` " data-job-id="`+k+`"></i>
													 <i class="fa fa-fire srb_red sbr_icon_right  `+ hot_class +` sbr_float_left  ` + response.jobs[k].hot_button +`" data-job-id="`+k+`"></i>
													</div>
												</span>
											</div>
									</div>
								</div>
								<!-- end profile -->`);


							}
								
							$('#sr_Full_Time').html( response.job_type_count.Full_Time );

							$('#sr_Contract').html( response.job_type_count.Contract );

							$('#sr_Part_Time').html( response.job_type_count.Part_Time );

							$('#sr_Remote').html( response.job_type_count.Remote );

							$('#sr_Temporary').html( response.job_type_count.Temporary );

							$('.sr_listen_hot').click(function(){

								btn_job_id =  $( this ).attr('data-job-id') ;

								sr_situation = hot_buttons_to_listen_to[ btn_job_id ] ;
								
								// Change color 								
								if( sr_situation == 'sr_not_hot' ){

									sr_situation = 'sr_is_hot';

									$( this ).addClass('sr_is_hot') ;

								}
								else{
									
									sr_situation = 'sr_not_hot';

									$( this ).removeClass('sr_is_hot') ;

								}

								// Updated local db
								hot_buttons_to_listen_to[ btn_job_id ] = sr_situation ;

								// Update server db 
								srb_manager.update_hot_button( btn_job_id , sr_situation );

							});

							$('.sr_listen_urgent').click(function(){

								btn_job_id =  $( this ).attr('data-job-id') ;

								sr_situation = urgent_buttons_to_listen_to[ btn_job_id ] ;

								// alert(urgent_buttons_to_listen_to[ btn_job_id ] );
								
								// Change color 
								if( sr_situation == 'sr_not_urgent' ){

									sr_situation = 'sr_is_urgent';

									$( this ).addClass('sr_is_urgent') ;


								}
								else{
									
									sr_situation = 'sr_not_urgent';

									$( this ).removeClass('sr_is_urgent') ;


								}

								// Updated local db
								urgent_buttons_to_listen_to[ btn_job_id ] = sr_situation ;

								// Update server db 
								srb_manager.update_urgent_button( btn_job_id , sr_situation );

							});
							 
						}
						else{
							
							$( '#srb_resumelist' ).html('<span id="single_notification_pod" style="padding:15px;"> <center> No jobs at the moment</center></span>');
						
						}
					
					},  
				
					error: function (response) {

						console.log('There was an error wneh getting Job.');
			
					}
				
				});

			}

		};

		srb_manager.init();
		
		$('#sr_s_shared_jobs').click(function(){
			
			sr_search_options.sr_s_shared_jobs = sr_search_options.sr_s_shared_jobs == 'off' ? 'on' : 'off';

		})

		$('#sr_s_my_jobs').click(function(){
			
			sr_search_options.sr_s_my_jobs = sr_search_options.sr_s_my_jobs == 'off' ? 'on' : 'off';

			})

		$('#sr_s_hot_jobs').click(function(){
		
			sr_search_options.sr_s_hot_jobs = sr_search_options.sr_s_hot_jobs == 'off' ? 'on' : 'off';

			})

		$('#sr_s_Urgent_jobs').click(function(){
			
			sr_search_options.sr_s_Urgent_jobs = sr_search_options.sr_s_Urgent_jobs == 'off' ? 'on' : 'off';

			})


		 $('#sr_s_fulltime').click(function(){

			sr_search_options.sr_s_fulltime = sr_search_options.sr_s_fulltime == 'off' ? 'on' : 'off';

			})

		$('#sr_s_contract').click(function(){
			
			sr_search_options.sr_s_contract = sr_search_options.sr_s_contract == 'off' ? 'on' : 'off';

		})

		$('#sr_s_parttime').click(function(){
		
			sr_search_options.sr_s_parttime = sr_search_options.sr_s_parttime == 'off' ? 'on' : 'off';

			})

		$('#sr_s_remote').click(function(){
		
			sr_search_options.sr_s_remote = sr_search_options.sr_s_remote == 'off' ? 'on' : 'off';

		})

		$('#sr_s_temporary').click(function(){
			
			sr_search_options.sr_s_temporary = sr_search_options.sr_s_temporary == 'off' ? 'on' : 'off';

		})

		  

		$('#sr_search_jobs').click(function() {
			
			$('#search_job_message').show();
			
			srb_manager.search_jobs();
		
		});

	});
}
