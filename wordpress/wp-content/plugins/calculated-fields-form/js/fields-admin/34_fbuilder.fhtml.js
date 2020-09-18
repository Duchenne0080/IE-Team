	$.fbuilder.typeList.push(
		{
			id:"fhtml",
			name:"HTML content",
			control_category:1
		}
	);
	$.fbuilder.controls[ 'fhtml' ]=function(){  this.init();  };
	$.extend(
		$.fbuilder.controls[ 'fhtml' ].prototype,
		$.fbuilder.controls[ 'ffields' ].prototype,
		{
			ftype:"fhtml",
			fcontent: "",
			display:function()
				{
					return '<div class="fields '+this.name+' fhtml" id="field'+this.form_identifier+'-'+this.index+'" title="'+this.name+'"><div class="arrow ui-icon ui-icon-play "></div><div title="Delete" class="remove ui-icon ui-icon-trash "></div>'+$( '<div/>' ).html( this.fcontent ).find( 'script,style' ).remove().end().html()+'<div class="clearer"></div></div>';
				},
			editItemEvents:function()
				{
					var evt=[{s:"#sContent",e:"change keyup", l:"fcontent"}];
					$.fbuilder.controls[ 'ffields' ].prototype.editItemEvents.call(this,evt);

					// Code Editor
					if( 'codeEditor' in wp)
					{
						setTimeout(function(){
							var htmlEditorSettings = wp.codeEditor.defaultSettings ? _.clone( wp.codeEditor.defaultSettings ) : {}, editor;
							htmlEditorSettings.codemirror = _.extend(
								{},
								htmlEditorSettings.codemirror,
								{
									indentUnit: 2,
									tabSize: 2,
									autoCloseTags: false
								}
							);
							htmlEditorSettings['htmlhint']['spec-char-escape'] = false;
							htmlEditorSettings['htmlhint']['alt-require'] = false;
							htmlEditorSettings['htmlhint']['tag-pair'] = false;
							editor = wp.codeEditor.initialize( $('#sContent'), htmlEditorSettings );
							editor.codemirror.on('change', function(cm){ $('#sContent').val(cm.getValue()).change();});

							$('.cff-editor-extend-shrink').on('click', function(){$(this).closest('.cff-editor-container').toggleClass('fullscreen');});

						}, 50);
					}
				},
			showContent:function()
				{
					return '<br><div class="cff-editor-container"><label style="display:block;"><div class="cff-editor-extend-shrink"></div>HTML Content</label><br><textarea class="large" name="sContent" id="sContent" style="height:150px;">'+$( '<div/>' ).text( this.fcontent ).html()+'</textarea></div><br>';
				},
			showAllSettings:function()
				{
					return this.showFieldType()+this.showName()+this.showContent()+this.showCsslayout();
				}
		}
	);