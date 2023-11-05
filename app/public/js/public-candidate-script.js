function sr_board_loader(){
	
	jQuery(document).ready(function($) {		

		var srb_manager = {

			"init":function() {

				srb_manager.load_all_candidates();

			},
			"load_all_candidates":function() {

				var form_data = new FormData();

				form_data.append('action', 'srb_get_all_resumes');
				
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

							$( '#srb_resumelist' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead">
								<button class="main__btn main__btn--margin" type="button"><span>load more</span></button>
							</div>
							<!-- end view more -->`);

							for(var k in response) {

								$( '#srb_lead' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-12">
									<div class="profile">
										<div class="profile__logo col-lg-2">
											<img src="`+response[k].profile_url+`" alt="">
										</div>
										
										<div class="profile__wrap col-lg-5 ">
											<h2 class="profile__title"><a href="` + response[k].user_url + `"><strong><h4>` + response[k].candidate_name + `</h4></strong></a></h2>
											
											<p class="profile__text"><span class="sbr_gray"><strong>` + response[k].candidate_title + `</strong></span></p>
											<p><span><strong>Salary: <span class="srb_green">$`+response[k].salary+` </span> </strong></span> <span><strong>Hourly:  <span class="srb_green"> $`+response[k].hourly+`  </span></strong></span>  <span><strong>Type:  <span class="srb_green"> `+response[k].employment_type+`  </span> </strong></span> </p>
											
										</div>
		
										<div class="col-lg-4 sbr_left_gray_border">
												<span class="col-lg-12"> <strong> <i class="fa fa-phone"></i>  <span class="srb_blue" >`+response[k].phone+` </strong></span></span>
												<span class="col-lg-12"> <span class="srb_gray" > <strong> <i class="fa fa-envelope-o"></i></span> <span class="srb_blue" >`+response[k].email+`</span></strong></span>
												<span class="col-lg-12"> <span class="srb_blue" > <strong> <i class="fa fa-map-marker"></i></span>  <span class="srb_gray" >`+response[k].location+`</span></strong></span>
											</div>
											<div class="col-lg-1">
												<span class="col-lg-12"><i class="fa fa-heart srb_red love_this_candididate sbr_must_display sbr_float_right" data-candidate-id="`+k+`"></i></span>
												<span class="col-lg-12"><!-- Default switch -->
													<div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="selct_candidate_`+k+`">											
														<label class="custom-control-label" for="customSwitches">Select</label>
													</div>
												</span>
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

						
						console.log('There was an error wneh getting notifificationss.');
			
					}
				
				});
				
			},

			"search_candidates":function(){

				var form_data = new FormData();

				form_data.append('action', 'srb_search_all_resumes' );
								
				form_data.append('sr_s_keyword', $('#sr_s_keyword').val() );

				form_data.append('sr_s_location',$('#sr_s_location').val() );
						
				form_data.append('sr_s_favorite',$('#sr_s_favorite').val() );
						
				form_data.append('sr_s_submitted',$('#sr_s_submitted').val() );
						
				form_data.append('sr_s_fulltime',$('#sr_s_fulltime').val() );
						
				form_data.append('sr_s_contract',$('#sr_s_contract').val() );
						
				form_data.append('sr_s_parttime',$('#sr_s_parttime').val() );
						
				form_data.append('sr_s_remote',$('#sr_s_remote').val() );
						
				form_data.append('sr_s_temporary',$('#sr_s_temporary').val() );

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

							$( '#srb_resumelist' ).html(`
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
											<h2 class="profile__title"><a href="` + response[k].user_url + `"><strong><h4>` + response[k].candidate_name + `</h4></strong></a></h2>
											
											<p class="profile__text"><span class="sbr_gray"><strong>` + response[k].candidate_title + `</strong></span></p>
											<p><span><strong>Salary: <span class="srb_green">$`+response[k].salary+` </span> </strong></span> <span><strong>Hourly:  <span class="srb_green"> $`+response[k].hourly+`  </span></strong></span>  <span><strong>Type:  <span class="srb_green"> `+response[k].employment_type+`  </span> </strong></span> </p>
											
										</div>
		
										<div class="col-lg-4 sbr_left_gray_border">
												<span class="col-lg-12"> <strong> <i class="fa fa-phone"></i>  <span class="srb_blue" >`+response[k].phone+` </strong></span></span>
												<span class="col-lg-12"> <span class="srb_gray" > <strong> <i class="fa fa-envelope-o"></i></span> <span class="srb_blue" >`+response[k].email+`</span></strong></span>
												<span class="col-lg-12"> <span class="srb_blue" > <strong> <i class="fa fa-map-marker"></i></span>  <span class="srb_gray" >`+response[k].location+`</span></strong></span>
											</div>
											<div class="col-lg-1">
												<span class="col-lg-12"><i class="fa fa-heart srb_red love_this_candididate sbr_must_display sbr_float_right" data-candidate-id="`+k+`"></i></span>
												<span class="col-lg-12"><!-- Default switch -->
													<div class="custom-control custom-switch">
														<input type="checkbox" class="custom-control-input" id="selct_candidate_`+k+`">											
														<label class="custom-control-label" for="customSwitches">Select</label>
													</div>
												</span>
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

						console.log('There was an error wneh getting candidates.');
			
					}
				
				});

			}

		};

		srb_manager.init();
		
		document.getElementById('sr_s_favorite').addEventListener('change', (e) => {
			this.checkboxValue = e.target.checked ? 'on' : 'off';
			console.log(this.checkboxValue)
		  })

		  document.getElementById('sr_s_submitted').addEventListener('change', (e) => {
			this.checkboxValue = e.target.checked ? 'on' : 'off';
			console.log(this.checkboxValue)
		  })

		  document.getElementById('sr_s_fulltime').addEventListener('change', (e) => {
			this.checkboxValue = e.target.checked ? 'on' : 'off';
			console.log(this.checkboxValue)
		  })

		  document.getElementById('sr_s_contract').addEventListener('change', (e) => {
			this.checkboxValue = e.target.checked ? 'on' : 'off';
			console.log(this.checkboxValue)
		  })

		  document.getElementById('sr_s_parttime').addEventListener('change', (e) => {
			this.checkboxValue = e.target.checked ? 'on' : 'off';
			console.log(this.checkboxValue)
		  })

		  document.getElementById('sr_s_remote').addEventListener('change', (e) => {
			this.checkboxValue = e.target.checked ? 'on' : 'off';
			console.log(this.checkboxValue)
		  })

		  document.getElementById('sr_s_temporary').addEventListener('change', (e) => {
			this.checkboxValue = e.target.checked ? 'on' : 'off';
			console.log(this.checkboxValue)
		  })


		  $('#sr_s_favorite').click();
						
		  $('#sr_s_submitted').click();
				  
			$('#sr_s_fulltime').click();
				  
			$('#sr_s_contract').click();
				  
		  $('#sr_s_parttime').click();
				  
		  $('#sr_s_remote').click();
				  
		  $('#sr_s_temporary').click();

			$('#search_candidates').click(function() {
			
			$('#search_candidates_message').show();
			
			srb_manager.search_candidates();
		
		});

	});
}
