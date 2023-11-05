
function sr_js_resent_candidate_widget(){

	jQuery(document).ready(function($) {
		
		var srb_resent_resume = {

			"init":function() {

				srb_resent_resume.load_recent_resumes();

            },
            "load_recent_resumes":function(){

				var form_data = new FormData();

				form_data.append('action', 'sr_get_resent_resumes' );

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

                            console.log(response);
            
                            $( '#srb_resent_resume_list' ).html(`
                            <!-- view more -->
                            <div class="col-12" id="srb_resent_lead">
                              
                            </div>
                            <!-- end view more -->`);
            
                            for(var k in response.resume) {
                                 
                                console.log(k);
            
                              /*  var hot_class = 'sr_listen_not_hot';
            
                                var urgent_class = 'sr_listen_not_urgent';
            
                                if( response.jobs[k].is_job_owner == true ){
            
                                    hot_buttons_to_listen_to[k] = response.jobs[k].hot_button ;
                                    
                                    urgent_buttons_to_listen_to[k] = response.jobs[k].urgent_button ;
            
                                    hot_class = 'sr_listen_hot';
            
                                    urgent_class = 'sr_listen_urgent';
                                    
                                }*/

                                if (response.resume[k].img_type == 'ab' ) {
                                  
                                    img_pic = '<span class="sr_img_area" >'+ response.resume[k].ab +'</span>';
                                
                                }
                                else{
                                    img_pic = '<img src="'+response.resume[k].img_url+'">';

                                }
                            
                                $( '#srb_resent_lead' ).before( `<div class="profile_side_bar">
                                    <div class="profile__logo">
                                        ` + img_pic + `
                                    </div>
                                                                    
                                    <div class="profile__wrap">
                                        <h2 class="profile__title">`+ response.resume[k].name +`</h2>
                                                            
                                            <p class="profile__text">`+response.resume[k].current_title+`</p>
                                
                                            <p><span>Salary: <span class="srb_green"> `+response.resume[k].salary+`</span> </span><span>Hourly:<span class="srb_green"> `+response.resume[k].hourly+`</span></span></p>
                                    </div>
                                </div>`);
            
            
                            }
            
                    
						}
						else{
							
							$( '#srb_resumelist' ).html('<span id="single_notification_pod" style="padding:15px;"> <center> No viewed resume </center></span>');
						
						}
					
					},  
				
					error: function (response) {

						console.log('There was an error wneh getting Job.');
			
					}
				
				});

            }
            
        }
   
        srb_resent_resume.init();

    })

}