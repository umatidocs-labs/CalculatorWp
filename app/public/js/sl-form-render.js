jQuery(document).ready(function($) {
    
    if( typeof formRenderOptions == 'object'){
        const renderContainer = $('#render-container')
        const formRenderInstance = renderContainer.formRender(formRenderOptions);
        const html = renderContainer.formRender('html'); // HTML DOM nodes
        const htmlString = html.outerHTML;
    }

    $('.render-container-submit-button').click( function(){
        $('.form-control').each( function( i, obj ) {
            var render_container_data = [];
            //test
            render_container_data[ obj.attr('name') ] = {
                'name' : obj.attr('name'),
                'title' : $( '[for="' + obj.attr('name') + '"]' ).html(),
                'val' : obj.val(),
            } ;

            // if(file process file)
            
        } );
    } )

} );