var CAHNRS_IR = {
	
	init:function(){
		
		CAHNRS_IR.edit_image.init();
		
	}, // end init
	
	edit_image: {
		
		init: function(){
			
			jQuery('.cahnrswp-ir-image .cahnrs-ir-edit-image').on('click' , function( e ){
					e.preventDefault();
					CAHNRS_IR.edit_image.show_modal( jQuery( this ) );
			})
			
		}, // end init
		
		show_modal: function( ic ){
			
			if ( typeof wp !== 'undefined' && wp.media && wp.media.editor) {
				
				var button = ic;
				
				var inpt = ic.siblings('input');
				
				wp.media.editor.open( button );
				wp.media.editor.send.attachment = function( props, attachment ) {
					
					ic.parents('.cahnrswp-ir-image').css( 'background-image' , 'url(' + attachment.url + ')' );
					
					inpt.val( attachment.url );
				};
				return false;
				
			} // end if
			
		}, // end show_modal
		
	}, // end edit_image
	
}

CAHNRS_IR.init();