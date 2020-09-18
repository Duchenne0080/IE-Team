	$.fbuilder.controls[ 'fcontainer' ] = function(){};
	$.fbuilder.controls[ 'fcontainer' ].prototype = {
		fields:[],
		columns:1,
		rearrange: 0,
		after_show: function()
			{
				var e  = $( '#'+this.name ), f;
                for( var i = 0, h = this.fields.length; i < h; i++ )
				{
					f = $( '[id*="'+this.fields[ i ]+this.form_identifier+'"]' ).closest( '.fields' ).detach();
					if( this.columns > 1 )
					{
						f.addClass( 'column'+this.columns );
						if( i%this.columns == 0 && !this.rearrange) f.css( 'clear', 'left' );
					}
					f.appendTo( e );
				}
			},
		showHideDep:function( toShow, toHide, hiddenByContainer )
			{
				var me = this,
					isHidden = ( typeof toHide[ me.name ] != 'undefined' || typeof hiddenByContainer[ me.name ] != 'undefined' ),
					fId,
					result = [];

				for( var i = 0, h = me.fields.length; i < h; i++ )
				{
					if(!/fieldname/i.test(me.fields[ i ])) continue;
					fId = me.fields[ i ]+me.form_identifier;
					if( isHidden )
					{
						if( typeof hiddenByContainer[ fId ] == 'undefined' ) hiddenByContainer[ fId ] = {};
						if( typeof hiddenByContainer[ fId ][ me.name ] == 'undefined' )
						{
							hiddenByContainer[ fId ][ me.name ] = {};

							if( typeof toHide[ fId ] == 'undefined' )
							{
								$( '[id*="'+fId+'"],.'+fId ).closest( '.fields' ).hide();
								$( '[id*="'+fId+'"]:not(.ignore)' ).addClass( 'ignore' );
								result.push( fId );
							}
						}
					}
					else
					{
						if( typeof hiddenByContainer[ fId ] != 'undefined' )
						{
							delete hiddenByContainer[ fId ][ me.name ];
							if( $.isEmptyObject( hiddenByContainer[ fId ] ) )
							{
								delete hiddenByContainer[ fId ];
								if( typeof toHide[ fId ] == 'undefined' )
								{
									$( '[id*="'+fId+'"],.'+fId ).closest( '.fields' ).show();
									$( '[id*="'+fId+'"].ignore' ).removeClass( 'ignore' );
									result.push( fId );
								}
							}
						}
					}
				}
				return result;
			}
	};