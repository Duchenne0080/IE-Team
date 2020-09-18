	$.fbuilder.controls[ 'fpassword' ] = function(){};
	$.extend(
		$.fbuilder.controls[ 'fpassword' ].prototype,
		$.fbuilder.controls[ 'ffields' ].prototype,
		{
			title:"Untitled",
			ftype:"fpassword",
			predefined:"",
			predefinedClick:false,
			required:false,
			size:"medium",
			minlength:"",
			maxlength:"",
			equalTo:"",
			show:function()
				{
					this.minlength = $.fbuilder.htmlEncode($.trim(this.minlength));
					this.maxlength = $.fbuilder.htmlEncode($.trim(this.maxlength));
					this.equalTo = $.fbuilder.htmlEncode($.trim(this.equalTo));
					this.predefined = this._getAttr('predefined');
					return '<div class="fields '+this.csslayout+' '+this.name+' cff-password-field" id="field'+this.form_identifier+'-'+this.index+'"><label for="'+this.name+'">'+this.title+''+((this.required)?"<span class='r'>*</span>":"")+'</label><div class="dfield"><input id="'+this.name+'" name="'+this.name+'"'+((this.minlength.length) ? ' minlength="'+this.minlength+'"' : '')+((this.maxlength.length) ? ' maxlength="'+this.maxlength+'"' : '')+((this.equalTo.length) ? ' equalTo="#'+this.equalTo+this.form_identifier+'"' : '')+' class="field '+this.size+((this.required)?" required":"")+'" type="password" value="'+$.fbuilder.htmlEncode(this.predefined)+'"/><span class="uh">'+this.userhelp+'</span></div><div class="clearer"></div></div>';
				},
			val:function(raw)
				{
					raw = raw || false;
					var e = $( '[id="' + this.name + '"]:not(.ignore)' );
					if( e.length ) return $.fbuilder.parseValStr( e.val(), raw );
					return 0;
				}
		}
	);