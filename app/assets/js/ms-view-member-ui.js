jQuery( document ).ready( function( $ ) {

	$( '.ms-radio-slider' ).click( function() {
		var object = this;
		var child = $( object ).find(".toggle a").first();
        var value = child.attr("href");
		
		if ( !$( object ).hasClass('processing') ) {
			
			$( object ).addClass('processing');
			
			if ( $( object ).hasClass( 'on' ) ) {
	            $( object ).removeClass( 'on' );
	        } 
	        else { 
	            $( object ).addClass( 'on' );
	        }			
	        
			$.ajax({
				type: "GET",
				url: value
			})
			.done( function (data) {
				$( object ).removeClass('processing');
			})
			.fail( function (data) {
				console.log(data);
		        if ( $( object ).hasClass( 'on' ) ) {
		            $( object ).removeClass( 'on' );
		        } 
		        else { 
		            $( object ).addClass( 'on' );
		        }							
				$( object ).removeClass('processing');					
			});			
		}
		
	});
	
});
