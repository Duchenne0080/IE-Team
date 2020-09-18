	$.fbuilder.typeList.push(
		{
			id:"ffile",
			name:"Upload File",
			control_category:1
		}
	);
	$.fbuilder.controls[ 'ffile' ] = function(){};
	$.extend(
		$.fbuilder.controls[ 'ffile' ].prototype,
		$.fbuilder.controls[ 'ffields' ].prototype,
		{
			title:"Untitled",
			ftype:"ffile",
			required:false,
			exclude:false,
			size:"medium",
			accept:"",
			upload_size:"",
			multiple:false,
			preview: false,
			thumb_width: '80px',
			thumb_height: '',
			display:function()
				{
					return '<div class="fields '+this.name+'" id="field'+this.form_identifier+'-'+this.index+'" title="'+this.name+'"><div class="arrow ui-icon ui-icon-play "></div><div title="Delete" class="remove ui-icon ui-icon-trash "></div><div title="Duplicate" class="copy ui-icon ui-icon-copy "></div><label>'+this.title+''+((this.required)?"*":"")+'</label><div class="dfield"><input type="file" disabled class="field '+this.size+'" /><span class="uh">'+this.userhelp+'</span></div><div class="clearer"></div></div>';
				},
			editItemEvents:function()
				{
					var evt = [
							{s:"#sSize",e:"change", l:"size"},
							{s:"#sAccept",e:"change keyup", l:"accept"},
							{s:"#sUpload_size",e:"change keyup", l:"upload_size"},
							{s:"#sThumbWidth",e:"change keyup", l:"thumb_width"},
							{s:"#sThumbHeight",e:"change keyup", l:"thumb_height"},
							{s:"#sMultiple",e:"click", l:"multiple",f:function(el){return el.is(":checked");}},
							{s:"#sPreview",e:"click", l:"preview",f:function(el){return el.is(":checked");}}
						];
					$.fbuilder.controls[ 'ffields' ].prototype.editItemEvents.call(this,evt);
				},
			showSpecialDataInstance: function()
				{
					return '<div><label>Accept these file extensions [<a class="helpfbuilder" text="Extensions comma separated and without the dot.\n\nExample: jpg,png,gif,pdf">help?</a>]</label><br /><input type="text" name="sAccept" id="sAccept" value="'+$.fbuilder.htmlEncode(this.accept)+'" class="large"></div><div><label>Maximum upload size in kB [<a class="helpfbuilder" text="1024 kB = 1 MB.\n\nThe support for this HTML5 feature may be partially available or not available in some browsers.">help?</a>]</label><br /><input type="text" name="sUpload_size" id="sUpload_size" value="'+$.fbuilder.htmlEncode(this.upload_size)+'" class="large"></div><div><label><input type="checkbox" id="sMultiple" name="sMultiple" '+( ( typeof this.multiple != 'undefined' && this.multiple ) ? 'CHECKED' : '' )+' /> Upload multiple files</label></div><hr /><div><label><input type="checkbox" id="sPreview" name="sPreview" '+( ( typeof this.preview != 'undefined' && this.preview ) ? 'CHECKED' : '' )+' /> Show preview of images</label></div><div><label>Thumbnail width</label><input type="text" id="sThumbWidth" name="sThumbWidth" value="'+$.fbuilder.htmlEncode(this.thumb_width)+'" class="large" /></div><div><label>Thumbnail height</label><input type="text" id="sThumbHeight" name="sThumbHeight" value="'+$.fbuilder.htmlEncode(this.thumb_height)+'" class="large" /></div><hr /><div class="clearer"></div>';
				}
	});