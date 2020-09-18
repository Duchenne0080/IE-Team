/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

( function( $ ) {

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
				$( '.site-title a, .site-description' ).css( {
					'color': to
				} );
			}
		} );
	} );

	// body typography
	wp.customize( 'body_font_family', function( value ) {
		value.bind( function( to ) {
			if ( to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ) {
				WebFont.load( { google: { families: [to] } } );
			}
			$( 'body, p' ).css( 'font-family', to );
		});
	});
	wp.customize( 'body_font_style', function( value ) {
		value.bind( function( to ) {
			var weight = to.replace(/\D/g,'');
			var style = to.replace(/\d+/g, '');
			$( 'body, p' ).css( 'font-weight', weight );
			$( 'body, p' ).css( 'font-style', style );
		});
	});
	wp.customize( 'body_text_transform', function( value ) {
		value.bind( function( to ) {
			$( 'body, p' ).css( 'text-transform', to );
		});
	});

	// H1 typography
    wp.customize( 'h1_font_family', function( value ) {
        value.bind( function( to ) {
            if ( to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ) {
                WebFont.load( { google: { families: [to] } } );
            }
            $( 'h1' ).css( 'font-family', to );
        });
    });
    wp.customize( 'h1_font_style', function( value ) {
        value.bind( function( to ) {
            var weight = to.replace(/\D/g,'');
            var style = to.replace(/\d+/g, '');
            $( 'h1' ).css( 'font-weight', weight );
            $( 'h1' ).css( 'font-style', style );
        });
    });
    wp.customize( 'h1_text_transform', function( value ) {
        value.bind( function( to ) {
            $( 'h1' ).css( 'text-transform', to );
        });
    });

    // H2 typography
    wp.customize( 'h2_font_family', function( value ) {
        value.bind( function( to ) {
            if ( to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ) {
                WebFont.load( { google: { families: [to] } } );
            }
            $( 'h2' ).css( 'font-family', to );
        });
    });
    wp.customize( 'h2_font_style', function( value ) {
        value.bind( function( to ) {
            var weight = to.replace(/\D/g,'');
            var style = to.replace(/\d+/g, '');
            $( 'h2' ).css( 'font-weight', weight );
            $( 'h2' ).css( 'font-style', style );
        });
    });
    wp.customize( 'h2_text_transform', function( value ) {
        value.bind( function( to ) {
            $( 'h2' ).css( 'text-transform', to );
        });
    });

    // H3 typography
    wp.customize( 'h3_font_family', function( value ) {
        value.bind( function( to ) {
            if ( to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ) {
                WebFont.load( { google: { families: [to] } } );
            }
            $( 'h3' ).css( 'font-family', to );
        });
    });
    wp.customize( 'h3_font_style', function( value ) {
        value.bind( function( to ) {
            var weight = to.replace(/\D/g,'');
            var style = to.replace(/\d+/g, '');
            $( 'h3' ).css( 'font-weight', weight );
            $( 'h3' ).css( 'font-style', style );
        });
    });
    wp.customize( 'h3_text_transform', function( value ) {
        value.bind( function( to ) {
            $( 'h3' ).css( 'text-transform', to );
        });
    });

    // H4 typography
    wp.customize( 'h4_font_family', function( value ) {
        value.bind( function( to ) {
            if ( to != 'Arial' && to != 'Verdana' && to != 'Trebuchet' && to != 'Georgia' && to != 'Tahoma' && to != 'Palatino' && to != 'Helvetica' ) {
                WebFont.load( { google: { families: [to] } } );
            }
            $( 'h4' ).css( 'font-family', to );
        });
    });
    wp.customize( 'h4_font_style', function( value ) {
        value.bind( function( to ) {
            var weight = to.replace(/\D/g,'');
            var style = to.replace(/\d+/g, '');
            $( 'h4' ).css( 'font-weight', weight );
            $( 'h4' ).css( 'font-style', style );
        });
    });
    wp.customize( 'h4_text_transform', function( value ) {
        value.bind( function( to ) {
            $( 'h4' ).css( 'text-transform', to );
        });
    });

	
} )( jQuery );
