jQuery(document).ready(function($) {
    
    if( typeof formRenderOptions == 'object'){
        const renderContainer = $('#render-container')
        const formRenderInstance = renderContainer.formRender(formRenderOptions);
        const html = renderContainer.formRender('html'); // HTML DOM nodes
        const htmlString = html.outerHTML;
    }

    $('[type="radio"]').click(function(e) { // console.log( $(this).attr('name') );
        $( '[name="'+$(this).attr('name')+'"]' ).attr( 'checked', false );
        $( this ).attr( 'checked', true );
    } );

    var droppedFiles = [];

    var sl_file_manager = {

        'listener' : function(){

            $('[type="file"]' ).change( function() {

                if( $( this ).attr('class') == 'form-control' ){

                    sl_name = $( this ).attr('name'); // console.log( droppedFiles );
                    // console.log( $( this ).prop('files') );

                    droppedFiles[ sl_name ] = [] ;

                    droppedFiles[ sl_name ]['name']     = sl_name;
                    droppedFiles[ sl_name ]['title']    = $( '[for="' + $( this ).attr('name') + '"]' ).text() ;
                    droppedFiles[ sl_name ]['val']      = $( this ).prop('files');
                    droppedFiles[ sl_name ]['type']     = 'file';

                    $('#sl_files_file_is_changed').val( '1' ); // console.log( droppedFiles ) ;

                }

            } ) ;
        }

    }

    sl_file_manager.listener();

    var sl_front_end_form = {

        "save_values_to_server": function(){

			var form_data = new FormData() ;

			form_data.append( 'action' , 'ls_save_values_to_server' );
            form_data.append( 'form_id' , $('#sl_bf_form_id').val() );
            form_data.append( 'sl_files_file_is_changed' , $('#sl_files_file_is_changed').val() ) ;

            $('.form-control').each( function( i, obj ) {

                if(  obj.type == 'file' ) {

                    form_data.append( obj.name ,  JSON.stringify( {

                        'name' : obj.name,
                        'title' : $( '[for="' + obj.name + '"]' ).html(),
                        'val' : obj.name +'-f',
                        'type' : 'file'
                        
                    } ) );

                    form_data.append( obj.name + '-f' , obj.files[0] ) ;

                }
                else{

                    form_data.append( obj.name ,  JSON.stringify( {
                        'name' : obj.name,
                        'title' : $( '[for="' + obj.name + '"]' ).html(),
                        'val' : obj.value,
                        'type' : 'text'
                    } ) );

                }
                
            } ) ;

            $('[type="radio"]').each( function( i, obj ) {

                if( $( this ).attr('checked') == 'checked' ) {

                    form_data.append( obj.name ,  JSON.stringify( {

                        'name' : obj.name,
                        'title' : $( '[for="' + obj.name + '"]' ).html(),
                        'val' : $( this ).val(),

                    } ) );

                }
                
            } ) ;

			jQuery.ajax( {

				url: ajax_object.ajax_url,
				type: 'post',
				contentType: false,
				processData: false,
				data: form_data,
				success: function ( response ) {
                    console.log( response ) ;
                    // response = JSON.parse( response ) ;
                    window.location = window.location.href;
				},
				error: function ( response ) {
					console.log( response ) ;
				}

			} ) ;

        }

    } ;

    $('.render-container-submit-button').click( function( e ){

        e.preventDefault() ;
        sl_front_end_form.save_values_to_server() ;

    } )

} );