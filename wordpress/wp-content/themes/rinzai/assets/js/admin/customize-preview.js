( function( $ ) {

    wp.customize( 'blogname', function( value ) {
        value.bind( function( to ) {
            $( '#site-header .uk-logo' ).text( to );
        } );
    } );

    wp.customize( 'blogdescription', function( value ) {
        value.bind( function( to ) {
            console.log( to );
            $( '.rinzai-panel .blogdescription' ).html( to );
        } );
    } );

    wp.customize( 'rinzai_blog_title', function( value ) {
        value.bind( function( to ) {
            $( '#rinzai-custom-header-content .title' ).text( to );
        } );
    } );

    wp.customize( 'rinzai_blog_subtitle', function( value ) {
        value.bind( function( to ) {
            $( '#rinzai-custom-header-content .subtitle' ).html( to );
        } );
    } );

} )( jQuery );
