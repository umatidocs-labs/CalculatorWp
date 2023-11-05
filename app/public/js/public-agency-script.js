function sr_agency_board_loader(){
	
	jQuery(document).ready(function($) {
		
		var sr_agency_list_invite = {};

		var sr_job_list_invite = {};

		$('#sr_invite_j').click(function(){
			
			$('#sr_select_jobs').show();

			srb_manager.load_all_jobs();
		
		});

		$('#sr_close_jl').click(function(){
		
			$('#sr_select_jobs').hide();
		
		});
		$('#my_invite_button').show();
		
		var srb_manager = {

			"init":function() {

				srb_manager.load_all_agencies();

			},
			"load_all_agencies":function() {

				var form_data = new FormData();

				form_data.append('action', 'srb_get_all_agencies');
				
				form_data.append('user_name'," Gilbert " );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						console.log( response );

						console.log(response.length);
						
						response =  JSON.parse( response );

						if( Object.keys(response).length > 0 ){

							$( '#srb_agencylist' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead">
								<button class="main__btn main__btn--margin" type="button"><span>load more</span></button>
							</div>
							<!-- end view more -->`);


							console.log(sr_agency_list_invite);

							for(var k in response) {

								$( '#srb_lead' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-12">
									<div class="profile">
										<div class="profile__logo col-lg-2">
											<img src="`+response[k].profile_url+`" alt="">
										</div>
										
										<div class="profile__wrap col-lg-5 ">
											<h2 class="profile__title"><a href=" + response[k].user_url + "><strong><h4> ` + response[k].agency_name + `</h4></strong></a></h2>											
											
										</div>
		
										<div class="col-lg-4 sbr_left_gray_border">
										</div>
										<div class="col-lg-1">
										<ul class="custom-control custom-switch">
											<li>
												<label class="switch">
													<input id="sr_s_fulltime`+k+`" type="checkbox">
													<span class="slider round agency_selector" data-agency-id="`+k+`"></span>										
												</label>											
											</li>
										</ul>
										</div>
									</div>
								</div>
								<!-- end profile -->`);

								sr_agency_list_invite[k] = 0 ;
				
							}

							$('.agency_selector').click(function(){
								
								agency_id =  $(this).attr('data-agency-id');

								if (sr_agency_list_invite[agency_id] == 0 ) {
								
									sr_agency_list_invite[agency_id] = 1 ;
								
								}
								else{

									sr_agency_list_invite[agency_id] = 0 ;
								
								}

								console.log( sr_agency_list_invite );
							
							});					

						}
						else{
							
							$( '#srb_resumelist' ).html('<span id="single_notification_pod" style="padding:15px;"> <center> No candidate at the moment</center></span>');
						
						}
					
					},  
				
					error: function (response) {

						
						console.log('There was an error wneh getting notifificationss.');
			
					}
				
				});
				
			},

			"make_invitation": function(i_data){

				console.log(i_data);

				var form_data = new FormData();

				form_data.append('action', 'srb_invite_agencies_i');
				
				form_data.append( 'i_agency' , i_data.agency );

				form_data.append( 'i_job' , i_data.job );


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

						
						console.log('There was an error wneh getting notifificationss.');
			
					}
				
				});
				
			},

			"load_all_jobs":function() {

				var form_data = new FormData();

				form_data.append('action', 'srb_get_all_jobs_i');
				
				form_data.append('user_name'," Gilbert " );

				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						console.log( response );

						response =  JSON.parse( response );

						if( Object.keys(response).length > 0 ){

							$( '#my_job_list_inner' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead_j">
								
							</div>
							<!-- end view more -->`);

							for(var k in response) {

								$( '#srb_lead_j' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-12">
									<div class="profile">
										<div class="profile__logo col-lg-2">
										
										</div>
										
										<div class="profile__wrap col-lg-5 ">
											
											<h5 class="profile__title"><a href=" `+ response[k].url + `"><strong><h4> ` + response[k].job_name + `</h4></strong></a></h5>											
											
										</div>
		
										<div class="col-lg-4 sbr_left_gray_border">
										</div>
										<div class="col-lg-1">
										<ul class="custom-control custom-switch">
											<li>
												<label class="switch">
													<input id="sr_s_fulltime`+k+`" type="checkbox">
													<span class="slider round job_selector" data-job-id="`+k+`"></span>										
												</label>											
											</li>
										</ul>
										</div>
									</div>
								</div>
								<!-- end profile -->`);

								sr_job_list_invite[k] = 0 ;
				
							}

							$('#sr_send_invite_j').click(function(){

								$('#inviting_message').show();

								for(var k in sr_job_list_invite) {
								
									if(sr_job_list_invite[k] == 1 ){

										for( var b in sr_agency_list_invite ) {

											if( sr_agency_list_invite[b] == 1 ) {
												invite_dat = {
													
													'agency':b,
													
													'job':k
												
												};

												srb_manager.make_invitation( invite_dat );
													
												$('#inviting_message').hide();

												$( '#my_job_list_inner' ).html(`
														<!-- view more -->
														<br><br>
														<center>Invites have been made!</center>
														<br><br>
														<!-- end view more -->`);

											}
										}

									}
								}


							});

							$('.job_selector').click(function(){
								
								job_id =  $(this).attr('data-job-id');

								if (sr_job_list_invite[ job_id ] == 0 ) {
								
									sr_job_list_invite[ job_id ] = 1 ;
								
								}
								else{

									sr_job_list_invite[ job_id ] = 0 ;
								
								}

								console.log( sr_job_list_invite );
							
							});					

						}
						else{
							
							$( '#my_job_list_inner' ).html('<span id="single_notification_pod" style="padding:15px;"> <center> No job in your agency at the moment</center></span>');
						
						}
					
					},  
				
					error: function (response) {

						
						console.log('There was an error wneh getting notifificationss.');
			
					}
				
				});
				
			},

			"search_agencies":function(){

				var form_data = new FormData();

				form_data.append('action', 'srb_search_all_agency' );
								
				form_data.append('sr_s_keyword', $('#sr_s_keyword').val() );


				jQuery.ajax({
				
					url: ajax_object.ajax_url,

					type: 'post',

					contentType: false,

					processData: false,

					data: form_data,
				
					success: function ( response ) {

						response =  JSON.parse( response );

						$('#search_candidates_message').hide();
			
						if( Object.keys(response).length > 0 ){

							$( '#srb_agencylist' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead">
								<button class="main__btn main__btn--margin" type="button"><span>load more</span></button>
							</div>
							<!-- end view more -->`);

							for(var k in response) {

								console.log(typeof response[k].profile_url);

								if ( typeof response[k].profile_url == 'null' ) {

									alert('null');
									
									response[k].profile_url = "/wp-content/plugins/splitreq_boards/app/public/img/user.svg" ; 
								
								}

								$( '#srb_lead' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-12">
									<div class="profile">
										<div class="profile__logo col-lg-2">
											<img src="`+response[k].profile_url+`" alt="">
										</div>
										
										<div class="profile__wrap col-lg-5 ">
											<h2 class="profile__title"><a href=" + response[k].user_url + "><strong><h4> ` + response[k].agency_name + `</h4></strong></a></h2>											
											
										</div>
		
										<div class="col-lg-4 sbr_left_gray_border">
										</div>
										<div class="col-lg-1">
										<ul class="custom-control custom-switch">
											<li>
												<label class="switch">
													<input id="sr_s_fulltime`+k+`" type="checkbox">
													<span class="slider round agency_selector" data-agency-id="`+k+`"></span>										
												</label>											
											</li>
										</ul>
										</div>
									</div>
								</div>
								<!-- end profile -->`);
				
							}
						}
						else{
							
							$( '#srb_resumelist' ).html('<span id="single_notification_pod" style="padding:15px;"> <center> No candidate at the moment</center></span>');
						
						}
					
					},  
				
					error: function (response) {

						console.log('There was an error when getting candidates.');
			
					}
				
				});

			}

		};

		srb_manager.init();
		
		$('#search_candidates').click(function() {
			
			$('#search_candidates_message').show();
			
			srb_manager.search_agencies();
		
		});

	});
}
