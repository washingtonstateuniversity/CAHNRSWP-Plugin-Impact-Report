(function($) {

	var next_page = parseInt( $( '#load-more-impact-reports a' ).data( 'page' ) ) + 1,
			total_pages = parseInt( $( '#load-more-impact-reports a' ).data( 'max' ) );

	// Pagination
	$( '#load-more-impact-reports' ).on( 'click', 'a', function( event ) {

		event.preventDefault();

		var more_button = $(this);

		more_button.data( 'loaded', next_page );

		if ( next_page <= total_pages ) {

			$.ajax({
				url: impacts.ajaxurl,
				type: 'post',
				data: {
					action: 'extension_impacts_request',
					page: next_page
				},
				beforeSend: function() {
					more_button.text( 'Loading...' );
				},
				success: function( html ) {
					$( '#impact-reports' ).append( html );
					if ( next_page <= total_pages ) {
						more_button.text( 'More' );
					} else {
						$( '#load-more-impact-reports' ).hide();
					}
				}
			})

		} else {

			$( '#load-more-impact-reports' ).hide();

		}	

		next_page++;

	})

	// Term filter
	$( '.browse-terms' ).on( 'click', 'a', function( event ) {

		event.preventDefault();

		var term = $(this),
				type = term.data( 'type' ),
				slug = term.data( 'slug' );
				
		if ( ! term.hasClass( 'active' ) ) {

			$( '.browse-terms li a' ).removeClass( 'active' );

			$( '#load-more-impact-reports' ).hide();

			term.addClass( 'active' );

			$.ajax({
				url: impacts.ajaxurl,
				type: 'post',
				data: {
					action: 'extension_impacts_request',
					type: type,
					term: slug,
				},
				beforeSend: function() {
					term.text( 'Loading...' );
				},
				success: function( html ) {
					$( '#impact-reports' ).html( html );
					term.text( term.data( 'name' ) );
				}
			})

		} else {

			var loaded = $( '#load-more-impact-reports a' ).data( 'loaded' );

			term.removeClass( 'active' );

			$.ajax({
				url: impacts.ajaxurl,
				type: 'post',
				data: {
					action: 'extension_impacts_request',
					reset: loaded,
				},
				success: function( html ) {
					$( '#impact-reports' ).html( html );
					if ( next_page <= total_pages ) {
						$( '#load-more-impact-reports' ).show();
					}
				}
			})

		}

	})

})(jQuery);