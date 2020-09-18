		$.fbuilder.typeList.push(
			{
				id:"fnumber",
				name:"Number",
				control_category:1
			}
		);
        $.fbuilder.controls[ 'fnumber' ] = function(){};
		$.extend(
			$.fbuilder.controls[ 'fnumber' ].prototype,
			$.fbuilder.controls[ 'ffields' ].prototype,
			{
				title:"Number",
				ftype:"fnumber",
				predefined:"",
				predefinedClick:false,
				required:false,
				exclude:false,
				readonly:false,
				size:"small",
				thousandSeparator:"",
				decimalSymbol:".",
				min:"",
				max:"",
				formatDynamically:false,
				dformat:"digits",
				formats:new Array("digits","number", "percent"),
				display:function()
					{
						return '<div class="fields '+this.name+'" id="field'+this.form_identifier+'-'+this.index+'" title="'+this.name+'"><div class="arrow ui-icon ui-icon-play "></div><div title="Delete" class="remove ui-icon ui-icon-trash "></div><div title="Duplicate" class="copy ui-icon ui-icon-copy "></div><label>'+this.title+''+((this.required)?"*":"")+'</label><div class="dfield"><input class="field disabled '+this.size+'" type="text" value="'+$.fbuilder.htmlEncode(this.predefined)+'"/><span class="uh">'+this.userhelp+'</span></div><div class="clearer"></div></div>';
					},
				editItemEvents:function()
					{
						var evt = [
							{s:"#sSize",e:"change", l:"size"},
							{s:"#sFormat",e:"change", l:"dformat", f:function(el){
								var v = el.val();
								$( '.fnumber-symbols' )[(v == 'digits')?'hide':'show']();
								return v;
								}
							},
							{s:"#sMin",e:"change keyup", l:"min"},
							{s:"#sMax",e:"change keyup", l:"max"},
							{s:"#sThousandSeparator",e:"change keyup", l:"thousandSeparator"},
							{s:"#sDecimalSymbol",e:"change keyup", l:"decimalSymbol"},
							{s:"#sFormatDynamically",e:"click", l:"formatDynamically",f:function(el){return el.is(':checked');}},
						];
						$.fbuilder.controls[ 'ffields' ].prototype.editItemEvents.call(this, evt);
					},
				showFormatIntance: function()
					{
						var str = "";
						for (var i=0;i<this.formats.length;i++)
						{

							str += '<option value="'+this.formats[i]+'" '+((this.formats[i]==this.dformat)?"selected":"")+'>'+this.formats[i]+'</option>';
						}
						return '<div><label>Number Format</label><br /><select name="sFormat" id="sFormat">'+str+'</select></div><div class="fnumber-symbols" '+( (this.dformat == 'digits') ? 'style="display:none;"' : '' )+'><label>Decimals separator symbol (Ex: 25.20)</label><input type="text" name="sDecimalSymbol" id="sDecimalSymbol" class="large" value="'+$.fbuilder.htmlEncode(this.decimalSymbol)+'" /><label>Symbol for grouping thousands (Ex: 3,000,000)</label><input type="text" name="sThousandSeparator" id="sThousandSeparator" class="large" value="'+$.fbuilder.htmlEncode(this.thousandSeparator)+'" /><label>Format Dynamically</label><br /><input type="checkbox" name="sFormatDynamically" id="sFormatDynamically" '+( (this.formatDynamically) ? 'CHECKED' : '')+'></div>';
					},
				showRangeIntance: function()
					{
						return '<div class="column"><label>Min</label><br /><input type="text" name="sMin" id="sMin" value="'+$.fbuilder.htmlEncode(this.min)+'"></div><div class="column"><label>Max</label><br /><input type="text" name="sMax" id="sMax" value="'+$.fbuilder.htmlEncode(this.max)+'"></div><div style="margin-bottom:10px;" class="clearer"><i>It is possible to associate other fields in the form to the attributes "min" and "max". Ex: fieldname1</i></div>';
					}
		});