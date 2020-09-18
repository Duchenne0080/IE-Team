	$.fbuilder.controls[ 'fcheck' ]=function(){};
	$.extend(
		$.fbuilder.controls[ 'fcheck' ].prototype,
		$.fbuilder.controls[ 'ffields' ].prototype,
		{
			title:"Check All That Apply",
			ftype:"fcheck",
			layout:"one_column",
			required:false,
			merge:1,
			max:-1,
			maxError:"Check no more than {0} boxes",
			toSubmit:"text",
			showDep:false,
			show:function()
				{
					this.choicesVal = ((typeof(this.choicesVal) != "undefined" && this.choicesVal !== null)?this.choicesVal:this.choices);
					var str = "",
						classDep;

					if ( typeof this.choicesDep == "undefined" || this.choicesDep == null )
						this.choicesDep = new Array();

					for (var i=0, h=this.choices.length; i<h; i++)
					{
						if( typeof this.choicesDep[i] != 'undefined' )
							this.choicesDep[i] = $.grep(this.choicesDep[i],function(n){ return n != ""; });
						else
							this.choicesDep[i] = [];

						classDep = (this.choicesDep[ i ].length) ? 'depItem': '';

						str += '<div class="'+this.layout+'"><label for="'+this.name+'_cb'+i+'"><input name="'+this.name+'[]" id="'+this.name+'_cb'+i+'" class="field '+classDep+' group '+((this.required)?" required":"")+'" value="'+$.fbuilder.htmlEncode(this.choicesVal[i])+'" vt="'+$.fbuilder.htmlEncode((this.toSubmit == 'text') ? this.choices[i] : this.choicesVal[i])+'" type="checkbox" '+((this.choiceSelected[i])?"checked":"")+'/> <span>'+$.fbuilder.htmlDecode( this.choices[i] )+'</span></label></div>';
					}
					return '<div class="fields '+this.csslayout+' '+this.name+' cff-checkbox-field" id="field'+this.form_identifier+'-'+this.index+'"><label>'+this.title+''+((this.required)?"<span class='r'>*</span>":"")+'</label><div class="dfield">'+str+'<div class="clearer"></div><span class="uh">'+this.userhelp+'</span></div><div class="clearer"></div></div>';
				},
			after_show:function()
				{
					var m = this;
					$(document).on('click','[id*="'+m.name+'"]', function(){
						if(0 < m.max)
						{
							var d = true;
							if($('[id*="'+m.name+'"]:checked').length < m.max) d = false;
							$('[id*="'+m.name+'"]:not(:checked)').prop('disabled', d);
						}
					});

					if(0 < m.max)
						$('[id*="'+m.name+'"]').rules('add',{maxlength:m.max, messages:{maxlength:m.maxError}});
				},
			showHideDep:function( toShow, toHide, hiddenByContainer )
				{
					var me		= this,
						item 	= $( 'input[id*="'+me.name+'"]' ),
						form_identifier = me.form_identifier,
						isHidden = (typeof toHide[ me.name ] != 'undefined' || typeof hiddenByContainer[ me.name ] != 'undefined' ),
						result 	= [];

					try
					{
						item.each(function(i,e){
							if( typeof me.choicesDep[i] != 'undefined' && me.choicesDep[ i ].length )
							{
								var checked = e.checked;
								for( var j = 0, k = me.choicesDep[ i ].length; j < k; j++)
								{
									if(!/fieldname/i.test(me.choicesDep[i][j])) continue;
									var dep = me.choicesDep[i][j]+form_identifier;
									if( isHidden || !checked)
									{
										if( typeof toShow[ dep ] != 'undefined' )
										{
											delete toShow[ dep ][ 'ref' ][ me.name+'_'+i ];
											if( $.isEmptyObject(toShow[ dep ][ 'ref' ]) )
											delete toShow[ dep ];
										}

										if( typeof toShow[ dep ] == 'undefined' )
										{
											$( '[id*="'+dep+'"],.'+dep ).closest( '.fields' ).hide();
											$( '[id*="'+dep+'"]:not(.ignore)' ).addClass( 'ignore' );
											toHide[ dep ] = {};
										}
									}
									else
									{
										delete toHide[ dep ];
										if( typeof toShow[ dep ] == 'undefined' )
										toShow[ dep ] = { 'ref': {}};
										toShow[ dep ][ 'ref' ][ me.name+'_'+i ]  = 1;
										if(!(dep in hiddenByContainer))
										{
											$( '[id*="'+dep+'"],.'+dep ).closest( '.fields' ).show();
											$( '[id*="'+dep+'"].ignore' ).removeClass( 'ignore' );
										}
									}
									if($.inArray(dep,result) == -1) result.push( dep );
								}
							}
						});
					}
					catch( e ){  }
					return result;
				},
			val:function(raw)
				{
					raw = raw || false;
					var v, me = this, m = me.merge && !raw,
						e = $('[id*="' + me.name + '"]:checked:not(.ignore)');

					if(!m) v = [];
					if( e.length )
					{
						e.each( function(){
							var t = (m) ? $.fbuilder.parseVal(this.value) : $.fbuilder.parseValStr(this.value, raw);
							if(!$.isNumeric(t)) t = t.replace(/^"/,'').replace(/"$/,'');
							if(m) v = (v)?v+t:t;
							else v.push(t);
						});
					}
					return (typeof v == 'object' && typeof v['length'] !== 'undefined') ? v : ((v) ? (($.isNumeric(v)) ? v : '"'+v+'"') : 0);
				},
			setVal:function( v )
				{
					var t, n = this.name;
					if( !$.isArray( v ) ) v = [v];
					$( '[id*="'+n+'"]' ).prop( 'checked', false );
					for( var i in v )
					{
						t = (new String(v[i])).replace(/(['"])/g, "\\$1");
						$( '[id*="'+n+'"][vt="'+t+'"],[id*="'+n+'"][value="'+t+'"]' ).prop( 'checked', true );
					}
					$( '[id*="'+n+'"]' ).change();
				},
			setChoices:function(choices)
				{
					if($.isPlainObject(choices))
					{
						var bk = this.val(true);
						if('texts' in choices && $.isArray(choices.texts)) this.choices = choices.texts;
						if('values' in choices && $.isArray(choices.values)) this.choicesVal = choices.values;
						if('dependencies' in choices && $.isArray(choices.dependencies)) this.choicesDep = choices.dependencies;
						var html = this.show(),
							field = $('.'+this.name).replaceWith(html);
						this.setVal(bk);
					}
				}
		}
	);