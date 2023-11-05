function sr_board_client_loader(){
	
	jQuery(document).ready(function($) {		

		var srb_manager = {

			"init":function() {

				srb_manager.load_all_clients();

			},
			"load_all_clients":function() {

				var form_data = new FormData();

				form_data.append('action', 'srb_get_all_clients');

				form_data.append('sr_s_keyword', $('#sr_s_keyword').val() );

				form_data.append('sr_s_category', $('#sr_s_category').val() );

				form_data.append('sr_s_series', $('#sr_s_series').val() );

				form_data.append('sr_s_location', $('#sr_s_location').val() );
				
				
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

							$( '#srb_clientlist' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead">
								<button class="main__btn main__btn--margin" type="button"><span>load more</span></button>
							</div>
							<!-- end view more -->`);

							for(var k in response) {

								$( '#srb_lead' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-4">
									<div class="profile">
										
										<div class="profile__logo col-lg-5">
											<img src="` +response[k].image_url+`" alt="">

											<br><br>

											<span>` +response[k].location+`</span>
										</div>
										
										<div class="profile__wrap col-lg-7 ">
											<h2 class="profile__title"><a href="">Video Hive </a></h2>
											
											<p class="profile__text"><span class="sbr_gray"> Digital services </span></p>
											<p>
											<span class="post__actions"> 
												<a class="post__actions-btn post__actions-btn--green" style="color:#fff;float:right;"> <i class="fa fa-bookmark"></i> </a>
												<a class="post__actions-btn post__actions-btn--red" style="color:#fff;float:right;"> <i class="fa fa-envelope"></i> </a>
											</span> 
											</p>
											
										</div>
		
									</div>
								</div>
								<!-- end profile -->`);
				
							}
						}
						else{
							
							$( '#srb_resumelist' ).html('<span id="single_notification_pod" style="padding:15px;"> <center> No client at the moment</center></span>');
						
						}
					
					},  
				
					error: function (response) {

						
						console.log('There was an error when getting client.');
			
					}
				
				});
				
			},

			"search_candidates":function(){

				var form_data = new FormData();

				form_data.append('action', 'srb_search_all_clients' );
								
				form_data.append('sr_s_keyword', $('#sr_s_keyword').val() );

				form_data.append('action', 'srb_get_all_clients');

				form_data.append('sr_s_keyword', $('#sr_s_keyword').val() );

				form_data.append('sr_s_category', $('#sr_s_category').val() );

				form_data.append('sr_s_series', $('#sr_s_series').val() );

				form_data.append('sr_s_location', $('#sr_s_location').val() );
				
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

							$( '#srb_clientlist' ).html(`
							<!-- view more -->
							<div class="col-12" id="srb_lead">
								<button class="main__btn main__btn--margin" type="button"><span>load more</span></button>
							</div>
							<!-- end view more -->`);

							for(var k in response) {

								$( '#srb_lead' ).before( `<!-- profile -->
								<div class="col-12 col-sm-6 col-md-12 col-lg-4">
									<div class="profile">
										
										<div class="profile__logo col-lg-5">
											<img src="` +response[k].image_url+`" alt="">

											<br><br>

											<span>` +response[k].location+`</span>
										</div>
										
										<div class="profile__wrap col-lg-7 ">
											<h2 class="profile__title"><a href="">Video Hive </a></h2>
											
											<p class="profile__text"><span class="sbr_gray"> Digital services </span></p>
											<p>
											<span class="post__actions"> 
												<a class="post__actions-btn post__actions-btn--green" style="color:#fff;float:right;"> <i class="fa fa-bookmark"></i> </a>
												<a class="post__actions-btn post__actions-btn--red" style="color:#fff;float:right;"> <i class="fa fa-envelope"></i> </a>
											</span> 
											</p>
											
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
		
	});
}
