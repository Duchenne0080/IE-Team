	$.fbuilder[ 'typeList' ] = [];
	$.fbuilder[ 'categoryList' ] = [];
	$.fbuilder[ 'controls' ] = {};
	$.fbuilder[ 'displayedDuplicateContainerMessage' ] = false;
	$.fbuilder[ 'duplicateContainerMessage' ] = 'Note: If the container field being duplicated includes calculated fields or fields with dependency rules, the equations and dependencies rules in the new fields are exactly the same equations and dependency rules than in the original fields.';

	$.fbuilder[ 'preview' ] = function( e )
	{
		var f  = $( e.form );
		f.attr( 'target', 'formpopup' ).attr(
			'onsubmit',
			function( f )
			{
				var w = screen.width*0.8,
					h = screen.height*0.7,
					l = screen.width/2 - w/2,
					t = screen.height/2 - h/2,
					new_window = window.open('', 'formpopup', 'resizeable,scrollbars,width='+w+',height='+h+',left='+l+',top='+t);

				$( f ).removeAttr( 'onsubmit' );
				new_window.focus();
			}
		);
		$( '<input type="hidden" name="preview" value="1" />' ).appendTo( f );

		f[ 0 ].submit();
		f.attr( 'target', '_self' ).find( 'input[name="preview"]').remove();
	};

	$.fbuilder[ 'htmlEncode' ] = function(value)
	{
		value = $('<div/>').text(value).html();
		value = value.replace(/&/g, '&amp;')
					 .replace(/"/g, "&quot;")
					 .replace(/&amp;lt;/g, '&lt;')
					 .replace(/&amp;gt;/g, '&gt;');
		value = value.replace(/&amp;/g, '&');
		return value;
	};

	$.fbuilder[ 'htmlDecode' ] = function(value)
	{
		if( /&(?:#x[a-f0-9]+|#[0-9]+|[a-z0-9]+);?/ig.test( value ) ) value = $( '<div/>' ).html( value ).text();
		return value;
	};

	$.fbuilder[ 'escapeSymbol' ] = function( value ) // Escape the symbols used in regulars expressions
	{
		return value.replace(/([\^\$\-\.\,\[\]\(\)\/\\\*\?\+\!\{\}])/g, "\\$1");
	};

	$.fbuilder[ 'parseVal' ] = function( value, thousandSeparator, decimalSymbol )
	{
		if( value == '' ) return 0;
		value += '';

		thousandSeparator = new RegExp( $.fbuilder.escapeSymbol( ( typeof thousandSeparator == 'undefined' ) ? ',' : thousandSeparator ), 'g' );
		decimalSymbol = new RegExp( $.fbuilder.escapeSymbol( ( typeof decimalSymbol == 'undefined' || /^\s*$/.test( decimalSymbol ) ) ? '.' : decimalSymbol ), 'g' );

		var t = value.replace( thousandSeparator, '' ).replace( decimalSymbol, '.' ).replace( /\s/g, '' ),
			p = /[+\-]?((\d+(\.\d+)?)|(\.\d+))(?:[eE][+\-]?\d+)?/.exec( t );

		return ( p ) ? p[0]*1 : '"' + value.replace(/'/g, "\\'").replace( /\$/g, '') + '"';
	};

    $.fbuilder[ 'showErrorMssg' ] = function( str ) // Display an error message
    {
        $( '.form-builder-error-messages' ).html( '<div class="error-text">' + str + '</div>' );
    };

	// fbuilder plugin
	$.fn.fbuilder = function(){
		var typeList = 	$.fbuilder.typeList,
			categoryList = $.fbuilder.categoryList;

		$.fbuilder[ 'getNameByIdFromType' ] = function( id )
			{
				for ( var i = 0, h = typeList.length; i < h; i++ )
				{
					if ( typeList[i].id == id )
					{
						return  typeList[i].name;
					}
				}
				return "";
			};

		for ( var i=0, h = typeList.length; i < h; i++ )
		{
			var category_id = typeList[ i ].control_category;

			if( typeof categoryList[ category_id ]  == 'undefined' )
			{
				categoryList[ category_id ] = { title : '', description : '', typeList : [] };
			}
			else if( typeof categoryList[ category_id ][ 'typeList' ]  == 'undefined' )
			{
				categoryList[ category_id ][ 'typeList' ] = [];
			}

			categoryList[ category_id ].typeList.push( i );
		}

		for ( var i in categoryList )
		{
			$("#tabs-1").append('<div style="clear:both;"></div><div>'+categoryList[ i ].title+'</div><hr />');
			if( typeof categoryList[ i ][ 'description' ] != 'undefined' && !/^\s*$/.test( categoryList[ i ][ 'description' ] ) )
			{
				$("#tabs-1").append('<div style="clear:both;"></div><div class="category-description">'+categoryList[ i ].description+'</div>');
			}

			if( typeof categoryList[ i ][ 'typeList' ]  != 'undefined' )
			{
				for( var j = 0, k = categoryList[ i ].typeList.length; j < k; j++ )
				{
					var index = categoryList[ i ].typeList[ j ];
					$("#tabs-1").append('<div class="button itemForm width40" id="'+typeList[ index ].id+'">'+typeList[ index ].name+'</div>');
				}
			}
		}

		$("#tabs-1").append('<div class="clearer"></div>');
		$( ".button").button();

		// Create a items object
		var items = [],
            fieldsIndex = {},
            selected = -3;

		$.fbuilder[ 'editItem' ] = function( id )
			{
				selected = id;
                try
                {
                    $('#tabs-2').html( items[id].showAllSettings() );
                } catch (e) {}
				items[id].editItemEvents();
				setTimeout(function(){try{$('#tabs-2 .choicesSet select:visible, #tabs-2 .cf_dependence_field:visible, #tabs-2 #sSelectedField, #tabs-2 #sFieldList').chosen();}catch(e){}}, 50);
			};

		$.fbuilder[ 'removeItem' ] = function( index )
			{
				if( typeof items[ index ][ 'remove' ] != 'undefined' ) items[ index ][ 'remove' ]();
				items[ index ] = 0;
				selected = -2;
				$('#tabs').tabs("option", "active", 0);
			};

		$.fbuilder[ 'duplicateItem' ] = function( index, parentItem )
			{
				var n = 0, i, h, item, nIndex, duplicate = items[index];
				for ( i in fieldsIndex ) if( /fieldname/.test( i ) ) n = Math.max( parseInt( i.replace( /fieldname/g,"" ) ), n );

				item = $.extend( true, {}, duplicate, { name:"fieldname"+(n+1) } );
				if( typeof item[ 'fields' ] != 'undefined' ) item[ 'fields' ] = [];
				if( typeof parentItem != 'undefined' ) item[ 'parent' ] = parentItem;
				else
				{
					/* Check if the parent is a container, and insert the new item as child of parent */
					if(
						duplicate[ 'parent' ] != '' &&
						typeof items[ fieldsIndex[ duplicate[ 'parent' ] ] ][ 'duplicateItem' ] != 'undefined'
					)
					items[ fieldsIndex[ duplicate[ 'parent' ] ] ][ 'duplicateItem' ]( duplicate.name, item['name'] );
				}

				// Insert the duplicated item just below the original
				nIndex = index*1+1;
				items.splice( nIndex, 0,  item);
				fieldsIndex[ item[ 'name' ] ] = nIndex;
				i = nIndex; h = items.length;
				for ( i; i<h; i++ ) // Correct the rest of indices
				{
					items[i].index = i;
					fieldsIndex[ items[i].name ] = i;
				}

				// The duplicated item is a container
				if( typeof item[ 'duplicateItem' ] != 'undefined' )
				{
					// Alert Message
					if( !$.fbuilder[ 'displayedDuplicateContainerMessage' ] )
					{
						alert( $.fbuilder[ 'duplicateContainerMessage' ] );
						$.fbuilder[ 'displayedDuplicateContainerMessage' ] = true;
					}

					i = 0; h = duplicate[ 'fields' ].length;
					for( i; i < h; i++ )
					{
						item[ 'fields' ][ i ] = $.fbuilder[ 'duplicateItem' ]( fieldsIndex[duplicate[ 'fields' ][ i ]], item[ 'name' ] );
					}
				}
				return item[ 'name' ];
			};

		$.fbuilder[ 'editForm' ] = function()
			{
				$('#tabs-3').html(theForm.showAllSettings());
				selected = -1;

				$("#fTitle").keyup(function()
				{
					theForm.title = $(this).val();
					$.fbuilder.reloadItems({'form':1});
				});

				$("#fEvalEquations").click(function()
				{
					theForm.evalequations = ($(this).is( ':checked' )) ? 1 : 0;
					$.fbuilder.reloadItems({'form':1});
				});

				$("[name='fEvalEquationsEvent']").change(function()
				{
					theForm.evalequationsevent = $("[name='fEvalEquationsEvent']:checked").val();
					$.fbuilder.reloadItems({'form':1});
				});

				$("#fAutocomplete").click(function()
				{
					theForm.autocomplete = ($(this).is( ':checked' )) ? 1 : 0;
					$.fbuilder.reloadItems({'form':1});
				});

				$("#fPersistence").click(function()
				{
					theForm.persistence = ($(this).is( ':checked' )) ? 1 : 0;
					$.fbuilder.reloadItems({'form':1});
				});

				$("#fDescription").keyup(function()
				{
					theForm.description = $(this).val();
					$.fbuilder.reloadItems({'form':1});
				});

				$("#fLayout").change(function()
				{
					theForm.formlayout = $(this).val();
					$.fbuilder.reloadItems();
				});

				$("#fTemplate").change(function()
				{
					theForm.formtemplate = $(this).val();
					var template 	= $.fbuilder.showSettings.formTemplateDic[ theForm.formtemplate ],
						thumbnail	= '',
						description = '';

					if( typeof template != 'undefined' )
					{
						if( typeof template[ 'thumbnail' ] != 'undefined' )
						{
							thumbnail = '<img src="' + template[ 'thumbnail' ] + '">';
						}
						if( typeof template[ 'description' ] != 'undefined' )
						{
							description = template[ 'description' ];
						}
					}
					$( '#fTemplateThumbnail' ).html( thumbnail );
					$( '#fTemplateDescription' ).html( description );
					$.fbuilder.reloadItems({'form':1});
				});

				$("#fCustomStyles").change(function()
				{
					theForm.customstyles = $(this).val();
					$.fbuilder.reloadItems({'form':1});
				});

				// CSS Editor
				if( 'codeEditor' in wp)
				{
					var cssEditorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {},
						editor;
					cssEditorSettings.codemirror = _.extend(
						{},
						cssEditorSettings.codemirror,
						{
							indentUnit: 2,
							tabSize: 2,
							mode: 'css'
						}
					);
					editor = wp.codeEditor.initialize( $('#fCustomStyles'), cssEditorSettings );
					editor.codemirror.on('change', function(cm){ $('#fCustomStyles').val(cm.getValue()).change();});

					$('.cff-editor-extend-shrink').on('click', function(){$(this).closest('.cff-editor-container').toggleClass('fullscreen');});
				}
			};

		$.fbuilder[ 'defineGeneralEvents' ] = function()
			{
				// Fields events
				$(document).on(
					{
						'click' : function(evt){
							$.fbuilder[ 'editItem' ]($(this).attr("id").replace("field-",""));
							$( '#fieldlist .ui-selected' ).removeClass("ui-selected");
							$(this).addClass("ui-selected");
							$('#tabs').tabs("option", "active", 1);
							evt.stopPropagation();
						},
						'mouseover' : function(evt){
							$(this).addClass("ui-over");
							evt.stopPropagation();
						},
						'mouseout' : function(evt){
							$(this).removeClass("ui-over");
							evt.stopPropagation();
						}
					},
					'.fields'
				);

				$(document).on('focus', '.field', function(){$(this).blur();});

				// Handle events
				$(document).on('click', '.fields .remove', function(evt){
					evt.stopPropagation();
					$.fbuilder[ 'removeItem' ]($(this).parent().attr("id").replace("field-",""));
					items = $.grep( items, function( e ){ return (e != 0 ); } );
					$.fbuilder.reloadItems();
				});

				$(document).on('click', '.fields .copy', function(evt){
					evt.stopPropagation();
					$.fbuilder[ 'duplicateItem' ]($(this).parent().attr("id").replace("field-",""));
					$('#tabs').tabs("option", "active", 0);
					$.fbuilder.reloadItems();
				});

				$(document).on('click', '.fields .collapse', function(evt){
					evt.stopPropagation();
					var f = $(this).closest('.fields'),
						i = f.attr("id").replace("field-",""),
						item = ffunct.getItems()[i];

					item['collapsed'] = true;
					f.addClass('collapsed');
					$.fbuilder.reloadItems({'field': item});
				});

				$(document).on('click', '.fields .uncollapse', function(evt){
					evt.stopPropagation();
					var f = $(this).closest('.fields'),
						i = f.attr("id").replace("field-",""),
						item = ffunct.getItems()[i];

					item['collapsed'] = false;
					f.removeClass('collapsed');
					$.fbuilder.reloadItems({'field': item});
				});

				// Title and subtitle section events
				$(document).on(
					{
						'mouseover' : function(){
							$(this).addClass("ui-over");
						},
						'mouseout' : function(){
							$(this).removeClass("ui-over");
						},
						'click' : function(evt){
							evt.stopPropagation();
							$('#tabs').tabs("option", "active", 2);
							$.fbuilder.editForm();
							$(this).siblings().removeClass("ui-selected");
							$(this).addClass("ui-selected");
						}
					},
					'.fform'
				);

				// Dashboard event
				$(document).on('click', '.expand-shrink', function(){
					$(this).toggleClass( 'ui-icon-triangle-1-e ui-icon-triangle-1-w' );
					$('.form-builder .ctrlsColumn').toggleClass( 'expanded' );
				});

				$(document).on('click', '#fbuilder', function(evt)
					{
						evt.stopPropagation();
						selected = -2;
						$(".fform").removeClass("ui-selected")
						$( '#fieldlist .ui-selected' ).removeClass("ui-selected");
						$('#tabs').tabs("option", "active", 0);
					}
				);
			};

		$.fbuilder[ 'reloadItems' ] = function( args )
			{
				function replaceFieldTags( field )
				{
					if( typeof field[ 'display' ] != 'undefined' )
					{
						var e  = $( '.'+field[ 'name' ] ),
							n  = $( field.display() ),
							as = true; // Call after_show

						if( n.find( '.dfield:eq(0)>.fcontainer>.fieldscontainer').length )
						{
							n.find( '.dfield:eq(0)>.fcontainer>.fieldscontainer')
							 .replaceWith( e.find( '.dfield:eq(0)>.fcontainer>.fieldscontainer' ) );
							as = false;
						}
						e.replaceWith(n);
						if( as && typeof field[ 'after_show' ] != 'undefined') field.after_show();
						$("#field-"+field.index).addClass("ui-selected");
					}
				} // End replaceFieldTags

				function replaceTitleDescTags()
				{
					$("#formheader").html(theForm.display());
				} // End replaceTitleDescTags

				var default_args = {
						'field' : {},
						'form'  : false
					};

				args = $.extend(true, {}, default_args, ( typeof args != 'undefined' ) ? args : {} );

				if( !$.isEmptyObject( args[ 'field' ] ) )
				{
					replaceFieldTags( args[ 'field' ] );
				}
				else if( args['form'] )
				{
					replaceTitleDescTags();
				}
				else
				{
					var	email_str = '', // email fields list
						cu_user_email_field = ($('#cu_user_email_field').attr("def") || '').split( ',' ),

						cost_str = '', // fields list for paypal request
						request_cost = $('#request_cost').attr("def"),

						recurrent_str = '', // fields list for recurrent payments
						paypal_recurrent_field = $('[name="paypal_recurrent_field"]').attr("def"),

						paypal_price_field = $('#paypal_price_field').attr("def"), // fields for times intervals in recurrent payments
						interval_fields_str = '<option value="" '+( ('' == paypal_price_field ) ? "selected" : "" )+'> ---- No ---- </option>';

					// Set the correct fields alignment class
					for ( var i=0, h = $.fbuilder.showSettings.formlayoutList.length; i < h; i++ )
					{
						$("#fieldlist").removeClass( $.fbuilder.showSettings.formlayoutList[i].id );
					}
					$("#fieldlist").addClass(theForm.formlayout);

					replaceTitleDescTags();
					$("#fieldlist").html("");
					fieldsIndex = {};
					for ( var i=0, h = items.length; i < h; i++ )
					{
						var item = items[i];

						item.index = i;
						item.parent = '';
						fieldsIndex[ item.name ] = i;

						$("#fieldlist").append(item.display());
						if ( i == selected )
						{
							$("#field-"+i).addClass("ui-selected");
							if( $('#tabs').tabs("option", "active") != 1 )
							{
								$.fbuilder[ 'editItem' ]( i );
							}
						}
						else
						{
							$("#field-"+i).removeClass("ui-selected");
						}

						// Email fields
						if (item.ftype=="femail" || item.ftype=="femailds")
						{
							email_str += '<option value="'+item.name+'" '+( ( $.inArray( item.name, cu_user_email_field ) != -1 ) ? "selected" : "" )+'>'+item.name+' ('+item.title+')'+'</option>';
						}
						else
						{
							// Request cost fields
							if(!/(femail)|(fdate)|(ffile)|(fpassword)|(fphone)|(fsectionbreak)|(fpagebreak)|(fsummary)|(fcontainer)|(ffieldset)|(fdiv)|(fmedia)|(fbutton)|(fhtml)/i.test(item.ftype))
							{
								cost_str += '<option value="'+item.name+'" '+( ( item.name == request_cost ) ? "selected" : "" )+'>'+item.name+'('+(item.title)+')</option>'
							}

							// Recurrent Payments
							if (item.ftype=="fradio" || item.ftype=="fdropdown")
							{
								recurrent_str += '<option value="'+item.name+'" '+( ( item.name == paypal_recurrent_field ) ? "selected" : "" )+'>'+item.name+' ('+item.title+')'+'</option>';
							}

							// Times Intervals
							interval_fields_str += '<option value="'+item.name+'" '+( ( item.name == paypal_price_field ) ? "selected" : "" )+'>'+(item.title)+'</option>';
						}
					}

					// Assign the email fields to the "cu_user_email_field" list
					$('#cu_user_email_field').html(email_str);

					// Assign the fields to the "request_cost" list
					$('#request_cost').html(cost_str);

					// Assign the fields to the "paypal_recurrent_field" list
					$('[name="paypal_recurrent_field"]').html(recurrent_str);

					// Assign the fields to the "paypal_price_field" list
					$('#paypal_price_field').html(interval_fields_str);

					for ( var i=0, h = items.length; i < h; i++ )
					{
						if( typeof items[ i ].after_show != 'undefined' ) items[ i ].after_show();
					}
				}

				ffunct.saveData("form_structure");
			};

		var fform=function(){};
		$.extend(fform.prototype,
			{
				title:"Untitled Form",
				description:"This is my form. Please fill it out. It's awesome!",
				formlayout:"top_aligned",
				formtemplate:"",
                evalequations:1,
                evalequationsevent:2,
                autocomplete:1,
				persistence:0,
				customstyles:"",
				display:function()
				{
					return '<div class="fform" id="field"><div class="arrow ui-icon ui-icon-play "></div><h2>'+this.title+'</h2><span>'+this.description+'</span></div>';
				},

				showAllSettings:function()
				{
					var layout 	    = '',
						template    = '<option value="">Use default template</option>',
						thumbnail   = '',
						description = '',
						selected    = '',
						str 		= '';

					for ( var i = 0; i< $.fbuilder.showSettings.formlayoutList.length; i++ )
					{
						layout += '<option value="'+$.fbuilder.showSettings.formlayoutList[i].id+'" '+(($.fbuilder.showSettings.formlayoutList[i].id==this.formlayout)?"selected":"")+'>'+$.fbuilder.showSettings.formlayoutList[i].name+'</option>';
					}

					for ( var i in $.fbuilder.showSettings.formTemplateDic )
					{
						if( /^\s*$/.test( i ) ) break;
						selected = '';
						if( $.fbuilder.showSettings.formTemplateDic[i].prefix==this.formtemplate )
						{
							selected = 'SELECTED';
							if( typeof $.fbuilder.showSettings.formTemplateDic[i].thumbnail != 'undefined' )
							{
								thumbnail = '<img src="'+$.fbuilder.showSettings.formTemplateDic[i].thumbnail+'">';
							}

							if( typeof $.fbuilder.showSettings.formTemplateDic[i].description != 'undefined' )
							{
								description = $.fbuilder.showSettings.formTemplateDic[i].description;
							}
						}

						template += '<option value="'+$.fbuilder.showSettings.formTemplateDic[i].prefix+'" ' + selected + '>'+$.fbuilder.showSettings.formTemplateDic[i].title+'</option>';
					}

					str += '<div><label>Form Name</label><input class="large" name="fTitle" id="fTitle" value="'+$.fbuilder.htmlEncode(this.title)+'" /></div><div><label>Description</label><textarea class="large" name="fDescription" id="fDescription">'+this.description+'</textarea></div><div><label>Label Placement</label><br /><select name="fLayout" id="fLayout" class="large">'+layout+'</select></div><div><label><input type="checkbox" name="fAutocomplete" id="fAutocomplete" '+( ( this.autocomplete ) ? 'CHECKED' : '' )+' /> Enable autocompletion</label></div><div><label><input type="checkbox" name="fPersistence" id="fPersistence" '+( ( this.persistence ) ? 'CHECKED' : '' )+' /> Enable the browser\'s persistence (the data are stored locally on browser)</label></div>';

					if(typeof $.fbuilder.controls[ 'fCalculated' ] != 'undefined')
					{
						str += '<div><label><input type="checkbox" name="fEvalEquations" id="fEvalEquations" '+( ( this.evalequations ) ? 'CHECKED' : '' )+' /> Eval dynamically the equations associated to the calculated fields</label></div>';

						str += '<div class="groupBox"><label><input type="radio" name="fEvalEquationsEvent" name="fEvalEquationsEvent" value="1" '+( ( this.evalequationsevent == 1 ) ? 'CHECKED' : '' )+' /> Eval the equations in the onchange events</label><br /><label><input type="radio" name="fEvalEquationsEvent" name="fEvalEquationsEvent" value="2" '+( ( 'undefined' == typeof this.evalequationsevent || this.evalequationsevent == 2 ) ? 'CHECKED' : '' )+' /> Eval the equations in the onchange and keyup events</label></div>';
					}

					str += '<div><label>Form Template</label><br /><select name="fTemplate" id="fTemplate" class="large">'+template+'</select></div><br /><div style="text-align:center"><span id="fTemplateThumbnail">'+thumbnail+'</span><div></div><span  id="fTemplateDescription">'+description+'</span></div><div class="cff-editor-container"><label style="display:block;"><div class="cff-editor-extend-shrink"></div>Customize Form Design <i>(Enter the CSS rules. <a href="http://cff.dwbooster.com/faq#q82" target="_blank">More information</a>)</i></label><br /><textarea id="fCustomStyles" style="width:100%;height:150px;">'+this.customstyles+'</textarea></div>' ;

					return str;
				}
			}
		);

		var theForm = new fform();
		$("#fieldlist").sortable(
			{
				'connectWith': '.ui-sortable',
				'items': '.fields',
				'placeholder': 'ui-state-highlight',
				'tolerance': 'pointer',
				'update': function( event, ui )
				{
					var i, h = items.length;
					for( i = 0; i < h; i++ )
					{
						if( ui.item.hasClass( items[ i ].name ) ) break;
					}

					if( ui.item.parent().attr( 'id' ) == 'fieldlist' )
					{
						// receive or change order in fieldlist
						var prev  = ui.item.prev(),
							index = parseInt( ui.item.index() );

						if( prev.length )
						{
							for( var j = 0; j < h; j++ )
							{
								if( prev.hasClass(items[j].name) )
								{
									index = (i<=j) ? j : ++j;
									break;
								}
							}
						}

						items.splice( index, 0,  items.splice( i, 1 )[ 0 ] );
						$.fbuilder.reloadItems();
						$( '.'+/((fieldname)|(separator))\d+/.exec( ui.item.attr( 'class' ) )[ 0 ] ).click();
					}
					else
					{
						// remove
						items = items.concat( items.splice( i, 1 ) );
					}
				}
			}
		);

		$('#tabs').tabs(
			{
				activate: function(event, ui)
					{
						switch( $(this).tabs( "option", "active" ) )
						{
							case 0:
								$(".fform").removeClass("ui-selected");
							break;
							case 1:
								$(".fform").removeClass("ui-selected");
								if (selected < 0)
								{
								   $('#tabs-2').html('<b>No Field Selected</b><br />Please click on a field in the form preview on the right to change its properties.');
								}
							break;
							case 2:
								$(".fields").removeClass("ui-selected");
								$(".fform").addClass("ui-selected");
								$.fbuilder.editForm();
							break;
						}
					}
			}
		);

	    var ffunct = {
	        getFieldsIndex: function()
			{
			   return fieldsIndex;
		    },
		    getItems: function()
			{
			   return items;
		    },
		    addItem: function(id)
			{
			    var obj = new $.fbuilder.controls[id](),
					fBuild = this,
					n = 0;

				obj.init();
				for ( var i in fieldsIndex ) if( /fieldname/.test( i ) ) n = Math.max( parseInt( i.replace( /fieldname/g,"" ) ), n );
			    n++;

				obj.fBuild = fBuild;
			    $.extend(obj,{name:"fieldname"+n});

                if( selected >= 0 )
                {
					n =  (selected)*1+1;
                    items.splice( n, 0, obj );
					fieldsIndex[obj.name] = n;
					for(var i = n, h = items.length; i<h; i++) fieldsIndex[items[i].name] = i;

					if( id != 'fPageBreak' )
					{
						if( typeof items[ selected ][ 'addItem' ] != 'undefined' )
						{
							obj.name[ 'parent' ] = items[ selected ][ 'name' ];
							items[ selected ][ 'addItem' ]( obj.name );
						}
						else
						{
							// get the parent
							if( items[ selected ][ 'parent' ] !== '' )
							{
								items[ fieldsIndex[ items[ selected ][ 'parent' ] ] ][ 'addItem' ]( obj.name, items[ selected ][ 'name' ]);
							}

							selected++;
						}
					}
					else
					{
						selected++;
					}
                }
                else
                {
                    selected = items.length;
                    items[selected] = obj;
                }
				$.fbuilder.reloadItems();
				return obj;
		    },
		    saveData:function(f)
			{
				try{
					var itemsStringified   = $.stringifyXX( items ),
						theFormStringified = $.stringifyXX( theForm ),
						errorTxt = 'The entered data includes invalid characters. Please, if you are copying and pasting from another platform, be sure the data not include invalid characters.',
						str;

					if( typeof global_varible_save_data != 'undefined' )
					{
						// If the global_varible_save_data exists clear the form-builder-error-messages
						$( '.form-builder-error-messages' ).html( '' );
					}

					try{
						if( $.parseJSON( itemsStringified ) != null && $.parseJSON( theFormStringified ) != null )
						{
							str = "["+ itemsStringified +",["+ theFormStringified +"]]";
							$( "#"+f ).val( str );
						}
						else
						{
							$.fbuilder[ 'showErrorMssg' ]( errorTxt );
						}
					}
					catch( err )
					{
						$.fbuilder[ 'showErrorMssg' ]( errorTxt );
					}

					global_varible_save_data = true;
				}catch( err ){}
		    },
		    loadData:function(form_structure, available_templates)
			{
				var structure,
					templates = null,
					fBuild = this;

				try{
					structure =  $.parseJSON( $("#"+form_structure).val() );
				}
				catch(err)
				{
					structure = [];
					if(typeof console != 'undefined') console.log(err);
				}

			    try{
					 if( typeof available_templates != 'undefined' ) templates = $.parseJSON( $("#"+available_templates).val() );
				}
				catch(err)
				{
					templates = null;
					if(typeof console != 'undefined') console.log(err);
				}

			    if ( structure )
				{
					$.fbuilder.defineGeneralEvents();
					if (structure.length==2)
					{
						items = [];
						for (var i=0;i<structure[0].length;i++)
						{
						   var obj = new $.fbuilder.controls[structure[0][i].ftype]();
						   obj = $.extend( true, {}, obj, structure[0][i] );
						   obj.fBuild = fBuild;
						   items[items.length] = obj;
						}
						theForm = new fform();
						theForm = $.extend(theForm,structure[1][0]);
						$.fbuilder.reloadItems();
					}
				}

				if( templates )
				{
					$.fbuilder.showSettings.formTemplateDic = templates;
				}
		    },
		    removeItem: $.fbuilder[ 'removeItem' ],
		    editItem:   $.fbuilder[ 'editItem' ]
	    }

	    this.fBuild = ffunct;
	    return this;
	};

    $.fbuilder[ 'showSettings' ] = {
		sizeList:new Array({id:"small",name:"Small"},{id:"medium",name:"Medium"},{id:"large",name:"Large"}),
		layoutList:new Array({id:"one_column",name:"One Column"},{id:"two_column",name:"Two Column"},{id:"three_column",name:"Three Column"},{id:"side_by_side",name:"Side by Side"}),
		formlayoutList:new Array({id:"top_aligned",name:"Top Aligned"},{id:"left_aligned",name:"Left Aligned"},{id:"right_aligned",name:"Right Aligned"}),
		formTemplateDic: {}, // Form Template dictionary
        showFieldType: function( v )
        {
            return '<label>Field Type: '+$.fbuilder[ 'getNameByIdFromType' ]( v )+'</label><br /><br />';
        },
		showTitle: function(v)
		{
			return '<label>Field Label</label><textarea class="large" name="sTitle" id="sTitle">'+v+'</textarea>';
		},
		showShortLabel: function( v )
		{
			return '<div><label>Short label (optional) [<a class="helpfbuilder" text="The short label is used at title for the column when exporting the form data to CSV files.\n\nIf the short label is empty then, the field label will be used for the CSV file.">help?</a>] :</label><input type="text" class="large" name="sShortlabel" id="sShortlabel" value="'+v+'" /></div>';
		},
		showName: function( v )
		{
			return '<div><label>Field name, tag for the message:</label><input readonly="readonly" class="large" name="sNametag" id="sNametag" value="&lt;%'+v+'%&gt;" />'+
				   '<input style="display:none" readonly="readonly" class="large" name="sName" id="sName" value="'+v+'" /></div>';
		},
		showPredefined: function(v,c)
		{
			return '<div><label>Predefined Value</label><textarea class="large" name="sPredefined" id="sPredefined">'+v+'</textarea><br /><i>It is possible to use another field in the form as predefined value. Ex: fieldname1</i><br /><input type="checkbox" name="sPredefinedClick" id="sPredefinedClick" '+((c)?"checked":"")+' value="1" > Use predefined value as placeholder.</div>';
		},
		showEqualTo: function(v,name)
		{
			return '<div><label>Equal to [<a class="helpfbuilder" text="Use this field to create password confirmation field or email confirmation fields.\n\nSpecify this setting ONLY into the confirmation field, not in the original field.">help?</a>]</label><br /><select class="equalTo" name="sEqualTo" id="sEqualTo" dvalue="'+v+'" dname="'+name+'"></select></div>';
		},
		showRequired: function(v)
		{
			return '<div><input type="checkbox" name="sRequired" id="sRequired" '+((v)?"checked":"")+'><label>Required</label></div>';
		},
		showExclude: function(v)
		{
			return '<div><input type="checkbox" name="sExclude" id="sExclude" '+((v)?"checked":"")+'><label>Exclude from submission</label></div>';
		},
		showReadonly: function(v)
		{
			return '<div><input type="checkbox" name="sReadonly" id="sReadonly" '+((v)?"checked":"")+'><label>Read Only</label></div>';
		},
		showSize: function(v)
		{
			var str = "";
			for (var i=0;i<this.sizeList.length;i++)
			{
				str += '<option value="'+this.sizeList[i].id+'" '+((this.sizeList[i].id==v)?"selected":"")+'>'+this.sizeList[i].name+'</option>';
			}
			return '<label>Field Size</label><br /><select name="sSize" id="sSize">'+str+'</select>';
		},
		showLayout: function(v)
		{
			var str = "";
			for (var i=0;i<this.layoutList.length;i++)
			{
				str += '<option value="'+this.layoutList[i].id+'" '+((this.layoutList[i].id==v)?"selected":"")+'>'+this.layoutList[i].name+'</option>';
			}
			return '<label>Field Layout</label><br /><select name="sLayout" id="sLayout">'+str+'</select>';
		},
		showUserhelp: function(v,c,i)
		{
			return '<div><label>Instructions for User</label><textarea class="large" name="sUserhelp" id="sUserhelp">'+v+'</textarea><br /><input type="checkbox" name="sUserhelpTooltip" id="sUserhelpTooltip" '+((c)?"checked":"")+' value="1" > Show as floating tooltip - <input type="checkbox" name="sTooltipIcon" id="sTooltipIcon" '+((i)?"checked":"")+' value="1" > Display on icon</div>';
		},
		showCsslayout: function(v)
		{
			return '<div><label>Add Css Layout Keywords</label><input type="text" class="large" name="sCsslayout" id="sCsslayout" value="'+v+'" /></div>';
		}
	};

	$.fbuilder.controls[ 'ffields' ] = function(){};
	$.extend( $.fbuilder.controls[ 'ffields' ].prototype,
		{
			form_identifier:"",
			name:"",
			shortlabel:"",
			index:-1,
			ftype:"",
			userhelp:"",
			userhelpTooltip:false,
			tooltipIcon:false,
			csslayout:"",
			init:function(){},
			editItemEvents:function( e )
			{
				if( typeof e != 'undefined' && typeof e.length != 'undefined' )
				{
					for( var i = 0, h = e.length; i<h; i++ )
					{
						/**
						* s -> selector
						* e -> event name
						* l -> element
						* f -> function to apply the value
						*/
						$(e[i].s).bind(e[i].e, {obj:this, i:e[i]}, function(e){
							var v = $(this).val();
							if(typeof e.data.i['f'] != 'undefined') v = e.data.i.f($(this));
							e.data.obj[e.data.i.l] = v;
							$.fbuilder.reloadItems( {'field': e.data.obj} );
						});
					}
				}

				$("#sTitle").bind("keyup", {obj: this}, function(e)
					{
						var str = $(this).val();
						e.data.obj.title = str.replace(/\n/g,"<br />");
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sShortlabel").bind("keyup", {obj: this}, function(e)
					{
						e.data.obj.shortlabel = $(this).val();
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sReadonly").bind("click", {obj: this}, function(e)
					{
						e.data.obj.readonly = $(this).is(':checked');
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sPredefined").bind("keyup", {obj: this}, function(e)
					{
						e.data.obj.predefined = $(this).val();
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sPredefinedClick").bind("click", {obj: this}, function(e)
					{
						e.data.obj.predefinedClick = $(this).is(':checked');
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sRequired").bind("click", {obj: this}, function(e)
					{
						e.data.obj.required = $(this).is(':checked');
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sExclude").bind("click", {obj: this}, function(e)
					{
						e.data.obj.exclude = $(this).is(':checked');
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sUserhelp").bind("keyup", {obj: this}, function(e)
					{
						e.data.obj.userhelp = $(this).val();
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sUserhelpTooltip").bind("click", {obj: this}, function(e)
					{
						e.data.obj.userhelpTooltip = $(this).is(':checked');
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sTooltipIcon").bind("click", {obj: this}, function(e)
					{
						e.data.obj.tooltipIcon = $(this).is(':checked');
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$("#sCsslayout").bind("keyup", {obj: this}, function(e)
					{
						e.data.obj.csslayout = $(this).val().replace(/\,/g, ' ').replace(/\s+/g, ' ');
						$.fbuilder.reloadItems( {'field': e.data.obj} );
					});

				$(".helpfbuilder").click(function()
					{
						alert($(this).attr("text"));
					});
			},

			showSpecialData:function()
			{
				if(typeof this.showSpecialDataInstance != 'undefined')
				{
					return this.showSpecialDataInstance();
				}
				else
				{
					return "";
				}
			},

			showEqualTo:function()
			{
				if(typeof this.equalTo != 'undefined')
				{
					return $.fbuilder.showSettings.showEqualTo(this.equalTo,this.name);
				}
				else
				{
					return "";
				}
			},

			showPredefined:function()
			{
				if(typeof this.predefined != 'undefined')
				{
					return $.fbuilder.showSettings.showPredefined(this.predefined,this.predefinedClick);
				}
				else
				{
					return "";
				}
			},
			/** Modified for showing required and readonly attributes **/
			showRequired:function()
			{
				var result = '';
				if(typeof this.required != 'undefined') result += $.fbuilder.showSettings.showRequired(this.required);
				if(typeof this.exclude != 'undefined')  result += $.fbuilder.showSettings.showExclude(this.exclude);
				if(typeof this.readonly != 'undefined') result += $.fbuilder.showSettings.showReadonly(this.readonly);
				return result;
			},

			showSize:function()
			{
				if(typeof this.size != 'undefined')
				{
					return $.fbuilder.showSettings.showSize(this.size);
				}
				else
				{
					return "";
				}
			},

			showLayout:function()
			{
				if(typeof this.layout != 'undefined')
				{
					return $.fbuilder.showSettings.showLayout(this.layout);
				}
				else
				{
					return "";
				}
			},

			showRange:function()
			{
				if(typeof this.min != 'undefined')
				{
					return this.showRangeIntance();
				}
				else
				{
					return "";
				}
			},

			showFormat:function()
			{
				if(typeof this.dformat != 'undefined')
				{
					try
					{
						return this.showFormatIntance();
					} catch(e) {return "";}
				}
				else
				{
					return "";
				}
			},

			showChoice:function()
			{
				if(typeof this.choices != 'undefined')
				{
					return this.showChoiceIntance();
				}
				else
				{
					return "";
				}
			},

			showUserhelp:function()
			{
				return $.fbuilder.showSettings.showUserhelp(this.userhelp,this.userhelpTooltip,this.tooltipIcon);
			},

			showCsslayout:function()
			{
				return $.fbuilder.showSettings.showCsslayout(this.csslayout);
			},

			showAllSettings:function()
			{
				return this.showFieldType()+this.showTitle()+this.showShortLabel()+this.showName()+this.showSize()+this.showLayout()+this.showFormat()+this.showRange()+this.showRequired()+this.showSpecialData()+this.showEqualTo()+this.showPredefined()+this.showChoice()+this.showUserhelp()+this.showCsslayout();
			},

			showFieldType:function()
			{
				return $.fbuilder.showSettings.showFieldType(this.ftype);
			},

			showTitle:function()
			{
				return $.fbuilder.showSettings.showTitle(this.title);
			},

			showName:function()
			{
				return $.fbuilder.showSettings.showName(this.name);
			},

			showShortLabel:function()
			{
				return $.fbuilder.showSettings.showShortLabel(this.shortlabel);
			},

			display:function()
			{
				return 'Not available yet';
			},

			show:function()
			{
				return 'Not available yet';
			}
		}
	);